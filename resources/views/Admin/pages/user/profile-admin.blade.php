@extends('admin.layouts.main')
@section('main')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Hồ sơ admin</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Admin</a></li>
            <li class="breadcrumb-item active">Profile admin</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">

    <div class="card card-solid">
      <div class="card-body">
        <form action="{{route('profile_admin_update')}}" method="post">
        @csrf
        <input type="hidden" name="id" value="{{ Auth::user()->id }}">
        <div class="row">
          <div class="col-md-12 mb-3">
            <h4>Cài đặt trang chủ</h4>
          </div>
          <div class="col-md-12">
            <div class="form-group">
                <label>Email</label>
                <input type="text" name="email" class="form-control form-control-sm" value="{{ Auth::user()->email }}"/>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control form-control-sm"/>
            </div>
            <div class="form-group">
                <input type="submit" name="submit" class="btn btn-primary" value="Lưu lại"/>
            </div>
          </div>
        </div>
        </form>
      </div>
    </div>
    <!-- Default box -->
    
    <!-- /.card -->

  </section>

  
  <!-- /.content -->
  @endsection