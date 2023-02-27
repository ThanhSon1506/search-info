@extends('admin.layouts.main')
@section('main')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Danh mục</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Admin</a></li>
            <li class="breadcrumb-item active">Danh mục</li>
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
              <div class="col-md-5 ">
                <div class="form-group">
                    <input class="form-control" id="search" name="search" placeholder="Nội dung tìm kiếm ...">
                </div>
              </div>
              <div class="col-md-1 ">
                <div class="form-group row">
                <button type="submit" class="btn btn-info" id="search">Tìm kiếm</button>
                </div>
              </div>
              <div class="col-md-4 ">
                  <select name="category" id="category" class=" form-control form-control-sm">
                    <option selected  value="">--Chọn danh mục--</option>
                    @foreach (getCategories() as $item)
                    <option value="{{$item->id}}">{{$item->name}}</option>
                    @endforeach
                  </select> 
              </div>
              <div class="col-md-2 ">
                <div class="form-group text-right">
                    <button type="button" class="btn btn-success" id="btn-insert"><i class="fa fa-plus" aria-hidden="true"></i> Thêm Mới</button>
                </div>
              </div>
          </div>

          <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered hover table-hover table-striped" id="categoriesTable">
                </table>
            </div>
        </div> 

      </div>
      <!-- /.card-footer -->
    </div>
    <!-- /.card -->

  </section>
    @include('Admin.pages.categories.modal')
    @section('jsAdmin')
    <script src="{{asset('app/admin/categories/categories.js')}}"></script>
<script>
var categories = new categories(); 
	    categories.datas={
	        routes:{
              fetchdata:"{{route('admin.categories.fetchdata')}}",
	            datatable:"{{route('admin.categories.datatables')}}",
              insert:"{{route('admin.categories.insert')}}",
	            update:"{{route('admin.categories.update')}}",
			        delete:"{{route('admin.categories.delete')}}"
	        }
	    }   
	categories.init();   
</script>
@endsection
  
  <!-- /.content -->
  @endsection