<!--==================================================================== 
                    Start footer section
=====================================================================-->

<footer class="mt-65 footer">
    <div class="container">
        <div class="row">

            <!--big column-->
            <div class="col-md-7">
                <div class="row">

                    <!--Footer Column-->
                    <div class="col-sm-7">
                        <div class="footer-widget logo-widget">
                            <div class="footer-logo"><a href="{{route('guest.home.index')}}"><img src="{{route('guest.home.index')}}/uploads/{{ getConfigMail()->guest_logo_footer }}" alt=""></a></div>
                            <div class="widget-content">
                                <div class="text">
                                    <p>
                                        {{ getConfigMail()->guest_description_footer }}
                                    </p>
                                </div>
                                <div class="footer-social-icon">
                                    <ul class="social-icon-one">
                                        <li><a href="https://www.facebook.com/INGVIETNAM" target="_blank"><i class="fa fa-facebook-f"></i></a> </li>
                                        <li><a href="https://www.youtube.com/channel/UCCHaUzCIKSJnG7-WfhrT55g" target="_blank"><i class="fa fa-youtube"></i></a> </li>
                                        <li><a href="https://www.instagram.com/ing_viet_nam/" target="_blank"><i class="fa fa-instagram"></i></a> </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--big column-->
            <div class="col-md-5">
                <div class="row">
                    <!--Footer Column-->
                    <div class="col-sm-6 mb-10">
                        <div class="footer-widget links-widget float-lg-right">
                            <h5 class="footer-title">Trang chủ</h5>
                            <div class="widget-content">
                                <ul class="list">
                                    @foreach (getPages() as $item)
                                    <li>
                                        <a href="{{route('guest_pages',$item->pages_slug)}}">{{$item->pages_name}}</a>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>

                      <!--Footer Column-->
                      <div class="col-sm-6 mb-30">
                                <div class="footer-widget links-widget float-lg-right">
                                    <h5 class="footer-title">Liên hệ</h5>
                                    <div class="widget-content">
                                        <ul class="list">
                                            <li><a href="{{ route('guest.news.home') }}">Tin tức</a></li>
                                            <li><a href="#">Tra cứu</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                </div>
            </div>

        </div>
    </div>

    <!--Copyright-->
    <div class="footer-bottom">
        <div class="copyright">Copyright @ <?=(date("Y"))?> <a href="http://google.com"> ING</a> All rights reserved.</div>
    </div>
</footer>


<!--==================================================================== 
                    End footer section
=====================================================================-->