@extends('layouts.app')
@section('content')
    <div class="blog-area section-padding-0-80">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-8">
                    <div class="blog-posts-area">

                        @foreach($news as $new)
                        <div class="single-blog-post featured-post mb-30">
                            <div class="post-thumb">
                                <a href="#"><img src="{{url('AdminDesign')}}/uploads/news/{{ $new->file }}" alt=""></a>
                            </div>
                            <div class="post-data">
                                @if(App()->getLocale() == 'ar')
                                <a href="{{ route('category_page',['category_name'=>str_replace(' ','-',$new->category->name_en)]) }}" class="post-catagory">{{ $new->category->name_ar }}</a>
                                @else
                                <a href="{{ route('category_page',['category_name'=>str_replace(' ','-',$new->category->name_en)]) }}" class="post-catagory">{{ $new->category->name_en }}</a>
                                @endif
                                <a href="{{ route('single_page',['category_name'=>str_replace(' ','-',$new->category->name_en),'news_name'=>str_replace(' ','-',$new->title)]) }}" class="post-title">
                                    <h6>{{ $new->title }}</h6>
                                </a>
                                <div class="post-meta">
                                    <p class="post-author">@lang('admin.by') <a href="#">{{ $new->admin->name }}</a></p>
                                    <p class="post-excerp">{!! str_limit($new->content,330) !!}</p>
                                    <div class="d-flex align-items-center"><a href="#" class="post-comment"><img src="{{url('PublicDesign')}}/img/core-img/chat.png" alt=""> <span>10</span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <nav aria-label="Page navigation example">
                        <ul class="pagination mt-50">
                            {{ $news->links() }}
                        </ul>
                    </nav>
                </div>

                <div class="col-12 col-lg-4">
                    <div class="blog-sidebar-area">

                        <!-- Latest Posts Widget -->
                        <div class="latest-posts-widget mb-50">

                            @foreach($side_news as $new)
                                <div class="single-blog-post small-featured-post d-flex">
                                    <div class="post-thumb">
                                        <a href="#"><img src="{{url('AdminDesign')}}/uploads/news/{{ $new->file }}" alt=""></a>
                                    </div>
                                    <div class="post-data">
                                        @if(App()->getLocale() == 'ar')
                                            <a href="{{ route('category_page',['category_name'=>str_replace(' ','-',$new->category->name_en)]) }}" class="post-catagory">{{ $new->category->name_ar }}</a>
                                        @else
                                            <a href="{{ route('category_page',['category_name'=>str_replace(' ','-',$new->category->name_en)]) }}" class="post-catagory">{{ $new->category->name_en }}</a>
                                        @endif
                                        <div class="post-meta">
                                            <a href="{{ route('single_page',['category_name'=>str_replace(' ','-',$new->category->name_en),'news_name'=>str_replace(' ','-',$new->title)]) }}" class="post-title">
                                                <h6>{{ $new->title }}</h6>
                                            </a>
                                            <p class="post-date"><span>{{ $new->created_at->format('m/Y') }}</span></p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Popular News Widget -->
                        <div class="popular-news-widget mb-50">
                            <h3>@lang('admin.most_4_news')</h3>

                            @foreach($last_news as $index=>$last_new)
                                <div class="single-popular-post">
                                    <a href="{{ route('single_page',['category_name'=>str_replace(' ','-',$last_new->category->name_en),'news_name'=>str_replace(' ','-',$last_new->title)]) }}">
                                        <h6><span>{{ $index + 1 }}</span>{{ $last_new->title }}</h6>
                                    </a>
                                    <p>{{ $last_new->created_at->format('m-y') }}</p>
                                </div>
                            @endforeach
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
    </div>
@endsection
