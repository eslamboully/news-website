    <div id="menu2" class="tab-pane fade">
    <input type="hidden" name="admin_id" value="{{ auth()->guard('admin')->user()->id }}">
    <div class="form-group">
        <label for="exampleInputEmail1">@lang('admin.country')</label>
        <select name="country_id" class="form-control">
            <option value="">@lang('admin.choose_country')</option>
            @foreach($countries as $country)
                <option value="{{ $country->id }}">{{ $country->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">@lang('admin.category')</label>
        <select name="parent_id" class="form-control parent_id">
            <option value="">@lang('admin.choose_category')</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
    </div>
    <label for="exampleInputEmail1">@lang('admin.sub_category')</label>
    <div class="form-group foo hidden sub_category">
    </div>
</div>
