<!--==================================================================== 
                    Start header area
=====================================================================-->

<header class="main-header">

    <!--Header-Upper-->
    <div class="header-upper">
        <div class="container clearfix p-0">

            <div class="header-inner clearfix d-lg-flex p-0">
                <div class="logo-outer p-0 d-flex justify-content-center align-items-center">
                    <div class="logo logo-none"><a href="{{route('guest.home.index')}}"><img src="{{route('guest.home.index')}}/uploads/{{ getConfigMail()->guest_logo_header }}" alt="" title=""></a></div>
                    <div class="fixed-logo"><a href="{{route('guest.home.index')}}"><img src="{{route('guest.home.index')}}/uploads/{{ getConfigMail()->guest_logo_header }}" alt="" title=""></a></div>
                </div>

                <!-- Main Menu -->
                <nav class="main-menu navbar-expand-md ml-md-auto">
                    <div class="navbar-header clearfix">
                    <div class="logo "><a href="{{route('guest.home.index')}}"><img src="{{route('guest.home.index')}}/uploads/{{ getConfigMail()->guest_logo_header }}" alt="" title=""></a></div>
                    <div class="fixed-logo"><a href="{{route('guest.home.index')}}"><img src="{{route('guest.home.index')}}/uploads/{{ getConfigMail()->guest_logo_header }}" alt="" title=""></a></div>
                        <!-- Toggle Button -->
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse-one">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>

                    <div class="navbar-collapse navbar-collapse-one collapse clearfix">
                        <ul class="navigation clearfix">
                            <li><a href="{{route('guest.home.index')}}">Trang chủ</a></li>
                            
                            <li class="dropdown cursor-pointer text-white"><a  onclick="window.location='{{ route('guest.news.home') }}'">Tin tức</a>
                                        <ul>
                                            @foreach(fetchCategories() as $category)
                                                <li class="dropdown"><a onclick="window.location='/tin-tuc/danh-muc/{{$category->slug}}'">{{$category->name}}</a>
                                                    <ul>
                                                        @if(!empty($category->childrenCategories[0]))
                                                            @foreach($category->childrenCategories as $child)
                                                                    @include('guest.components.child_category',['child'=>$child])
                                                            @endforeach
                                                        @else
                                                            <li class="hidden"><a onclick="window.location='/tin-tuc/danh-muc/{{$category->slug}}'"></a></li>
                                                        @endif
                                                    </ul>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>
                           <!-- <li><a href="{{route('guest.news.home')}}">Tin tức</a></li> -->
                            @foreach (getPages() as $item)
                                    <li>
                                        <a href="{{route('guest_pages',$item->pages_slug)}}">{{$item->pages_name}}</a>
                                    </li>
                            @endforeach
                            <li><a href="{{route('guest_contact')}}">Liên hệ</a></li>
                            <li><a href="{{route('guest.search.index')}}">Tra cứu</a> </li>
                        </ul>
                    </div>
                </nav>
                <!-- Main Menu End-->
            </div>

        </div>
    </div>
    <!--End Header Upper-->

</header>

<!--==================================================================== 
                    End header area
=====================================================================-->
