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
                <div class="col-md-8">
                    <div class="form-group col-md-4">
                        <form method="POST" action="/media/new-folder" enctype="multipart/form-data">
                            <label>Create Folder</label>
                            <input type="text" class="form-control" id="name-text" name="folderName" placeholder="Create New Folder" requeried="requeried" />
                            <button type="submit" class="btn btn-primary" style="margin-top: 5px;">Create</button>
                        </form>
                    </div>
                </div>
                <div class="col-md-8">
                    <form method="POST" action="/media/store" enctype="multipart/form-data" id="multiple_upload_form">
                        <div class="form-group col-md-4">
                            <label class="color-black">Select Directory</label>
                            <select class="form-control color-black" name="directory">
                                @foreach($directories as $directory)
                                <option value="{{ $directory }}">{{ $directory }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label class="btn btn-default btn-file" style="margin-top: 70px;">
                                Upload
                                <input type="file" style="display: none;" name="file" class="form-control" multiple/>
                            </label>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="color-black">Resize Image</label>
                            <div class="form-group">
                                <label for="image_width" class="col-sm-8 control-label">Image Width</label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" name="imageVarients[img_width]" id="image_width" value="500">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="image_height" class="col-sm-8 control-label">Image Height</label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" name="imageVarients[img_height]" id="image_height" value="500">
                                </div>
                            </div>
                            <div class="checkbox">
                                <label data-toggle='collapse' data-target='#collapsediv1'>
                                    <input type="checkbox" name="imageVarients[include_canvas]" value="1" /> Include Canvas?
                                </label>
                            </div>
                            <div id="collapsediv1">
                                <div class="form-group">
                                    <label for="canvas_width" class="col-sm-8 control-label">Canvas Width</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" name="imageVarients[img_canvas_width]" id="canvas_width" value="502">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="canvas_height" class="col-sm-8 control-label">Canvas Height</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" name="imageVarients[img_canvas_height]" id="canvas_height" value="502">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="canvas_color" class="col-sm-8 control-label">Canvas Color</label>
                                    <div class="col-md-10">
                                        <input type="color" class="form-control" name="imageVarients[img_canvas_color]" id="canvas_color" value="#">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary" style="margin-top: 5px;">
                                Save
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
</div>
@endsection