@if(auth()->guard('admin')->user()->can('delete_categories'))
<form class="form_del_one" action="{{ route('categories.destroy',$id) }}" method="POST">
    @csrf
    @method('delete')
    <button class="btn btn-danger btn-sm delBtns" onclick="return confirm('هل انت متأكد من عملية الحذف ؟');"><i class="fa fa-trash"></i></button>
</form>
@else
    <button class="btn btn-danger btn-sm delBtns disabled" ><i class="fa fa-trash"></i></button>
@endif
