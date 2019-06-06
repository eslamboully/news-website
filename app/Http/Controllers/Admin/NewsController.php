<?php

namespace App\Http\Controllers\Admin;

use App\Admin\Ad;
use App\Admin\Admin;
use App\Admin\Category;
use App\Admin\Country;
use App\Admin\News;
use App\DataTables\NewsDataTable;
use App\Notifications\AddNews;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Notification;
use Session;
use Form;

class NewsController extends Controller
{
    use AdminTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(NewsDataTable $new)
    {
        if ( auth()->guard('admin')->user()->can('read_news')){
            return $new->render('admin.news.index');
        }else{
            return 'you cant access into this page';
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (request()->ajax()){
            return Form::select('category_id',
                Category::where('parent_id',request()->parent)
                ->pluck('name_'.session('lang'),'id'),
                null,
                ['class'=>'form-control nothing']);
        }
        if ( auth()->guard('admin')->user()->can('add_news')) {
            $countries = Country::query()
            ->selectRaw('id as id')
            ->selectRaw('name_'.session('lang').' as name')
            ->get();
            $categories = Category::where('parent_id',1)
            ->selectRaw('id as id')
            ->selectRaw('name_'.session('lang').' as name')
            ->get();
            return view('admin.news.create',compact('countries','categories'));
        }else{
            return 'you cant access into this page';
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'title' =>'required|max:200',
            'content' =>'sometimes',
            'file' => 'sometimes',
            'started_at'=>'sometimes',
            'ended_at'=>'sometimes',
            'status'=>'required',
            'country_id'=>'sometimes',
            'category_id'=>'required',
            'admin_id'=>'required',
        ];
        $data = $this->validate($request, $rules);
        if ($request->category_id == null){ $data['category_id'] == $request->parent_id; }
        if ($request->has('file')){ $this->file_upload('news'); $data['file'] = $this->file->file_name; }
        $new = News::create($data);
        $admins = Admin::all();
        if (News::find($new->id) != null){
            Notification::send($admins,new AddNews($new));
        }
        Session::flash('message', __('admin.add_message'));
        Session::flash('alert-class', 'alert-success');
        if ($request->has('save_close')){
            return redirect()->route('news.index');
        }else{
            return redirect()->route('news.edit',$new->id);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (request()->ajax()){
            return Form::select('category_id',
                Category::where('parent_id',request()->parent)
                    ->pluck('name_'.session('lang'),'id'),
                null,
                ['class'=>'form-control nothing']);
        }
        if ( auth()->guard('admin')->user()->can('edit_news')) {
            $countries = Country::query()
                ->selectRaw('id as id')
                ->selectRaw('name_'.session('lang').' as name')
                ->get();
            $categories = Category::where('parent_id',1)
                ->selectRaw('id as id')
                ->selectRaw('name_'.session('lang').' as name')
                ->get();

            $new = News::find($id);
            return view('admin.news.edit',compact('countries','categories','new'));

        }else{
            return 'yuo assdas';
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'title' =>'required',
            'content' =>'sometimes',
            'file' => 'sometimes',
            'started_at'=>'sometimes',
            'ended_at'=>'sometimes',
            'status'=>'required',
            'country_id'=>'sometimes',
            'category_id'=>'sometimes',
            'admin_id'=>'required',
        ];
        $news = News::find($id);
        $data = $this->validate($request,$rules);
        if ($request->category_id == null && $request->parent_id == null){
            $data['category_id'] = $news->category_id;
        }else if ($request->category_id ==null && $request->parent_id != null){
            $data['category_id'] = $request->parent_id;
        }
        if ($request->has('file')){ $this->file_upload('news'); $data['file'] = $this->file->file_name; }
        $new = News::find($id)->update($data);
        Session::flash('message', __('admin.edit_message'));
        Session::flash('alert-class', 'alert-success');
        if ($request->has('save_close')){
            return redirect()->route('news.index');
        }else{
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ( auth()->guard('admin')->user()->can('delete_news')) {
            News::find($id)->delete();
            Session::flash('message', __('admin.destroy'));
            Session::flash('alert-class', 'alert-success');
            return back();
        }else{
            return 'you cant ';
        }
    }
    public function delete_all(Request $request)
    {
        if ( auth()->guard('admin')->user()->can('delete_news')) {
            if (!$request->has('check_this')){
                Session::flash('message', __('admin.zero_del'));
                Session::flash('alert-class', 'alert-danger');
            }else {
                if (is_array($request->check_this)) {
                    foreach ($request->check_this as $id) {
                        News::find($id)->delete();
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
    public function change_status($id)
    {
        $new = News::find($id);
        if ($new->status == 'active'){
            $new->update([
                'status' => 'pending'
            ]);
        }else{
            $new->update([
                'status' => 'active'
            ]);
        }
        return back();
    }

}
