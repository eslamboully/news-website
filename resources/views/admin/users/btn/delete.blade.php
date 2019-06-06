@if(auth()->guard('admin')->user()->can('delete_admins'))
<form class="form_del_one" action="{{ route('users.destroy',$id) }}" method="POST">
    @csrf
    @method('delete')
    <button class="btn btn-danger btn-sm delBtns" onclick="return confirm('هل انت متأكد من عملية الحذف ؟');"><i class="fa fa-trash"></i></button>
</form>
@else
    <button class="btn btn-danger btn-sm delBtns disabled" ><i class="fa fa-trash"></i></button>
@endif
