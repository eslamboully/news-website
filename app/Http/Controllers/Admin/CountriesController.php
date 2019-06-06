<?php

namespace App\Http\Controllers\Admin;

use App\Admin\Country;
use App\DataTables\CountryDataTable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;

class CountriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CountryDataTable $country)
    {
        if ( auth()->guard('admin')->user()->can('read_countries')){
            return $country->render('admin.countries.index');
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
        if ( auth()->guard('admin')->user()->can('add_countries')) {
            return view('admin.countries.create');
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
            'name_ar' => 'required',
            'name_en' => 'required',
        ];
        $this->validate($request, $rules);
        $country = Country::create($request->all());
        Session::flash('message', __('admin.add_message'));
        Session::flash('alert-class', 'alert-success');
        return back();
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
        if ( auth()->guard('admin')->user()->can('edit_countries')) {
            $country = Country::find($id);
            //dd($user);
            return view('admin.countries.edit', compact('country'));

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
            'name_ar' => 'required',
            'name_en' => 'required',
        ];
        $data = $this->validate($request,$rules);
        $country = Country::find($id)->update($data);

        Session::flash('message', __('admin.edit_message'));
        Session::flash('alert-class', 'alert-success');
        return redirect()->route('countries.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ( auth()->guard('admin')->user()->can('delete_countries')) {
            Country::find($id)->delete();
            Session::flash('message', __('admin.destroy'));
            Session::flash('alert-class', 'alert-success');
            return back();
        }else{
            return 'you cant ';
        }
    }
    public function delete_all(Request $request)
    {
        if ( auth()->guard('admin')->user()->can('delete_countries')) {
            if (!$request->has('check_this')){
                Session::flash('message', __('admin.zero_del'));
                Session::flash('alert-class', 'alert-danger');
            }else {
                if (is_array($request->check_this)) {
                    foreach ($request->check_this as $id) {
                        Country::find($id)->delete();
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
