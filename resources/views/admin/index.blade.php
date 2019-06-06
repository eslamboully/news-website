@extends('layouts.admin.app')

@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                @lang('admin.main')
                <small>@lang('admin.control_panel')</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> @lang('admin.main')</a></li>
                <li class="active">@lang('admin.control_panel')</li>
            </ol>
        </section>
        @php
           $admin_count =  \App\Admin\Admin::all()->count();
           $categories_count =  \App\Admin\Category::all()->count();
           $categories_count--;
           $ads_count =  \App\Admin\Ad::all()->count();
           $news_count =  \App\Admin\News::all()->count();
        @endphp

        <section class="content">
            <div class="row">
                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-aqua">
                        <div class="inner">
                            <h3>{{ $admin_count }}</h3>
                            <p>@lang('admin.admins')</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-users"></i>
                        </div>
                        <a href="{{ route('admins.index') }}" class="small-box-footer">@lang('admin.more') <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-green">
                        <div class="inner">
                            <h3>{{ $categories_count }}</h3>
                            <p>@lang('admin.categories')</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-list-ol"></i>
                        </div>
                        <a href="{{ route('categories.index') }}" class="small-box-footer">@lang('admin.more') <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-yellow">
                        <div class="inner">
                            <h3>{{ $ads_count }}</h3>
                            <p>@lang('admin.ads')</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-adjust"></i>
                        </div>
                        <a href="{{ route('ads.index') }}" class="small-box-footer">@lang('admin.more') <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-red">
                        <div class="inner">
                            <h3>{{ $news_count }}</h3>
                            <p>@lang('admin.news')</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-newspaper-o"></i>
                        </div>
                        <a href="{{ route('news.index') }}" class="small-box-footer">@lang('admin.more') <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
            </div>
        </section>
    </div>

@endsection
