@extends('admin.layouts.main')
@section('main')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Dịch vụ</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Admin</a></li>
            <li class="breadcrumb-item active">Dịch vụ</li>
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
                <table class="table table-bordered hover table-hover table-striped" id="table-services">
                </table>
            </div>
        </div> 

      </div>
      <!-- /.card-footer -->
    </div>
    <!-- /.card -->

  </section>
    @include('Admin.pages.service.modal')
    @section('jsAdmin')
    <script src="{{asset('app/admin/service/service.js')}}"></script>
<script>
  
var service = new service(); 
	    service.datas={
	        routes:{
	          datatable:"{{route('service_datatable')}}",
            insert:"{{route('service_insert')}}",
	          update:"{{route('service_update')}}",
			      delete:"{{route('service_delete')}}"
	        }
	    }   
	    service.init();   
</script>
@endsection
  
  <!-- /.content -->
  @endsection