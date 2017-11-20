 @extends('layouts.app') @section('content')
<div class="col-sm-8 col-md-offset-2 col-xs-12">
    <div class="panel panel-default">
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
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <form method="POST" action="/media/new-folder" enctype="multipart/form-data">
                            <label>Create Folder</label>
                            <input type="text" class="form-control" id="name-text" name="folderName" placeholder="Create New Folder" requeried="requeried" />
                            <button type="submit" class="btn btn-primary" style="margin-top: 5px;">Create</button>
                        </form>
                    </div>
                </div>
                <div class="col-md-2">
                    <label style="margin-top: 34px; margin-left:67px; font-size: 17px;"> OR </label>
                </div>
                <div class="col-md-5">
                    <form method="POST" action="/media/store" enctype="multipart/form-data" id="multiple_upload_form">
                        <div class="form-group">
                            <label class="color-black">Select Directory</label>
                            <select class="form-control color-black" name="directory">
                                @foreach($directories as $directory)
                                <option value="{{ $directory }}">{{ $directory }}</option>
                                @endforeach
                            </select>
                            <label class="btn btn-default btn-file" style="margin-top: 5px;">
                                Upload
                                <input type="file" style="display: none;" name="file" class="form-control" multiple/>
                            </label>
                        </div>
                </div>
                <div class="col-sm-12">
                    <label>Resize Image</label>
                </div>
                <div class="form-group col-md-5">
                    <div class="form-group">
                        <label>Image Width</label>
                        <input type="text" class="form-control" name="imageVarients[img_width]" value="500">
                    </div>
                </div>
                <div class="form-group col-md-5">
                    <div class="form-group">
                        <label>Image Height</label>
                        <div>
                            <input type="text" class="form-control" name="imageVarients[img_height]" value="500">
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="checkbox" style="margin-top: 30px;">
                        <label data-toggle='collapse' data-target='#collapsediv1'>
                            <input type="checkbox" name="imageVarients[include_canvas]" value="1" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample" /> Include Canvas?
                        </label>
                    </div>
                </div>
                <div class="collapse" id="collapseExample">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="canvas_width" class="col-sm-8 control-label">Canvas Width</label>
                            <input type="text" class="form-control" name="imageVarients[img_canvas_width]" id="canvas_width" value="502">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="canvas_height" class="col-sm-8 control-label">Canvas Height</label>
                            <input type="text" class="form-control" name="imageVarients[img_canvas_height]" id="canvas_height" value="502">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="canvas_color" class="col-sm-8 control-label">Canvas Color</label>
                            <input type="color" class="form-control" name="imageVarients[img_canvas_color]" id="canvas_color" value="#">
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <center>
                    <button type="submit" class="btn btn-primary">
                        Save
                    </button>
                </center>
            </div>
            </form>
        </div>
    </div>
</div>
</div>
@endsection