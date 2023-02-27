@extends('Admin.layouts.main') 
@section('main')
<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0 text-dark">Tổng Quan</h1>
			</div>
			<!-- /.col -->
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="{{route('dashboard')}}/">Tổng Quan</a>
					</li>{{--
					<li class="breadcrumb-item active">Dashboard v1</li>--}}</ol>
			</div>
			<!-- /.col -->
		</div>
		<!-- /.row -->
	</div>
	<!-- /.container-fluid -->
</div>
<div class="container-fluid">

	<div class="row">
		<div class="col-md-12">
			<div class="row">
				<div class="col-sm-12 col-md-6 col-lg-4 ">
					<!-- small box -->
					<div class="small-box bg-primary">
						<div class="inner">
							<h5 id="countCustomers">{{countUser()}}</h5>
							<p>Tổng Thành Viên</p>
						</div>
						<div class="icon"> <i class="fa fa-users" aria-hidden="true"></i>
						</div>
						<a href="" class="small-box-footer">Xem chi tiết <i class="fas fa-arrow-circle-right"></i></a>
					</div>
				</div>
				<!-- ./col -->
				<div class="col-sm-12 col-md-6 col-lg-4 ">
					<!-- small box -->
					<div class="small-box bg-warning">
						<div class="inner">
							<h5 class="countPublished">{{countProjects()}}</h5> 
							<p>Tổng Dự án</p>
						</div>
						<div class="icon"> <i class="far fa-file-alt" aria-hidden="true"></i>
						</div>
						<a href="" class="small-box-footer">Xem chi tiết <i class="fas fa-arrow-circle-right"></i></a>
					</div>
				</div>
				
				<div class="col-sm-12 col-md-6 col-lg-4 ">
					<!-- small box -->
					<div class="small-box bg-success">
						<div class="inner">
							<h5 class="countPending">{{countServices()}}</h5>
							<p>Tổng Dịch Vụ</p>
						</div>
						<div class="icon"><i class="fas fa-list-alt"></i>
						</div>
						<a href="" class="small-box-footer">Xem chi tiết <i class="fas fa-arrow-circle-right"></i></a>
					</div>
				</div>
				<!-- ./col -->

				<!-- ./col -->
			</div>

		</div>
		
	</div>
</div>
@endsection
@section('jsAdmin')
@endsection