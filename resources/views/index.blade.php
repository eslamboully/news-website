@extends('layouts.app')

@section('content')
    <div class="featured-post-area">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6 col-lg-8">
                    <div class="row">
                        <div class="col-12 col-lg-7">
                            @if($first_news !=null)
                                <div class="single-blog-post featured-post">
                                    <div class="post-thumb">
                                            <a href="{{ route('single_page',['category_name'=>str_replace(' ','-',$first_news->category->name_en),'news_name'=>str_replace(' ','-',$first_news->title)]) }}"><img src="{{ url('AdminDesign') }}/uploads/news/{{ $first_news->file }}" alt=""></a>
                                    </div>
                                    <div class="post-data">
                                        @if(App()->getLocale() == 'ar')
                                        <a href="{{ route('category_page',['category_name'=>str_replace(' ','-',$first_news->category->name_en)]) }}" class="post-catagory">{{ $first_news->category->name_ar }}</a>
                                        @else
                                        <a href="{{ route('category_page',['category_name'=>str_replace(' ','-',$first_news->category->name_en)]) }}" class="post-catagory">{{ $first_news->category->name_en }}</a>
                                        @endif
                                        <a href="{{ route('single_page',['category_name'=>str_replace(' ','-',$first_news->category->name_en),'news_name'=>str_replace(' ','-',$first_news->title)]) }}" class="post-title">
                                            <h6>{{ $first_news->title }}</h6>
                                        </a>
                                        <div class="post-meta">
                                            <p class="post-author">@lang('admin.by') <a href="#">{{ $first_news->admin->name }}</a></p>
                                            <p class="post-excerp">{!! str_limit($first_news->content,139) !!}<p>
                                            <!-- Post Like & Post Comment -->
                                            <div class="d-flex align-items-center">
                                                <a href="#" class="post-comment"><img src="{{ url('PublicDesign') }}/img/core-img/chat.png" alt=""> <span>10</span></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <div class="col-12 col-lg-5">
                           @if($second_news != null)
                                <div class="single-blog-post featured-post-2">
                                <div class="post-thumb">
                                    <a href="{{ route('single_page',['category_name'=>str_replace(' ','-',$second_news->category->name_en),'news_name'=>str_replace(' ','-',$second_news->title)]) }}"><img src="{{ url('AdminDesign') }}/uploads/news/{{ $second_news->file }}" alt=""></a>
                                </div>
                                <div class="post-data">
                                    @if(App()->getLocale() == 'ar')
                                    <a href="{{ route('category_page',['category_name'=>str_replace(' ','-',$second_news->category->name_en)]) }}" class="post-catagory">{{ $second_news->category->name_ar }}</a>
                                    @else
                                    <a href="{{ route('category_page',['category_name'=>str_replace(' ','-',$second_news->category->name_en)]) }}" class="post-catagory">{{ $second_news->category->name_en }}</a>
                                    @endif
                                    <div class="post-meta">
                                        <a href="{{ route('single_page',['category_name'=>str_replace(' ','-',$second_news->category->name_en),'news_name'=>str_replace(' ','-',$second_news->title)]) }}" class="post-title">
                                            <h6>{{ $second_news->title }}</h6>
                                        </a>
                                        <!-- Post Like & Post Comment -->
                                        <div class="d-flex align-items-center">
                                            <a href="#" class="post-comment"><img src="{{ url('PublicDesign') }}/img/core-img/chat.png" alt=""> <span>10</span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                            @if($third_news != null)
                                <div class="single-blog-post featured-post-2">
                                <div class="post-thumb">
                                    <a href="{{ route('single_page',['category_name'=>str_replace(' ','-',$third_news->category->name_en),'news_name'=>str_replace(' ','-',$third_news->title)]) }}"><img src="{{ url('AdminDesign') }}/uploads/news/{{ $third_news->file }}" alt=""></a>
                                </div>
                                <div class="post-data">
                                    @if(App()->getLocale() == 'ar')
                                        <a href="{{ route('category_page',['category_name'=>str_replace(' ','-',$third_news->category->name_en)]) }}" class="post-catagory">{{ $third_news->category->name_ar }}</a>
                                    @else
                                        <a href="{{ route('category_page',['category_name'=>str_replace(' ','-',$third_news->category->name_en)]) }}" class="post-catagory">{{ $third_news->category->name_en }}</a>
                                    @endif
                                    <div class="post-meta">
                                        <a href="{{ route('single_page',['category_name'=>str_replace(' ','-',$third_news->category->name_en),'news_name'=>str_replace(' ','-',$third_news->title)]) }}" class="post-title">
                                            <h6>{{ $third_news->title }}</h6>
                                        </a>
                                        <!-- Post Like & Post Comment -->
                                        <div class="d-flex align-items-center">
                                            <a href="#" class="post-comment"><img src="{{ url('PublicDesign') }}/img/core-img/chat.png" alt=""> <span>10</span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-4">
                @if($side_news != null)
                    @foreach($side_news as $side_new)
                    <div class="single-blog-post small-featured-post d-flex">
                        <div class="post-thumb">
                            <a href="{{ route('single_page',['category_name'=>str_replace(' ','-',$side_new->category->name_en),'news_name'=>str_replace(' ','-',$side_new->title)]) }}"><img src="{{ url('AdminDesign') }}/uploads/news/{{ $side_new->file }}" alt=""></a>
                        </div>
                        <div class="post-data">
                            @if(App()->getLocale() == 'ar')
                            <a href="{{ route('category_page',['category_name'=>str_replace(' ','-',$side_new->category->name_en)]) }}" class="post-catagory">{{ $side_new->category->name_ar }}</a>
                            @else
                            <a href="{{ route('category_page',['category_name'=>str_replace(' ','-',$side_new->category->name_en)]) }}" class="post-catagory">{{ $side_new->category->name_en }}</a>
                            @endif
                            <div class="post-meta">
                                <a href="{{ route('single_page',['category_name'=>str_replace(' ','-',$side_new->category->name_en),'news_name'=>str_replace(' ','-',$side_new->title)]) }}" class="post-title">
                                    <h6>{{ $side_new->title }}</h6>
                                </a>
                                <p class="post-date"><span>{{ $side_new->created_at->diffForHumans() }}</span><span></span></p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @endif
                </div>
            </div>
        </div>
    </div>
