@extends('Guest.layouts.main') 
@section('main')

	<!--==================================================================== 
						Start hero section
	=====================================================================-->
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
        
    <section class="requirement-section another-page pt-65">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 text-center">
                    <div class="section-title">
                        <h2>Tra cứu thông tin khách hàng</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="requirement-text text-center">
                        <p>Nhập <b>tên khách hàng, tên công ty, số điện thoại hoặc từ khóa</b> để tra cứu thông tin : Thông tin khách hàng, thông tin dịch vụ đã sử dụng</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="search-field">
                        <form id="form-search" onsubmit="return false">
                           <div class="form-group ">
                            <div class="d-flex w-100">
                                <input class="w-100" type="text" class="keyword" id="keyword" name="keyword" placeholder="Nhập tên khách hàng, tên công ty, số điện thoại hoặc từ khóa">
                                <button class="btn-bg2" type="submit"><i class="fa fa-search"></i>Tra cứu</button>
                            </div>

                           </div>
                       </form>
                    </div>
                </div>
            </div>
            <div class="row d-none" id="result">
                <div class="col-md-12">
                    <table class="table table-bordered hover table-hover table-striped" id="table-search-info">
                    </table>
                </div>
            </div>

        </div>
    </section>
    
        <section class="featured-area pt-85 rpt-65 pb-100 bg-gray">
            <div class="d-none d-xl-block featured-round"><img src="{{route('guest.home.index')}}/themes/guest/img/feature.png" alt=""></div>
            <div class="d-none d-xl-block featured-round-small"><img src="{{route('guest.home.index')}}/themes/guest/img/small-feature.png" alt=""></div>
            <div class="container">
            {{--
                <div class="row justify-content-center">
                    <div class="col-lg-6 text-center">
                        <div class="section-title">
                            <h2>Dịch Vụ</h2>
                        </div>
                    </div>
                </div>  
                <div class="row justify-content-center">
                    @foreach (getServices() as $item)
                    <div class="col-lg-4 col-md-6">
                        <div class="featured-item wow  customFadeInUp dalay-0-1s animated" style="visibility: visible; animation-name: customFadeInUp;">
                            <div class="featured-icon violet">
                                <i class="flaticon-cms"></i>
                            </div>
                            <div class="featured-content">
                                <h5><a href="single-feature.html">{{ $item->services_name }}</a></h5>
                                <p>{!! $item->services_description !!}</p>
                            </div>
                            <div class="hover"></div>
                        </div>
                    </div>
                    @endforeach
                </div>
            --}}
            </div>
        </section>

    <!--==================================================================== 
							End service-section-style-one
	=====================================================================-->

    <!--==================================================================== -->

    @include('Guest.pages.home.modal')
    @section('jsGuest')
        <script src="{{asset('themes/admin/plugins/jquery-validation/jquery.validate.min.js')}}"></script>
        <script src="{{asset('themes/admin/plugins/datatables/jquery.dataTables.js')}}"></script>
        <script src="{{asset('themes/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.js')}}"></script>
        <script src="{{asset('themes/admin/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
        <script src="{{asset('themes/admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
        <script src="{{asset('app/guest/home/home.js')}}"></script>
        <script>
            var home = new home();
            home.datas={
                routes:{
                    search:"{{route('guest_search_info')}}",
                    information:"{{route('guest_information')}}"
                }
            }
            home.init();
    
        </script>
    
    @endsection
@endsection
