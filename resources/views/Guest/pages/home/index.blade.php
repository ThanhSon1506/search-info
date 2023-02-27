@extends('Guest.layouts.main') 
@section('main')
	<section class="hero-section py-100 bg-img d-flex align-items-center hero-background">
	    <div class="container">
	        <div class="row">
	            <div class="col-md-7">
                    @foreach(json_decode(getConfigSetting()->header_project) as $data)
                    <div class="hero-text">
						<h1>{{$data->title}}</h1>
						<p>{!!$data->des!!}</p>
						<a href="https://google.com" class="btn">Bắt đầu</a>
					</div>
                    @endforeach
					
	            </div>

	            <div class="d-none d-md-block wow  customFadeInRight hero-animation-image animated" style="visibility: visible; animation-name: customFadeInRight;">
                    <img src="{{route('guest.home.index')}}/themes/guest/img/hero-right.png" alt="">
                </div>
                <div class="d-none d-md-block wow  customFadeInLeft tob-animation-image animated" style="visibility: visible; animation-name: customFadeInLeft;">
                    <img src="{{route('guest.home.index')}}/themes/guest/img/tob.png" alt="">
                </div>
	        </div>
	    </div>
	</section>

    <section class="service-section-one pt-85 rpt-65 pb-45 bg-gray">
            <div class="container">
                <div class="row">
                    @foreach(fetchHeaderHome() as $item)
                        <!-- single-service -->
                        <div class="col-lg-3 col-md-6">
                            <div class="single-service service-style-one text-center wow animated customFadeInUp delay-0-1s">
                                <div class="service-icon zero">
                                    <i class="{{$item->icon}}"></i>
                                </div>
                                <div class="service-content">
                                    <h5><a href="single-service.html">{{$item->title}}</a></h5>
                                    <p>{!!$item->des!!}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
    </section>

    <section class="skill-area pt-1 pb-60 bg-gray">
            <div class="container">
            @foreach(json_decode(getConfigSetting()->skill_area) as $data)
                <div class="row justify-content-center">
                    <div class="col-lg-8 text-center">
                        <div class="section-title">
                            <h2>{{$data->title}}</h2>
                            <p>{!!$data->des!!}</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-7">
                        <div class="skill-note-img rmb-50">
                            <img class="skill-bg" src="/themes/guest/img/skill/skill-bg.png" alt="">
                            <img class="notpad" src="/themes/guest/img/skill/skill-note.png" alt="">
                            <img class="leaf" src="/themes/guest/img/skill/leaf.png" alt="">
                        </div>
                    </div>
                    <div class="col-md-5 mt-27">
                        <div class="row">
                            @foreach(fetchSkillArea() as $data)
                            <div class="col-lg-10 col-md-12">
                                <div class="skill-item wow animated customFadeInUp delay-0-1s">
                                    <i class="flaticon-checked"></i><h5>{{$data->title}}</h5>
                                </div>
                            </div>
                            @endforeach
                        </div>

                    </div>
					
                </div>
            @endforeach
            </div>
    </section>
    <section class="featured-area pt-1 pb-1">
            <div class="d-none d-xl-block featured-round"><img src="{{route('guest.home.index')}}/themes/guest/img\feature\feature.png" alt=""></div>
            <div class="d-none d-xl-block featured-round-small"><img src="{{route('guest.home.index')}}/themes/guest/img\feature\small-feature.png" alt=""></div>
            <div class="container">
            @foreach(json_decode(getConfigSetting()->featureds) as $data)
                <div class="row justify-content-center">
                    <div class="col-lg-6 text-center">
                        <div class="section-title">
                            <h2>{{$data->title}}</h2>
                            <p>{!!$data->des!!}</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @foreach(fetchFeatureds() as $data)
                        <!-- single-featured -->
                        <div class="col-lg-4 col-md-6">
                            <div class="featured-item wow animated customFadeInUp dalay-0-1s">
                                <div class="featured-icon violet">
                                    <i class="{{$data->icon}}"></i>
                                </div>
                                <div class="featured-content">
                                    <h5><a href="single-feature.html">{{$data->title}}</a></h5>
                                    <p>{!!$data->des!!}</p>
                                </div>
                                <div class="hover"></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach
            </div>
    </section>
    <section class="our-team-section py-1 bg-gray">
            <div class="container">
                 @foreach(json_decode(getConfigSetting()->awesome) as $data)
                    <div class="row justify-content-center">
                        <div class="col-lg-6 text-center">
                            <div class="section-title">
                                <h2>{{$data->title}}</h2>
                                <p>{!!$data->des!!}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="row">
                    <div class="col-lg-12 team-slider owl-carousel">
                        @foreach(fetchAwesome() as $data)
                        <!-- single-team member -->
                        <div class="single-team-member wow animated customFadeInUp delay-0-1s">
                            <div class="team-thumb">
                                <img class="rounded-circle w-100 h-100" src="/themes/guest/img/team/{{$data->image}}" alt="">
                            </div>
                            <div class="team-info">
                                <h5>{{$data->name}}</h5>
                                <h6>{{$data->position}}</h6>
                                <p>{!!$data->des!!}</p>
                                <!-- <div class="team-social-link">
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                    <a href="#"><i class="fa fa-linkedin"></i></a>
                                </div> -->
                            </div>
                        </div>
                        @endforeach

                    </div>
                </div>
            </div>
    </section>
    <section class="funfact bg-gray pt-75 pb-130">
            <div class="container">
            @foreach(json_decode(getConfigSetting()->funfact) as $data)
                <div class="row justify-content-center">
                    <div class="col-12 text-center">
                        <div class="section-title">
                            <h2>{{$data->title}}</h2>
                            <p>{!!$data->des!!}</p>
                        </div>
                    </div>
                </div>
                @endforeach
                <div class="row">
                    @foreach(fetchFunfact() as $data)
                        <!-- single-item -->
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="stat-item mb-50 text-center wow animated customFadeInUp fast">
                                <div class="count" data-from="1" data-to="{{$data->count}}" data-speed="3000"></div>
                                <p class="text">{{$data->title}}</p>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
    </section>
    <section class="blog-section gray-bg pt-2">
            <div class="container">
            @foreach(json_decode(getConfigSetting()->clients) as $data)
                <div class="row justify-content-center">
                    <div class="col-lg-8 text-center">
                        <div class="section-title">
                            <h2>{{$data->title}}</h2>
                            <p>{!!$data->des!!}</p>
                        </div>
                    </div>
                </div>
            @endforeach
                <div class="partner-carousel owl-carousel">
                    @foreach(fetchClients() as $data)
                    <!-- single item -->
                    <div class="item">
                        <a href="#">
                            <img src="/themes/guest/img/clients/{{$data->image}}" alt="logo">
                            <img src="/themes/guest/img/clients/{{$data->image_color}}" alt="logo">
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
    </section>
    @include('Guest.pages.home.modal')
    @section('jsGuest')
        <script src="{{asset('themes/guest/js/owl.carousel.min.js')}}"></script>
    @endsection
@endsection
