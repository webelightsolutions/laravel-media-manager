 @extends('layouts.app') @section('content')
<div class="col-sm-8 col-md-offset-2 col-xs-12">
    <div class="panel panel-default">
        <div class="panel-body">
            @if (session('success'))
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                <strong>Success</strong> {{ session('success') }}
            </div>
            @elseif (session('error'))
            <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                <strong>Error!</strong> {{ session('error') }}
            </div>
            @endif
            <div class="row">
                <form method="POST" action="/media/new-folder" enctype="multipart/form-data">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Create Folder</label>
                            <input type="text" class="form-control" id="name-text" name="folderName" placeholder="Create New Folder" requeried="requeried" />
                        </div>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary" style="margin-top: 25px;">Create</button>
                    </div>
                </form>
                <div class="col-md-2">
                    <label style="margin-top: 34px; font-size: 17px; margin-left: -25px;"> OR </label>
                </div>
                <form method="POST" action="/media/store" enctype="multipart/form-data" id="multiple_upload_form">
                    <div class="col-md-3" style="margin-left: -75px;">
                        <div class="form-group">
                            <label class="color-black">Select Directory</label>
                            <select class="form-control color-black" name="directory">
                                @foreach($directories as $directory)
                                <option value="{{ $directory }}">{{ $directory }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <label class="btn btn-default btn-file" style="margin-top: 25px;">
                            Upload
                            <input type="file" style="display: none;" name="file" class="form-control" multiple/>
                        </label>
                    </div>
                    <div class="col-sm-12">
                        <div class="checkbox" style="margin-top: 30px;">
                            <label data-toggle='collapse' data-target='#collapsediv2'>
                                <input type="checkbox" name="imageVarients[resize_image]" value="1" data-toggle="collapse" data-target="#collapseExample2" aria-expanded="false" aria-controls="collapseExample2" /> Resize Image ?
                            </label>
                        </div>
                        <div class="collapse" id="collapseExample2">
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
                        </div>
                        <div class="collapse" id="collapseExample">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="canvas_width" class="control-label">Canvas Width</label>
                                    <input type="text" class="form-control" name="imageVarients[img_canvas_width]" id="canvas_width" value="502">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="canvas_height" class="control-label">Canvas Height</label>
                                    <input type="text" class="form-control" name="imageVarients[img_canvas_height]" id="canvas_height" value="502">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="canvas_color" class="control-label">Canvas Color</label>
                                    <input type="color" class="form-control" name="imageVarients[img_canvas_color]" id="canvas_color" value="#">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <center>
                            <button type="submit" class="btn btn-primary">
                                Save Media
                            </button>
                        </center>
                    </div>
                </form>
                <div class="col-md-4">
                    <center>
                        <a href=" {{'/media'}}" class="btn btn-primary btn-sm">All Media</a>
                    </center>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection