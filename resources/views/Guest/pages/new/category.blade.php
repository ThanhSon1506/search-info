@extends('Guest.layouts.main') 
@section('main')

<!--==================================================================== 
                            Start breadcumb section
    =====================================================================-->
        <section class="banner-section pt-200 pb-175">
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
    @include('Guest.components.nav_category')
    <!--==================================================================== 
                            Start about-us section
    =====================================================================-->
        <section class="about-page-content another-page">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10">
                   <!-- post-comments -->
                   @foreach ($news as $item)
                            <a href="/tin-tuc/{{$item->slug}}">
                            <div class="post-comments">
                                <!-- singlepost-comments -->
                                <div class="latest-comments mb-40">
                                    <div class="comments-box">
                                        <div>
                                            <div class="row">
                                                <div class="col-md-3">
                                                <img class="card-img-bottom" src="/uploads/{{$item->image}}" alt="Card image cap" width="120" height="60">
                                                </div>
                                                <div class="col-md-9">
                                                <div class="comments-text">
                                            <div class="avatar-name">
                                                <h5>
                                                    {{$item->title}}
                                                </h5>
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
