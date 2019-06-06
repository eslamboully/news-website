@extends('layouts.admin.app')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>@lang('admin.countries')<small>@lang('admin.edit')</small></h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> @lang('admin.dashboard')</a></li>
                <li class="active"><a href="{{ route('countries.index') }}"><i class="fa fa-flag-o"></i> @lang('admin.countries')</a></li>
                <li class="active"><i class="fa fa-edit"></i> @lang('admin.edit_country')</li>
            </ol>
        </section>
        <section class="content">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">@lang('admin.edit_country')</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    @include('includes._session')
                    @include('includes._errors')
                    <form class="form-group" action="{{ route('countries.update',$country->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="exampleInputEmail1">@lang('admin.name_ar')</label>
                            <input class="form-control" type="text" name="name_ar" value="{{ $country->name_ar }}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">@lang('admin.name_en')</label>
                            <input class="form-control" type="text" name="name_en" value="{{ $country->name_en }}">
                        </div>
                        <div class="form-group">
                            <input class="btn btn-primary" type="submit" value="@lang('admin.edit')">
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>

@endsection
