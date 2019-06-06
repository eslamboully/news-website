
<div id="menu1" class="tab-pane fade">
    <div class="form-group col-md-6">
        <label for="exampleInputEmail1">@lang('admin.started_at')</label>
        <input class="form-control timepicker" type="text" name="started_at" value="{{ old('started_at') }}">
    </div>
    <div class="form-group col-md-6">
        <label for="exampleInputEmail1">@lang('admin.ended_at')</label>
        <input class="form-control timepicker" type="text" name="ended_at" value="{{ old('ended_at') }}">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">@lang('admin.status')</label>
        <br/>
        <select  class="form-control" name="status">
            <option value="active">@lang('admin.active')</option>
            <option selected value="pending">@lang('admin.pending')</option>
        </select>
    </div>
</div>
