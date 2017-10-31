 @extends('layouts.app') @section('content')
<div class="col-sm-8 col-md-offset-2 col-xs-12">
    <div class="panel panel-default">
        <form method="POST" action="/media/store" enctype="multipart/form-data" id="multiple_upload_form">
            <div class="panel-body">
                <div class="item">
                        <div class="form-group col-md-6">
                            <label class="color-black">Select Directory OR Create Directory</label>
                            <select class="form-control color-black" name="directory_lists">
                                @foreach($directoryLists as $directoryList)
                                    <option value="{{ $directoryList }}">{{ $directoryList }}</option>
                                @endforeach
                            </select>
                            <label class="color-black">OR</label>
                            <input type="text" name="create_directory" class="form-control">
                        </div>
                        <div class="form-group">
                            <label class="btn btn-default btn-file">
                                Upload Images
                                <input type="file" style="display: none;" accept="image/*" name="photos[]" class="form-control"  multiple/>
                            </label>
                            <label class="btn btn-default btn-file">
                                Upload Documents
                                <input type="file" style="display: none;" accept=".txt, .pdf, .doc, .docx, .ppt, .xlsx" name="documents[]" class="form-control" multiple/>
                            </label>
                        </div>
                        <div class="form-group col-md-12">
                            <div class="col-md-3">
                                <label class="color-black">Original</label>
                                <input type="text" name="images[original][img_width]" class="form-control" value="1400">
                                <label class="color-black">*</label>
                                <input type="text" name="images[original][img_height]" class="form-control" value="1400">
                                <input type="checkbox" name="images[original][include_canvas]" class="include_canvas" value="1" data-toggle="collapse" data-target="#collapseCanvasOriginal" aria-expanded="false" aria-controls="collapseCanvasOriginal">Include Canvas?
                                <div class="collapse"  id="collapseCanvasOriginal">
                                    Canvas Size
                                    <input type="text" name="images[original][img_canvas_width]" value="1405">
                                    <input type="text" name="images[original][img_canvas_height]" value="1405"> Canvas Color
                                    <input type="color" value="#" class="form-control col-sm-8" name="images[original][img_canvas_color]">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label class="color-black">Medium</label>
                                <input type="text" name="images[medium][img_width]" class="form-control" value="600">
                                <label class="color-black">*</label>
                                <input type="text" name="images[medium][img_height]" class="form-control" value="600">
                                <input type="checkbox" name="images[medium][include_canvas]" class="include_canvas" value="1" data-toggle="collapse" data-target="#collapseCanvasMedium" aria-expanded="false" aria-controls="collapseCanvasMedium">Include Canvas?
                                <div class="collapse"  id="collapseCanvasMedium">
                                    Canvas Size
                                    <input type="text" name="images[medium][img_canvas_width]" value="605">
                                    <input type="text" name="images[medium][img_canvas_height]" value="605"> Canvas Color
                                    <input type="color" value="#" class="form-control col-sm-8" name="images[medium][img_canvas_color]">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label class="color-black">Small</label>
                                <input type="text" name="images[small][img_width]" class="form-control" value="200">
                                <label class="color-black">*</label>
                                <input type="text" name="images[small][img_height]" class="form-control" value="200">
                                <input type="checkbox" name="images[small][include_canvas]" class="include_canvas" value="1"
                                data-toggle="collapse" data-target="#collapseCanvasSmall" aria-expanded="false" aria-controls="collapseCanvasSmall">Include Canvas?
                                <div class="collapse"  id="collapseCanvasSmall">
                                    Canvas Size
                                    <input type="text" name="images[small][img_canvas_width]" value="205">
                                    <input type="text" name="images[small][img_canvas_height]" value="205"> Canvas Color
                                    <input type="color" value="#" class="form-control col-sm-8" name="images[small][img_canvas_color]">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label class="color-black">Extra Small</label>
                                <input type="text" name="images[extra_small][img_width]" class="form-control" value="1000">
                                <label class="color-black">*</label>
                                <input type="text" name="images[extra_small][img_height]" class="form-control" value="1000">
                                <input type="checkbox" name="images[extra_small][include_canvas]" class="include_canvas" value="1" data-toggle="collapse" data-target="#collapseCanvasExtraSmall" aria-expanded="false" aria-controls="collapseCanvasExtraSmall">Include Canvas?
                                <div  class="collapse"  id="collapseCanvasExtraSmall">
                                    Canvas Size
                                    <input type="text" name="images[extra_small][img_canvas_width]" value="1005">
                                    <input type="text" name="images[extra_small][img_canvas_height]" value="1005"> Canvas Color
                                    <input type="color" value="#" class="form-control col-sm-8" name="images[extra_small][img_canvas_color]">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <div class="panel-footer">
                <button type="submit" class="btn btn-primary">
                    Save
                </button>
            </div>
        </form>
    </div>
</div>
</div>
<script type="text/javascript">
var $jQuery = jQuery;
$jQuery(function() {
    console.log('dfds');
    if ($jQuery("input[name=include_canvas]:checked")) {
        $jQuery('.canvas_details').show();
    }
});
</script>
@endsection