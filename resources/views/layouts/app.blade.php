<!DOCTYPE html>
<html dir="{{ App()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
@php
    $cats = \App\Admin\Category::where('parent_id',1)
    ->selectRaw('id as id')
    ->selectRaw('parent_id as parent_id')
    ->selectRaw('name_'.session('lang').' as name')
    ->selectRaw('name_en as name_en')
    ->get();
    $sub_cats = \App\Admin\Category::where('parent_id','>',1)
        ->selectRaw('id as id')
        ->selectRaw('parent_id as parent_id')
        ->selectRaw('name_'.session('lang').' as name')
        ->selectRaw('name_en as name_en')
        ->get();
    $setting = \App\Admin\Setting::find(1);
    $date = date('Y-m-d');
    $news = \App\Admin\News::orderBy('created_at','desc')->where(['status'=>'active'])->where('started_at','<=',$date)->where('ended_at','>',$date)->with('admin','country','category')->take(3)->get();
    $inter_news = \App\Admin\News::query()->where(['status'=>'active'])->where('started_at','<=',$date)->where('ended_at','>',$date)->with('admin','country','category')->take(3)->get();
    $ad = \App\Admin\Ad::query()->where(['status'=>'active'])->where('started_at','<=',$date)->where('ended_at','>',$date)->first();
    $ad2 = \App\Admin\Ad::query()->where(['status'=>'active'])->where('started_at','<=',$date)->where('ended_at','>',$date)->skip(1)->first();
