 @extends('layouts.app') @section('content')
<div class="col-sm-8 col-md-offset-2 col-xs-12">
    <div class="panel panel-default">
        <div class="panel-body">
            @if (session('success'))
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong>{{ session('success') }}</strong>
            </div>
            @elseif (session('error'))
            <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong>{{ session('error') }}</strong>
            </div>
            @endif
            <div class="item">
                <div class="form-group col-md-6">
                    <form method="POST" action="/media/new-folder" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="name-text" class="col-form-label">Name</label>
                            <input type="text" class="form-control" id="name-text" name="folderName" placeholder="Create New Folder" requeried="requeried" />
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
            <form method="POST" action="/media/store" enctype="multipart/form-data" id="multiple_upload_form">
                <div class="form-group col-md-12">
                    <div class="form-group col-md-6">
                        <label class="color-black">Select Directory</label>
                        <select class="form-control color-black" name="directory">
                            @foreach($directories as $directory)
                            <option value="{{ $directory }}">{{ $directory }}</option>
                            @endforeach
                        </select>
                    </div>
                    <label class="btn btn-default btn-file">
                        Upload
                        <input type="file" style="display: none;" name="file" class="form-control" multiple/>
                    </label>
                    <div class="form-group col-md-12">
                        <div class="col-md-3">
                            <label class="color-black">Original</label>
                            <input type="text" name="imageVarients[img_width]" class="form-control" value="1400">
                            <label class="color-black">*</label>
                            <input type="text" name="imageVarients[img_height]" class="form-control" value="1400">
                            <input type="checkbox" name="imageVarients[include_canvas]" class="include_canvas" value="1">Include Canvas? Canvas Size
                            <input type="text" name="imageVarients[img_canvas_width]" value="1405">
                            <input type="text" name="imageVarients[img_canvas_height]" value="1405"> Canvas Color
                            <input type="color" value="#" class="form-control col-sm-8" name="imageVarients[img_canvas_color]">
                        </div>
                    </div>
                    <div class="panel-footer">
                        <button type="submit" class="btn btn-primary">
                            Save
                        </button>
                    </div>
            </form>
            </div>
            </form>
        </div>
    </div>
    @endsection