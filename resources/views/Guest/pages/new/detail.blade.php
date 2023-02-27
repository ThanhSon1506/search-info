@extends('Guest.layouts.main') 
@section('main')

<!--==================================================================== 
                            Start breadcumb section
    =====================================================================-->
        <section class="banner-section pb-175">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="page-title text-center">
                        <h1>Tin tức</h1> 
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <!--==================================================================== 
                            end breadcumb section
    =====================================================================-->
<div class="about-page-content another-page">
    <div class="container">
            <div aria-label="breadcrumb" class=" m-3">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('guest.home.index')}}">Trang chủ</a></li>
                <li class="breadcrumb-item"><a href="{{route('guest.news.home')}}">Tin tức</a></li>
                <li class="breadcrumb-item active" aria-current="page">Chi tiết</li>
            </ol>
            </div>
        </div>
</div>
    <!--==================================================================== 
                            Start about-us section
    =====================================================================-->
        <section class="about-page-content another-page ">
            <div class="container">
             <!--==================================================================== 
                            Start Blog section
    =====================================================================-->
       
            <div class="sidebar-page-container another-page">

                <div class="container">
                
                    <div class="row">
                        <div class="col-lg-8">
                            
                            <div class="blog-details-wrap">
                            
                            <!-- blog-post-inner -->
                                <div class="single-blog-post-inner">
                                    <div class="post-admin">
                                        <div class="post-admin-left">
                                            <div class="single-blog-post-date">
                                                <ul>
                                                    <!-- fixDate -->
                                                    <li><a href="#">{{fixDate($news->created_at)}}</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                    
                                        <!-- Facebook Share Button -->
                                        <a class="button_share share facebook" href="http://www.facebook.com/sharer/sharer.php?u={{route('guest.home.index')}}/tin-tuc/{{$news->slug}}"><i class="fa fa-facebook"></i> Share</a>
                                        <!-- Googple Plus Share Button -->
                                        <a class="button_share share gplus" href="https://plus.google.com/share?url={{route('guest.home.index')}}/tin-tuc/{{$news->slug}}"><i class="fa fa-google-plus"></i> Share</a>
                                        <!-- Twitter Share Button -->
                                        <a class="button_share share twitter" href="https://twitter.com/intent/tweet?text={{$news->title}}&url={{route('guest.home.index')}}/tin-tuc/{{$news->slug}}"><i class="fa fa-twitter"></i> Tweet</a>
                                        <!-- Pinterest Share Button -->
                                        <a class="button_share share pinterest" href="http://pinterest.com/pin/create/button/?url={{route('guest.home.index')}}&description={{$news->title}}"><i class="fa fa-pinterest"></i> Pin it</a>
                                        <!-- Stumbleupon Share Button -->
                                        <a class="button_share share stumbleupon" href="http://www.stumbleupon.com/submit?url={{route('guest.home.index')}}/tin-tuc/{{$news->slug}}&title={{$news->title}}"><i class="fa fa-stumbleupon"></i> Stumble</a>
                                        <!-- LinkedIn Share Button -->
                                        <a class="button_share share linkedin" href="http://www.linkedin.com/shareArticle?mini=true&url={{route('guest.home.index')}}/tin-tuc/{{$news->slug}}&title={{$news->title}}&source={{route('guest.home.index')}}/tin-tuc/{{$news->slug}}"><i class="fa fa-linkedin"></i> LinkedIn</a>
                                        <div class="clearfix">
                                    </div>
                                        <div class="blog-inner-img d-flex align-items-center justify-content-center">
                                            <img src="/uploads/{{$news->image}}" alt="blog image">
                                        </div>
                                        
                                    <h4>{{$news->title}}</h4>
                                    <div class="post-content">
                                            <p>{!!$news->content!!}</p>
                                    </div>
                                </div>
                            <!-- end blog-post-inner -->

                            
                                <!-- post-comments -->

                                <!-- post-comments -->
                            </div>
                        </div>

                        <!--sedebar area-->
                        <div class="col-lg-4">
                            <div class="sidebar-area">
                                <div class="sidebar-widget sidebar-news">
                                    <div class="news-title">
                                        <div class="inner-title">
                                            <h5>Bài viết mới</h5>
                                        </div>
                                        <ul class="top-news-item">
                                            @foreach (getNews() as $item)
                                            <li><h6><span>{{$loop->index+1}}</span><a href="/tin-tuc/{{$item->slug}}">{{$item->title}}</a></h6></li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>

                                <!--categories Widget-->
                                <div class="sidebar-widget category-widget">
                                    <div class="inner-title">
                                        <h5>Danh mục</h5>
                                    </div>
                                    @foreach (fetchCategories() as $item)
                                    <ul>
                                        <li><a href="/tin-tuc/danh-muc/{{$item->slug}}">{{$item->name}}</a></li>
                                    </ul>
                                    @endforeach


                        
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>


        <!--==================================================================== 
                            End Blog section
    =====================================================================-->
            </div>
        </section>
    <!--==================================================================== 
                            end about-us section
    =====================================================================-->
<script src="{{asset('app/guest/new/new.js')}}"></script>
@endsection
@section('jsGuest')
@endsection
