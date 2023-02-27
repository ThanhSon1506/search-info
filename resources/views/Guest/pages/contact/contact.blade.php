@extends('Guest.layouts.main') 
@section('main')
    <section class="banner-section pt-200 pb-75">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="page-title text-center">
                        <h1>Liên hệ</h1> 
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="map-section another-page">
        <div class="container">

            <div class="row">
                <div class="col-md-7 form-wrapper">
                    <div class="form-box">
                       <div class="contact-form">
                           <form id="contact-form" onsubmit="return false">
                               <div class="form-group">
                                   <input type="text" id="contact_name" name="contact_name" placeholder="Họ và tên" required="">
                               </div>
                               <div class="row">
                                   <div class="col-md-6 contact-margin-bottom-form">
                                    <div class="form-group">
                                        <input type="text" id="contact_phone" name="contact_phone" placeholder="Nhập Số điện thoại" required="">
                                    </div>
                                   </div>
                                   <div class="col-md-6 contact-margin-bottom-form">
                                    <div class="form-group">
                                        <input type="text" id="contact_email" name="contact_email" placeholder="Nhập email">
                                    </div>
                                   </div>
                               </div>
                               
                               <div class="form-group mt-5">
                                   <textarea name="contact_content" id="contact_content" placeholder="Lời nhắn" required></textarea>
                               </div>
                               <div class="form-group" id="captcha-form">
                                <label id="captcha-name"></label>

                                        <input id="captcha-result" name="captcha" type="text" class="form-control"/>

                                    </div>
                                    <div class="form-group" id="div_sendContact">
                                   <button type="button" class="btn-bg" id="sendContact">Gửi ngay</button>
                               </div>
                               <div class="form-group" id="div_submitContact">
                                <button id="submitContact" class="btn-bg" type="submit" data-loading-text="Please wait...">Gửi ngay</button>
                            </div>
                           </form>
                       </div>
                    </div>
                </div>
                <div class="col-md-5 map-wrapper">
                    <div class="map" style="padding-top: 0">
                        <iframe src="{{getConfigSetting()->url_map}}" style="border:0" allowfullscreen=""></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>
<!--==================================================================== 
                        Start Get in Touch section
=====================================================================-->
    <section class="get-in-touch-section pt-95">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <div class="section-title">
                        <h2>Get in Touch</h2>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="get-in-touch-service-wrap">
                        <div class="row">
                            <div class="col-lg-4 col-md-6">
                                <div class="contact-item text-center wow animated customFadeInUp delay-0-1s">
                                    <div class="service-icon zero">
                                        <i class="flaticon-placeholder"></i>
                                    </div>
                                    <div class="service-content">
                                        <span>1301 Hoffman Avenue, <br>Brooklyn New York, NY-11206</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="contact-item text-center wow animated customFadeInUp delay-0-2s">
                                    <div class="service-icon code">
                                        <i class="flaticon-phone-call"></i>
                                    </div>
                                    <div class="service-content">
                                        <span>+1 (856) 456-1256 <br>+1 (256) 385-8564</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="contact-item text-center wow animated customFadeInUp delay-0-3s">
                                    <div class="service-icon team">
                                        <i class="flaticon-message"></i>
                                    </div>
                                    <div class="service-content">
                                        <span>info@website.com <br>sales@website.com</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--==================================================================== 
                        End Get in Touch section
=====================================================================-->
<style>
    .contact-margin-bottom-form {
        margin-bottom: 35px;
    }
</style>
@endsection
@section('jsGuest')
<!-- Toastr -->
<link rel="stylesheet" href="{{ asset('themes/admin/plugins/toastr/toastr.min.css')}}">
<script src="{{ asset('themes/admin/plugins/toastr/toastr.min.js')}}"></script>

<script src="{{asset('themes/admin/plugins/jquery-validation/jquery.validate.min.js')}}"></script>
<script src="{{asset('themes/admin/plugins/jquery-validation/additional-methods.min.js')}}"></script>

<?php
function get_client_ip() {
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if(isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}

?>
<script>
    var url_submit_contact = "{{route('guest_insert_contact')}}";
    var getIP = "<?php echo $_SERVER['REMOTE_ADDR']?>'";

</script>
<script src="{{asset('app/guest/main.js')}}"></script>

<script src="{{asset('app/guest/contact/contact.js')}}"></script>
@endsection