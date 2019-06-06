@if($status == 'active')
    <a href="{{ route('change_status',$id) }}" class="btn btn-success btn-xs">@lang('admin.active')</a>
@else
    <a href="{{ route('change_status',$id) }}" class="btn btn-danger btn-xs">@lang('admin.pending')</a>
@endif
