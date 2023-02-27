<nav class="main-header navbar navbar-expand navbar-dark d-flex justify-content-between">
	<!-- Left navbar links -->
	<ul class="navbar-nav ">
		<li class="nav-item"> <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
		</li>
		
	</ul>
	
	<ul class="navbar-nav ml-2 ">
		<li class="nav-item">
			<a class=" nav-link" target="_blank"  href="{{Request::root()}}" role="button">
		
			  Trang chủ Website
			</a>
		  </li>
		<li class="nav-item dropdown">
			<a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle active"> 
        		<b> <span id="full_name_text_header">Admin </span> </b>
			</a>
		
			<ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow" style="left: 0px; right: inherit;">
				<li>
					<a href="{{route('profile_admin')}}"  class="dropdown-item" class="nav-link" role="button"> <i class="fas fa-sign-out-alt"></i> Hồ sơ cá nhân</a>
				</li>
				<li>
					<a href="{{route('logout-admin')}}"  class="dropdown-item" class="nav-link" role="button"> <i class="fas fa-sign-out-alt"></i> Đăng xuất</a>
				</li>
			</ul>
		</li>	
	</ul>
</nav>