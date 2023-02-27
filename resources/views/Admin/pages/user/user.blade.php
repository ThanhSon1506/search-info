@extends('admin.layouts.main')
@section('main')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Khách hàng / Công ty</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Admin</a></li>
            <li class="breadcrumb-item active">Khách hàng</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="card card-solid">
      <div class="card-body pb-0">
          <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                    <input class="form-control" id="search" name="search" placeholder="Nội dung tìm kiếm ...">
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group row">
                <button type="submit" class="btn btn-info formSearch">Tìm kiếm</button>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group text-right">
                    <button type="button" class="btn btn-success" id="btn-insert"><i class="fa fa-plus" aria-hidden="true"></i> Thêm Mới</button>
                </div>
              </div>
          </div>

          <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered hover table-hover table-striped" id="table-users">
                </table>
            </div>
        </div>

      </div>
      <!-- /.card-footer -->
    </div>
    <!-- /.card -->

  </section>
    @include('Admin.pages.user.modal')
    @section('jsAdmin')
    <script src="{{asset('app/admin/user/user.js')}}"></script>
<script>
  
var user = new user(); 
	    user.datas={
	        routes:{
	            datatable:"{{route('user_datatable')}}",
              insert:"{{route('user_insert')}}",
	            update:"{{route('user_update')}}",
			        delete:"{{route('user_delete')}}"
	        }
	    }   
	    user.init();
</script>
@endsection
  
  <!-- /.content -->
  @endsection