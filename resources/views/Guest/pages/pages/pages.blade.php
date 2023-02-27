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
                    <h1>{{$pages->pages_name}}</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>
     
    <!--==================================================================== 
                            end breadcumb section
    =====================================================================-->
    
    <!--==================================================================== 
                            Start about-us section
    =====================================================================-->
        <section class="about-page-content another-page pt-90 pb-40">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10">
                        <div class="about-content">
                            <h2>{{$pages->pages_name}}</h2>

                            <p>{!!$pages->pages_content!!}</p>

                        </div>
                    </div>
                    <div class="about-content-img">
                        <img src="{{asset('./themes/guest/img/about-content.png')}}" alt="">
                    </div>
                </div>
            </div>
        </section>
    <!--==================================================================== 
                            end about-us section
    =====================================================================-->

@endsection
@section('jsGuest')
@endsection