@endphp
<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title -->
    <title>The News Paper - News &amp; Lifestyle Magazine Template</title>

    <!-- Favicon -->
    <link rel="icon" href="{{ url('PublicDesign') }}/img/core-img/favicon.ico">

    <!-- Core Stylesheet -->
    <link rel="stylesheet" href="{{ url('PublicDesign') }}/style.css">
    @if(App()->getLocale() == 'ar')
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link rel="stylesheet" href="//cdn.rawgit.com/morteza/bootstrap-rtl/v3.3.4/dist/css/bootstrap-rtl.min.css">
        <style type="text/css">
            @import url(http://fonts.googleapis.com/earlyaccess/droidarabickufi.css);
            body {
                font-family: 'Droid Arabic Kufi', serif;
            }
        </style>
    @endif
</head>

<body>
<header class="header-area">
    <div class="top-header-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="top-header-content d-flex align-items-center justify-content-between">
                        <!-- Logo -->
                        <div class="logo">
                            <a href="{{ url('PublicDesign') }}/index.html"><img style="width: 250px;height: 80px;" src="{{ url('AdminDesign') }}/uploads/settings/{{ $setting->logo }}" alt=""></a>
                        </div>

                        <!-- Login Search Area -->
                        <div class="login-search-area d-flex align-items-center">
                            <!-- Login -->
                            <div class="login d-flex">
                                <a href="#">@lang('admin.login')</a>
                                <a href="#">@lang('admin.register')</a>
                            </div>
                            <!-- Search Form -->
                            <div class="search-form">
                                <form action="#" method="post">
                                    <input type="search" name="search" class="form-control" placeholder="@lang('admin.search')">
                                    <button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Navbar Area -->
    <div class="newspaper-main-menu" id="stickyMenu">
        <div class="classy-nav-container breakpoint-off">
            <div class="container">
                <!-- Menu -->
                <nav class="classy-navbar justify-content-between" id="newspaperNav">

                    <!-- Logo -->
                    <div class="logo">
                        <a href="index.html"><img src="{{ url('AdminDesign') }}/uploads/settings/{{ $setting->logo }}" alt=""></a>
                    </div>

                    <!-- Navbar Toggler -->
                    <div class="classy-navbar-toggler">
                        <span class="navbarToggler"><span></span><span></span><span></span></span>
                    </div>

                    <!-- Menu -->
                    <div class="classy-menu">

                        <!-- close btn -->
                        <div class="classycloseIcon">
                            <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                        </div>

                        <!-- Nav Start -->
                        <div class="classynav">
                            <ul>
                                @foreach($cats as $cat)
                                    <li><a href="{{ route('category_page',['category_name'=>str_replace(' ','-',$cat->name_en)]) }}">{{ $cat->name }}</a>
                                        @foreach($sub_cats as $sub_cat)
                                            @if($sub_cat->parent_id == $cat->id)
                                                <ul class="dropdown">
                                                    @foreach($sub_cats as $sub_cat)
                                                        @if($sub_cat->parent_id == $cat->id)
                                                            <li><a href="{{ route('category_page',['category_name'=>str_replace(' ','-',$sub_cat->name_en)]) }}">{{ $sub_cat->name }}</a></li>
                                                        @endif
                                                    @endforeach
                                                </ul>
                                            @endif
                                        @endforeach
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</header>
<div class="hero-area">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-12 col-lg-8">
                <!-- Breaking News Widget -->
                <div class="breaking-news-area d-flex align-items-center">
                    <div class="news-title">
                        <p>@lang('admin.breaking_news')</p>
                    </div>
                    <div id="breakingNewsTicker" class="ticker">
                        <ul>
                            @foreach($news as $new)
                                <li><a href="{{ route('single_page',['category_name'=>str_replace(' ','-',$new->category->name_en),'news_name'=>str_replace(' ','-',$new->title)]) }}">{{ $new->title }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <!-- Breaking News Widget -->
                <div class="breaking-news-area d-flex align-items-center mt-15">
                    <div class="news-title title2">
                        <p>@lang('admin.international')</p>
                    </div>
                    <div id="internationalTicker" class="ticker">
                        <ul>
                            @foreach($inter_news as $new)
                            <li><a href="{{ route('single_page',['category_name'=>str_replace(' ','-',$new->category->name_en),'news_name'=>str_replace(' ','-',$new->title)]) }}">{{ $new->title }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Hero Add -->
            <div class="col-12 col-lg-4">
                <div class="hero-add">
                    @if($ad != null)
                    <a href="#"><img style="width: 400px;height: 100px;" src="{{ url('AdminDesign') }}/uploads/ads/{{ $ad->file->file_name }}" alt=""></a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@yield('content')
<div class="footer-add-area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="footer-add">
                    @if($ad2 !=null)
                    <a href="#"><img style="width: 1500px;height: 180px;" src="{{ url('AdminDesign') }}/uploads/ads/{{ $ad2->file->file_name }}" alt=""></a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ##### Footer Add Area End ##### -->

<!-- ##### Footer Area Start ##### -->
<footer class="footer-area">

    <!-- Main Footer Area -->
    <div class="main-footer-area">
        <div class="container">
            <div class="row">

                <!-- Footer Widget Area -->
                <div class="col-12 col-sm-6 col-lg-4">
                    <div class="footer-widget-area mt-80">
                        <!-- Footer Logo -->
                        <div class="footer-logo">
                            <a href="index.html"><img style="width: 250px;height: 80px;" src="{{ url('AdminDesign') }}/uploads/settings/{{ $setting->logo }}" alt=""></a>
                        </div>
                        <!-- List -->
                        <ul class="list">
                            <li><a href="mailto:contact@youremail.com">{{ $setting->email }}</a></li>
                            <li><a href="tel:+4352782883884">{{ $setting->phone }}</a></li>
                        </ul>
                    </div>
                </div>


                    <div class="col-12 col-sm-6 col-lg-2">
                        <div class="footer-widget-area mt-80">
                            <!-- Title -->
                            <h4 class="widget-title">@lang('admin.main_cats')</h4>
                            <!-- List -->
                            <ul class="list">
                                @foreach($cats as $cat)
                                    <li><a href="{{ route('category_page',['category_name'=>str_replace(' ','-',$cat->name_en)]) }}">{{ $cat->name }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-lg-2">
                        <div class="footer-widget-area mt-80">
                            <!-- Title -->
                            <h4 class="widget-title">@lang('admin.more')+</h4>
                            <!-- List -->
                            <ul class="list">
                                @foreach($sub_cats as $sub_cat)
                                    <li><a href="{{ route('category_page',['category_name'=>str_replace(' ','-',$sub_cat->name_en)]) }}">{{ $sub_cat->name }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                <div class="col-12 col-sm-6 col-lg-2">
                    <div class="footer-widget-area mt-80">
                        <!-- Title -->
                        <h4 class="widget-title">@lang('admin.who_are')</h4>
                        <!-- List -->
                        <ul class="list">
                                <li><a href="#">@lang('admin.about_us')</a></li>
                                <li><a href="#">@lang('admin.who_are')</a></li>
                                <li><a href="#">@lang('admin.information')</a></li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Bottom Footer Area -->
    <div class="bottom-footer-area">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <!-- Copywrite -->
                    <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- ##### Footer Area Start ##### -->

<!-- ##### All Javascript Files ##### -->
<!-- jQuery-2.2.4 js -->
<script src="{{ url('PublicDesign') }}/js/jquery/jquery-2.2.4.min.js"></script>
<!-- Popper js -->
<script src="{{ url('PublicDesign') }}/js/bootstrap/popper.min.js"></script>
<!-- Bootstrap js -->
<script src="{{ url('PublicDesign') }}/js/bootstrap/bootstrap.min.js"></script>
<!-- All Plugins js -->
<script src="{{ url('PublicDesign') }}/js/plugins/plugins.js"></script>
<!-- Active js -->
<script src="{{ url('PublicDesign') }}/js/active.js"></script>
</body>

</html>
