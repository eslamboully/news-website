
<div id="menu1" class="tab-pane fade">
    <div class="form-group col-md-6">
        <label for="exampleInputEmail1">@lang('admin.started_at')</label>
        <input class="form-control timepicker" type="text" name="started_at" value="{{ $new->started_at }}">
    </div>
    <div class="form-group col-md-6">
        <label for="exampleInputEmail1">@lang('admin.ended_at')</label>
        <input class="form-control timepicker" type="text" name="ended_at" value="{{ $new->ended_at }}">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">@lang('admin.status')</label>
        <br/>
        <select  class="form-control" name="status">
            <option {{ $new->status == 'active' ? 'selected' : '' }} value="active">@lang('admin.active')</option>
            <option {{ $new->status == 'pending' ? 'selected' : '' }} value="pending">@lang('admin.pending')</option>
        </select>
    </div>
</div>
