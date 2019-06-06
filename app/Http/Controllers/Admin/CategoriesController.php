<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\CategoryDataTable;
use Session;
use App\Admin\Category;
use Barryvdh\Snappy;

class CategoriesController extends Controller
{
    use AdminTrait;
    public function index(CategoryDataTable $cat)
    {
        if ( auth()->guard('admin')->user()->can('read_categories')){
            return $cat->render('admin.categories.index');
        }else{
            return 'you cant access into this page';
        }
    }
    public function create()
    {
        if ( auth()->guard('admin')->user()->can('add_categories')) {
            $categories = Category::query()
            ->where('parent_id' ,1)
            ->selectRaw('id as id')
            ->selectRaw('name_'.session('lang').' as name')
            ->selectRaw('parent_id')
            ->get();
            return view('admin.categories.create',compact('categories'));
        }else{
            return 'you cant access into this page';
        }
    }
    public function store(Request $request)
    {
        //dd($request->all());
        $rules = [
            'name_ar' => 'required',
            'name_en' => 'required',
        ];
        $this->validate($request, $rules);
            $category = Category::create($request->all());
        Session::flash('message', __('admin.add_message'));
        Session::flash('alert-class', 'alert-success');
        return back();
    }
    public function show($id)
    {
        //
    }
    public function edit($id)
    {
        if ( auth()->guard('admin')->user()->can('edit_categories')) {
            $category = Category::find($id);
            //dd($user);
            $categories = Category::query()
                ->where('parent_id' ,1)
                ->selectRaw('id as id')
                ->selectRaw('name_'.session('lang').' as name')
                ->selectRaw('parent_id')
                ->get();
            return view('admin.categories.edit', compact('category','categories'));

        }else{
            return 'yuo assdas';
        }
    }
    public function update(Request $request, $id)
    {
        $rules = [
            'name_ar' => 'required',
            'name_en' => 'required',
            'parent_id' => 'required',
        ];
            $data = $this->validate($request,$rules);

        $category = Category::find($id)->update($data);

        Session::flash('message', __('admin.edit_message'));
        Session::flash('alert-class', 'alert-success');
        return redirect()->route('categories.index');
    }
    public function destroy($id)
    {
        if ( auth()->guard('admin')->user()->can('delete_categories')) {
            Category::find($id)->delete();
            Session::flash('message', __('admin.destroy'));
            Session::flash('alert-class', 'alert-success');
            return back();
        }else{
            return 'you cant ';
        }
    }
    public function delete_all(Request $request)
    {
        if ( auth()->guard('admin')->user()->can('delete_categories')) {
            if (!$request->has('check_this')){
                Session::flash('message', __('admin.zero_del'));
                Session::flash('alert-class', 'alert-danger');
            }else {
                if (is_array($request->check_this)) {
                    foreach ($request->check_this as $id) {
                        Category::findOrFail($id)->delete();
                    }
                }
                Session::flash('message', __('admin.destroy'));
                Session::flash('alert-class', 'alert-success');
            }
            return back();
        }else{
            return 'you cant ';
        }
    }
}
