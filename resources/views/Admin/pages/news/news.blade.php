<script src="{{asset('app/admin/news/news.js')}}"></script>

@extends('admin.layouts.main')
@section('main')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Tin tức</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Admin</a></li>
            <li class="breadcrumb-item active">Tin tức</li>
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
                <label>Lọc danh mục</label>
                <select name="category" id="category" class="form-control form-control-sm">
                  <option selected  value="">--Chọn danh mục--</option>
                  @foreach (getCategories() as $item)
                  <option value="{{$item->id}}">{{$item->name}}</option>
                  @endforeach
                </select> 
              </div>
              </div>
            
              <div class="col-md-6 d-flex align-items-center justify-content-center">
                <div class="text-right ">
                    <button type="button" class="btn btn-success" id="btn-insert"><i class="fa fa-plus" aria-hidden="true"></i> Thêm Mới</button>
                </div>
              </div>
          </div>

         
             </table>
                <table class="table table-bordered hover table-hover table-striped" id="newsTable">
                </table>
            </div>
        </div> 

      </div>
      <!-- /.card-footer -->
    </div>
    <!-- /.card -->

  </section>
    @include('Admin.pages.news.modal')
    @section('jsAdmin')
    <script src="{{asset('app/admin/news/news.js')}}"></script>
<script>
var news = new news(); 
	    news.datas={
	        routes:{
	            datatable:"{{route('admin.news.datatables')}}",
              image:"{{route('admin.settings.data')}}",
                insert:"{{route('admin.news.insert')}}",
	            update:"{{route('admin.news.update')}}",
			    delete:"{{route('admin.news.delete')}}"
	        }
	    }   
	news.init();   
</script>
@endsection
  
  <!-- /.content -->
  @endsection