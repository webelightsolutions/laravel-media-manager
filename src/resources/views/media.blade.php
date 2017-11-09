 @extends('layouts.app') @section('content')
<div class="col-sm-8 col-md-offset-2 col-xs-12">
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="item">
                <div class="form-group col-md-6">
                    <form method="POST" action="/media/new-folder" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="name-text" class="col-form-label">Name</label>
                            <input type="text" class="form-control" id="name-text" name="folderName" requeried="requeried" />
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
            <form method="POST" action="/media/store" enctype="multipart/form-data" id="multiple_upload_form">
                <div class="form-group col-md-12">
                    <div class="form-group col-md-6">
                        <label class="color-black">Select Directory</label>
                        <select class="form-control color-black" name="upload_path">
                            @foreach($directoryLists as $directoryList)
                            <option value="{{ $directoryList }}">{{ $directoryList }}</option>
                            @endforeach
                        </select>
                    </div>
                    <label class="btn btn-default btn-file">
                        Upload Images
                        <input type="file" style="display: none;" accept="image/*" name="photos[]" class="form-control" multiple/>
                    </label>
                    <label class="btn btn-default btn-file">
                        Upload Documents
                        <input type="file" style="display: none;" accept=".txt, .pdf, .doc, .docx, .ppt, .xlsx" name="documents[]" class="form-control" multiple/>
                    </label>
                    <div class="form-group col-md-12">
                        <div class="col-md-3">
                            <label class="color-black">Original</label>
                            <input type="text" name="images[original][img_width]" class="form-control" value="1400">
                            <label class="color-black">*</label>
                            <input type="text" name="images[original][img_height]" class="form-control" value="1400">
                            <input type="checkbox" name="images[original][include_canvas]" class="include_canvas" value="1">Include Canvas? Canvas Size
                            <input type="text" name="images[original][img_canvas_width]" value="1405">
                            <input type="text" name="images[original][img_canvas_height]" value="1405"> Canvas Color
                            <input type="color" value="#" class="form-control col-sm-8" name="images[original][img_canvas_color]">
                        </div>
                        <div class="col-md-3">
                            <label class="color-black">Medium</label>
                            <input type="text" name="images[medium][img_width]" class="form-control" value="600">
                            <label class="color-black">*</label>
                            <input type="text" name="images[medium][img_height]" class="form-control" value="600">
                            <input type="checkbox" name="images[medium][include_canvas]" class="include_canvas" value="1">Include Canvas? Canvas Size
                            <input type="text" name="images[medium][img_canvas_width]" value="605">
                            <input type="text" name="images[medium][img_canvas_height]" value="605"> Canvas Color
                            <input type="color" value="#" class="form-control col-sm-8" name="images[medium][img_canvas_color]">
                        </div>
                        <div class="col-md-3">
                            <label class="color-black">Small</label>
                            <input type="text" name="images[small][img_width]" class="form-control" value="200">
                            <label class="color-black">*</label>
                            <input type="text" name="images[small][img_height]" class="form-control" value="200">
                            <input type="checkbox" name="images[small][include_canvas]" class="include_canvas" value="1">Include Canvas? Canvas Size
                            <input type="text" name="images[small][img_canvas_width]" value="205">
                            <input type="text" name="images[small][img_canvas_height]" value="205"> Canvas Color
                            <input type="color" value="#" class="form-control col-sm-8" name="images[small][img_canvas_color]">
                        </div>
                        <div class="col-md-3">
                            <label class="color-black">Extra Small</label>
                            <input type="text" name="images[extra_small][img_width]" class="form-control" value="1000">
                            <label class="color-black">*</label>
                            <input type="text" name="images[extra_small][img_height]" class="form-control" value="1000">
                            <input type="checkbox" name="images[extra_small][include_canvas]" class="include_canvas" value="1">Include Canvas? Canvas Size
                            <input type="text" name="images[extra_small][img_canvas_width]" value="1005">
                            <input type="text" name="images[extra_small][img_canvas_height]" value="1005"> Canvas Color
                            <input type="color" value="#" class="form-control col-sm-8" name="images[extra_small][img_canvas_color]">
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
    <script type="text/javascript">
    let $jQuery = jQuery;
    /*$jQuery(function() {
        if ($jQuery("input[name=include_canvas]:checked")) {
            $jQuery('.canvas_details').show();
        }
    });*/
    $jQuery('#myModal').on('show.bs.modal', function(event) {
        let button = $jQuery(event.relatedTarget) // Button that triggered the modal
        let recipient = button.data('whatever') // Extract info from data-* attributes
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        let modal = $(this)
        modal.find('.modal-body input').val(recipient)
    })
    </script>
    @endsection