@extends('layouts.app')
@section('content')
    <div class="blog-area section-padding-0-80">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-8">
                    <div class="blog-posts-area">

                        <!-- Single Featured Post -->
                        <div class="single-blog-post featured-post single-post">
                            <div class="post-thumb">
                                <a href="#"><img src="{{ url('AdminDesign') }}/uploads/news/{{ $news->file }}" alt=""></a>
                            </div>
                            <div class="post-data">
                                @if(App()->getLocale() == 'ar')
                                    <a href="{{ route('category_page',['category_name'=>str_replace(' ','-',$news->category->name_en)]) }}" class="post-catagory">{{ $news->category->name_ar }}</a>
                                @else
                                    <a href="{{ route('category_page',['category_name'=>str_replace(' ','-',$news->category->name_en)]) }}" class="post-catagory">{{ $news->category->name_en }}</a>
                                @endif
                                <a href="#" class="post-title">
                                    <h6>{{ $news->title }}</h6>
                                </a>
                                <div class="post-meta">
                                    <p class="post-author">@lang('admin.by') <a href="#">{{ $news->admin->name }}</a></p>
                                    {!! $news->content !!}
                                     <div class="newspaper-post-like d-flex align-items-center justify-content-between">
                                        <!-- Tags -->
                                        <div class="newspaper-tags d-flex">
                                            <span>Tags:</span>
                                            <ul class="d-flex">
                                                <li><a href="#">finacial,</a></li>
                                                <li><a href="#">politics,</a></li>
                                                <li><a href="#">stock market</a></li>
                                            </ul>
                                        </div>

                                        <!-- Post Like & Post Comment -->
                                        <div class="d-flex align-items-center post-like--comments">
                                            <a href="#" class="post-comment"><img src="{{ url('PublicDesign') }}/img/core-img/chat.png" alt=""> <span>10</span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- About Author -->
                        <div class="blog-post-author d-flex">
                            <div class="author-thumbnail">
                                <img src="{{ url('AdminDesign') }}/uploads/admins/{{ $news->admin->file->file_name }}" alt="">
                            </div>
                            <div class="author-info">
                                <a href="#" class="author-name">{{ $news->admin->name }} <span>@lang('admin.by')</span></a>
                                <p>Donec turpis erat, scelerisque id euismod sit amet, fermentum vel dolor. Nulla facilisi. Sed pellen tesque lectus et accu msan aliquam. Fusce lobortis cursus quam, id mattis sapien.</p>
                            </div>
                        </div>

                        <div class="pager d-flex align-items-center justify-content-between">
                            <div class="prev">
                                @if($prev_news != null)
                                    <a href="{{ route('single_page',['category_name'=>str_replace(' ','-',$prev_news->category->name_en),'news_name'=>str_replace(' ','-',$prev_news->title)]) }}" class="active"><i class="fa fa-angle-left"></i> @lang('admin.previous')</a>
                                @endif
                            </div>
                            <div class="next">
                                @if($next_news != null)
                                    <a href="{{ route('single_page',['category_name'=>str_replace(' ','-',$next_news->category->name_en),'news_name'=>str_replace(' ','-',$next_news->title)]) }}">@lang('admin.next') <i class="fa fa-angle-right"></i></a>
                                @endif
                            </div>
                        </div>

                        <div class="section-heading">
                            <h6>@lang('admin.related')</h6>
                        </div>

                        <div class="row">
                            @foreach($down_news as $new)
                                <div class="col-12 col-md-6">
                                <div class="single-blog-post style-3 mb-80">
                                    <div class="post-thumb">
                                        <a href="#"><img src="{{ url('AdminDesign') }}/uploads/news/{{ $new->file }}" alt=""></a>
                                    </div>
                                    <div class="post-data">
                                        @if(App()->getLocale() == 'ar')
                                            <a href="{{ route('category_page',['category_name'=>str_replace(' ','-',$news->category->name_en)]) }}" class="post-catagory">{{ $new->category->name_ar }}</a>
                                        @else
                                            <a href="{{ route('category_page',['category_name'=>str_replace(' ','-',$news->category->name_en)]) }}" class="post-catagory">{{ $new->category->name_en }}</a>
                                        @endif
                                        <a href="{{ route('single_page',['category_name'=>str_replace(' ','-',$news->category->name_en),'news_name'=>str_replace(' ','-',$news->title)]) }}" class="post-title">
                                            <h6>{{ $new->title }}</h6>
                                        </a>
                                        <div class="post-meta d-flex align-items-center">
                                            <a href="#" class="post-comment"><img src="{{ url('PublicDesign') }}/img/core-img/chat.png" alt=""> <span>10</span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div id="disqus_thread"></div>
                        <script>

                            /**
                             *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
                             *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/
                            /*
                            var disqus_config = function () {
                            this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
                            this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
                            };
                            */
                            (function() { // DON'T EDIT BELOW THIS LINE
                                var d = document, s = d.createElement('script');
                                s.src = 'https://project-laravel.disqus.com/embed.js';
                                s.setAttribute('data-timestamp', +new Date());
                                (d.head || d.body).appendChild(s);
                            })();
                        </script>
                        <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
                    </div>
                </div>

                <div class="col-12 col-lg-4">
                    <div class="blog-sidebar-area">

                        <!-- Latest Posts Widget -->
                        <div class="latest-posts-widget mb-50">

                            @foreach($down_news as $new)
                            <div class="single-blog-post small-featured-post d-flex">
                                <div class="post-thumb">
                                    <a href="#"><img src="{{ url('AdminDesign') }}/uploads/news/{{ $new->file }}" alt=""></a>
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
                                        <p class="post-date"><span>{{ $new->created_at->format('m-y') }}</span></p>
                                    </div>
                                </div>
                            </div>
                            @endforeach


                        </div>

                        <!-- Popular News Widget -->
                        <div class="popular-news-widget mb-50">
                            <h3>@lang('admin.most_4_news')</h3>
                            @foreach($most_news as $index=>$news)
                                <div class="single-popular-post">
                                    <a href="{{ route('single_page',['category_name'=>str_replace(' ','-',$news->category->name_en),'news_name'=>str_replace(' ','-',$news->title)]) }}">
                                        <h6><span>{{ $index+1 }}</span>{{ $news->title }}</h6>
                                    </a>
                                    <p>{{ $news->created_at->format('m-y') }}</p>
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
