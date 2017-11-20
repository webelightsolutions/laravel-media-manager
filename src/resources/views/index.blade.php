 @extends('layouts.app') @section('content')
<div class="panel panel-default">
    <div class="panel-heading">
        <div class="row">
            <div class="col-md-4 heading">Media</div>
            <div class="col-md-8 text-right">
                <a href='{{ url("media/create") }}' class="btn btn-default btn-sm">+ Add New</a>
            </div>
            <form method="GET" action="#" class="navbar-form navbar-left">
                <div class="input-group">
                    <input type="text" value="" name="search" id="searchs" placeholder="Search..." class="form-control" data-searchs/>
                    <span class="input-group-btn">
                <button class="btn btn-default deal-search" type="submit">Search</button>
                  </span>
                </div>
            </form>
        </div>
    </div>
    <div class="panel-body">
        @if (session('success'))
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>Success</strong> {{ session('success') }}
        </div>
        @elseif (session('error'))
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>Error!</strong> {{ session('error') }}
        </div>
        @endif
        <div class="table-responsive">
            <table class="table table-striped table-bordered task-table">
                <thead>
                    <th class="text-center">Sr.No.</th>
                    <th class="text-center">Media</th>
                    <th class="text-center">Mime Type</th>
                    <th class="text-center">Directory</th>
                    <th class="text-center">Action</th>
                </thead>
                @if (count($medias) > 0)
                <tbody>
                    <?php $counter = 1; ?> @foreach ($medias as $media)
                    <tr class="table-text text-center">
                        <td>{{ $counter++ }}</td>
                        @if($media->type == 'video')
                        <td class="table-text text-center">
                            <div>
                                <video width="150" height="150" autoplay controls>
                                    <source src="{{ asset( 'storage/'.$media->path.$media->media_name) }}" alt="{{ $media->media_name }}">
                                </video>
                            </div>
                        </td>
                        @elseif($media->type == 'audio')
                        <td class="table-text text-center">
                            <div>
                                <audio controls loop>
                                    <source src="{{ asset( 'storage/'.$media->path.$media->media_name) }}" alt="{{ $media->media_name }}">
                                </audio>
                            </div>
                        </td>
                        @else
                        <td class="table-text text-center">
                            <div>
                                <img src="{{ asset( 'storage/'.$media->path.$media->media_name) }}" width=100 height=100 alt="{{ $media->media_name }}">
                            </div>
                        </td>
                        @endif
                        <td class="table-text text-center">
                            <div>{{ $media->mime_type }}</div>
                        </td>
                        <td class="table-text text-center">
                            <div>{{ $media->path }}</div>
                        </td>
                        <td class="td-actions text-center">
                            <button class="btn btn-info btn-sm"><i class="fa fa-trash-o" aria-hidden="true"><a href=" {{'storage/'.$media->path.$media->media_name }}" download>Download</a></i></button>
                            <form method="POST" action="/media/{{$media->id }}" onsubmit="return getConfirmation()">
                                {{ csrf_field() }} {{ method_field('DELETE') }}
                                <button class="btn btn-danger btn-sm"><i class="fa fa-trash-o" aria-hidden="true">DELETE</i></button>
                            </form>
                            <script type="text/javascript">
                            function getConfirmation() {
                                var retVal = confirm("Do you want to Delete ?");
                                if (retVal === true) {
                                    return true;
                                } else {
                                    return false;
                                }
                            }
                            </script>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                @else
                <tbody>
                    <tr>
                        <td colspan="12" class="text-center">No Records Found.</td>
                    </tr>
                </tbody>
                @endif
            </table>
        </div>
    </div>
</div>
@endsection