<div class="popular-news-area section-padding-80-50">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-8">
                <div class="section-heading">
                    <h6>@lang('admin.populer_news')</h6>
                </div>

                <div class="row">
                    @if($newss != null)
                        @foreach($newss as $news)
                            <div class="col-12 col-md-6">
                                <div class="single-blog-post style-3">
                                    <div class="post-thumb">
                                        <a href="{{ route('single_page',['category_name'=>str_replace(' ','-',$news->category->name_en),'news_name'=>str_replace(' ','-',$news->title)]) }}"><img src="{{ url('AdminDesign') }}/uploads/news/{{ $news->file }}" alt=""></a>
                                    </div>
                                    <div class="post-data">
                                        @if(App()->getLocale() == 'ar')
                                        <a href="{{ route('category_page',['category_name'=>str_replace(' ','-',$news->category->name_en)]) }}" class="post-catagory">{{ $news->category->name_ar }}</a>
                                        @else
                                        <a href="{{ route('category_page',['category_name'=>str_replace(' ','-',$news->category->name_en)]) }}" class="post-catagory">{{ $news->category->name_en }}</a>
                                        @endif
                                        <a href="{{ route('single_page',['category_name'=>str_replace(' ','-',$news->category->name_en),'news_name'=>str_replace(' ','-',$news->title)]) }}" class="post-title">
                                            <h6>{{ $news->title }}</h6>
                                        </a>
                                        <div class="post-meta d-flex align-items-center">
                                            <a href="#" class="post-comment"><img src="{{ url('PublicDesign') }}/img/core-img/chat.png" alt=""> <span>10</span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>

            <div class="col-12 col-lg-4">
                <div class="section-heading">
                    <h6>Info</h6>
                </div>
                <!-- Popular News Widget -->
                <div class="popular-news-widget mb-30">
                    <h3>@lang('admin.most_4_news')</h3>
                    @if($most_news != null)
                        @foreach($most_news as $index=>$new)
                            <div class="single-popular-post">
                                <a href="{{ route('single_page',['category_name'=>str_replace(' ','-',$new->category->name_en),'news_name'=>str_replace(' ','-',$new->title)]) }}">
                                    <h6><span>{{ $index+1 }} .</span> {{ $new->title }}</h6>
                                </a>
                                <p>{{ $new->created_at->diffForHumans() }}</p>
                            </div>
                        @endforeach
                    @endif
                </div>

                <!-- Newsletter Widget -->
                <div class="newsletter-widget">
                    <h4>{{ __('admin.newsletter') }}</h4>
                    <p>@lang('admin.newsletter_message')</p>
                    <form action="#" method="post">
                        <input type="text" name="text" placeholder="@lang('admin.name')">
                        <input type="email" name="email" placeholder="@lang('admin.email')">
                        <button type="submit" class="btn w-100">@lang('admin.subscribe')</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="video-post-area bg-img bg-overlay" style="background-image: {{ url('PublicDesign/img/bg-img/bg1.jpg') }};">
    <div class="container">
        <div class="row justify-content-center">
            <!-- Single Video Post -->
            <div class="col-12 col-sm-6 col-md-4">
                <div class="single-video-post">
                    <!-- Video Button -->
                    <div class="videobtn">
                        <a href="https://www.youtube.com/watch?v=5BQr-j3BBzU" class="videoPlayer"><i class="fa fa-play" aria-hidden="true"></i></a>
                    </div>
                </div>
            </div>

            <!-- Single Video Post -->
            <div class="col-12 col-sm-6 col-md-4">
                <div class="single-video-post">
                    <img src="{{ url('PublicDesign') }}/img/bg-img/video2.jpg" alt="">
                    <!-- Video Button -->
                    <div class="videobtn">
                        <a href="https://www.youtube.com/watch?v=5BQr-j3BBzU" class="videoPlayer"><i class="fa fa-play" aria-hidden="true"></i></a>
                    </div>
                </div>
            </div>

            <!-- Single Video Post -->
            <div class="col-12 col-sm-6 col-md-4">
                <div class="single-video-post">
                    <img src="{{ url('PublicDesign') }}/img/bg-img/video3.jpg" alt="">
                    <!-- Video Button -->
                    <div class="videobtn">
                        <a href="https://www.youtube.com/watch?v=5BQr-j3BBzU" class="videoPlayer"><i class="fa fa-play" aria-hidden="true"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="editors-pick-post-area section-padding-80-50">
    <div class="container">
        <div class="row">
            <!-- Editors Pick -->
            <div class="col-12 col-md-7 col-lg-9">
                <div class="section-heading">
                    <h6>@lang('admin.editors')</h6>
                </div>

                <div class="row">
                    @if($skip_news != null)
                        @foreach($skip_news as $skip_new)
                            <div class="col-12 col-lg-4">
                                <div class="single-blog-post">
                                    <div class="post-thumb">
                                        <a href="{{ route('single_page',['category_name'=>str_replace(' ','-',$skip_new->category->name_en),'news_name'=>str_replace(' ','-',$skip_new->title)]) }}"><img src="{{ url('AdminDesign') }}/uploads/news/{{ $skip_new->file }}" alt=""></a>
                                    </div>
                                    <div class="post-data">
                                        <a href="{{ route('single_page',['category_name'=>str_replace(' ','-',$skip_new->category->name_en),'news_name'=>str_replace(' ','-',$skip_new->title)]) }}" class="post-title">
                                            <h6>{{ $skip_new->title }}</h6>
                                        </a>
                                        <div class="post-meta">
                                            <div class="post-date"><a href="#">{{ $skip_new->created_at }}</a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>

            <!-- World News -->
            <div class="col-12 col-md-5 col-lg-3">
                <div class="section-heading">
                    <h6>@lang('admin.world_news')</h6>
                </div>
                @if($last_news != null)
                    @foreach($last_news as $last_new)
                    <div class="single-blog-post style-2">
                        <div class="post-thumb">
                            <a href="{{ route('single_page',['category_name'=>str_replace(' ','-',$last_new->category->name_en),'news_name'=>str_replace(' ','-',$last_new->title)]) }}"><img style="height:50px;width:250px;" src="{{ url('AdminDesign') }}/uploads/news/{{ $last_new->file }}" alt=""></a>
                        </div>
                        <div class="post-data">
                            <a href="{{ route('single_page',['category_name'=>str_replace(' ','-',$last_new->category->name_en),'news_name'=>str_replace(' ','-',$last_new->title)]) }}" class="post-title">
                                <h6>{{ str_limit($last_new->title,70) }}</h6>
                            </a>
                            <div class="post-meta">
                                <div class="post-date"><a href="#">{{ $last_new->created_at }}</a></div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
