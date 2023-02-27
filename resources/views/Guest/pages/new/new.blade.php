@extends('Guest.layouts.main') 
@section('main')

<!--==================================================================== 
                            Start breadcumb section
    =====================================================================-->
        <section class="banner-section pt-200 pb-75">
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
                <div aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('guest.home.index')}}">Trang chủ</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Tin tức</li>
                </ol>
                </div>
            </div>
    </div>
    <!--==================================================================== 
                            Start about-us section
    =====================================================================-->
        <section class="about-page-content another-page">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10">
                        <!-- post-comments -->
                            @foreach (getNews() as $item)
                            <a href="/tin-tuc/{{$item->slug}}">
                            <div class="post-comments">
                                <!-- singlepost-comments -->
                                <div class="latest-comments fix-comments mb-20">
                                    <div class="comments-box">
                                        <div>
                                            <div class="row">
                                                <div class="col-md-3">
                                                <img class="card-img-bottom fix-img-news" src="/uploads/{{$item->image}}" alt="Card image cap" width="120" height="60">
                                                </div>
                                                <div class="col-md-9">
                                                <div class="comments-text">
                                            <div class="avatar-name">
                                                <h5>
                                                    {{$item->title}}
                                                </h5>
                                                <span>
                                                {{fixDate($item->created_at)}}
                                                </span>
                                            </div>
                                            <p>
                                                {!!$item->summary!!}
                                            </p>
                                        </div>
                                                </div>
                                            </div>
                                        </div>
                            
                                    </div>
                                </div>
                                </div>
                            </a>
                            @endforeach
                            
                            {{ getNews()->links() }}
                         <!-- post-comments -->
                    </div>
            
                </div>
            </div>
        </section>
    <!--==================================================================== 
                            end about-us section
    =====================================================================-->
<script src="{{asset('app/guest/new/new.js')}}"></script>
@endsection
@section('jsGuest')
@endsection
