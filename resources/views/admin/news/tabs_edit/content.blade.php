<br/>
<div id="home" class="tab-pane fade in active">
    <div class="form-group">
        <label for="exampleInputEmail1">@lang('admin.title')</label>
        <input class="form-control" type="text" name="title" value="{{ $new->title }}">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">@lang('admin.content')</label>
        <textarea class="form-control ckeditor" name="content">{{ $new->content }}</textarea>
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">@lang('admin.logo_article')</label>
        <br/>
        @if($new->file != null)
            <input type="image" id="blah" src="{{ url('AdminDesign') }}/uploads/news/{{ $new->file }}" style="height: 80px;width: 80px;">
        @else
            <input type="image" id="blah" src="{{ url('AdminDesign') }}/uploads/upload_logo.png" style="height: 80px;width: 80px;">
        @endif
        <input type="file" name="file" id="imgInp" class="my_file" style="display: none;" />
    </div>
</div>
