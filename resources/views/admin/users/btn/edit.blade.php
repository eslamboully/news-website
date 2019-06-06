@if(auth()->guard('admin')->user()->can('edit_admins'))
<a href="{{ route('users.edit',$id) }}" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>
@else
    <a href="#" class="btn btn-success btn-sm disabled"><i class="fa fa-edit"></i></a>
@endif
