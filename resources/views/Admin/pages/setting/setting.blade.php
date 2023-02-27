@extends('admin.layouts.main')
@section('main')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Cài đặt website</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Admin</a></li>
            <li class="breadcrumb-item active">Settings</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>


  
<div id="main">
  <div class="container">
    <div class="group-tabs bg-white">
      <!-- Nav tabs -->
      <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" id="home-tab" data-toggle="pill" href="#home" role="tab" aria-controls="home" aria-selected="true">Trang chủ</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="website-tab" data-toggle="pill" href="#website" role="tab" aria-controls="website" aria-selected="false">Cài đặt website</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="email-tab" data-toggle="pill" href="#email" role="tab" aria-controls="email" aria-selected="false">Email</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="settings-tab" data-toggle="pill" href="#settings" role="tab" aria-controls="settings" aria-selected="false">Cấu hình google</a>
        </li>
      </ul>

      <!-- Tab panes -->
      <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="home">

            <!-- Main content -->
              <section class="content">
            <div class="">
              <!-- Cài đặt trang chủ -->

                 <!-- Main content -->
              <section class="content">
                <div class="container-fluid">
                  <div class="row">
                    <div class="col-12">
                      <!-- Default box -->
                      <div class="card collapsed-card">
                        <div class="card-header">
                          <h3 class="card-title"> Cài đặt header</h3>

                          <div class="card-tools">
                            <button type="button" class="btn btn-tool collapsed" data-toggle="collapse" data-card-widget="collapse" title="Collapse" aria-controls="header">
                              <i class="fas fa-plus"></i>
                            </button>
                          </div>
                        </div>
                        <div class="card-body collapse"  id="header">
                        <form method="post" id="updateHeader">
                            @csrf
                            <div class="row">
                              <div class="col-md-12 mb-3">
                                <h4>Cài đặt cấu hình header</h4>
                              </div>
                                  <input type="hidden" name="id" id="id_setting" value="{{ getConfigMail()->id }}">
                                  @foreach(json_decode(getConfigSetting()->header_project) as $data)
                                  <div class="form-group w-100">
                                    <label>Tiêu đề</label>
                                    <input type="text" name="title" class="form-control form-control-sm" value="{{$data->title}}"/>
                                  </div>
                                  <div class="form-group w-100">
                                    <label>Mô tả</label>
                                    <div id="header_des_quill" class="h-50">{!!$data->des!!}</div>
                                    <input type="hidden" name="header_des" id="header_des" class=" form-control form-control-sm" value="{{$data->des}}" required/>
                                    <!-- <textarea id="header_des" type="text" name="des" class="form-control form-control-sm" value="{{$data->des}}" rows="4" cols="50">{!!$data->des!!}</textarea> -->
                                  </div>
                                @endforeach
                              <div class="col-md-1">
                                <button type="submit" class="btn btn-primary btn-block">Lưu</button>
                              </div>
                          </div>
                        </form>
                        </div>
         
                      </div>
                      <!-- /.card -->
                    </div>
                  </div>
                </div>
              </section>
              <!-- /.content -->

              <!-- Cài đặt nội dung dịch vụ -->
              <section class="content">
                <div class="container-fluid">
                  <div class="row">
                    <div class="col-12">
                      <!-- Default box -->
                      <div class="card collapsed-card">
                        <div class="card-header">
                          <h3 class="card-title"> Cài đặt nội dung section 1</h3>

                          <div class="card-tools">
                            <button type="button" class="btn btn-tool collapsed" data-card-widget="collapse" title="Collapse" aria-controls="header_home">
                              <i class="fas fa-plus"></i>
                            </button>
                          </div>
                        </div>
                        <div class="card-body collapse" id="header_home">
                              <!-- Main content -->
                          <section class="content">
                            <!-- Default box -->
                            <div class="">
                              <div class="card-body pb-0">
                                  <div class="row">
                                      <div class="col-md-2 ">
                                        <div class="form-group text-left">
                                            <button type="button" class="btn btn-success" id="btn-insert"><i class="fa fa-plus" aria-hidden="true"></i> Thêm Mới</button>
                                        </div>
                                      </div>
                                  </div>

                                  <div class="row">
                                    <div class="col-md-12">
                                        <table class="table table-bordered hover table-hover table-striped" id="header_home_table">
                                        </table>
                                    </div>
                                </div> 

                              </div>
                              <!-- /.card-footer -->
                            </div>
                            <!-- /.card -->

                            </section>  
                      <!--end header home -->                           
                        </div>
         
                      </div>
                      <!-- /.card -->
                    </div>
                  </div>
                </div>
              </section>

           
               <!-- Cài đặt nội dung skill_area -->
               <section class="content">
                <div class="container-fluid">
                  <div class="row">
                    <div class="col-12">
                      <!-- Default box -->
                      <div class="card collapsed-card">
                        <div class="card-header">
                          <h3 class="card-title">   Cài đặt nội dung section 2</h3>

                          <div class="card-tools">
                            <button type="button" class="btn btn-tool collapsed" data-card-widget="collapse" title="Collapse" aria-controls="skill_area">
                              <i class="fas fa-plus"></i>
                            </button>
                          </div>
                        </div>
                        <div class="card-body collapse" id="skill_area">
                        <form id="skillAreaForm">
                      @csrf
                      <div class="row">
                            <input type="hidden" name="id" id="id_setting" value="{{ getConfigSetting()->id }}">
                            @foreach(json_decode(getConfigSetting()->skill_area) as $data)
                            <div class="form-group w-100">
                              <label>Tiêu đề</label>
                              <input type="text" name="title_skill_area" id="title_skill_area" class="form-control form-control-sm" value="{{$data->title}}"/>
                            </div>
                            <div class="form-group w-100">
                              <label>Mô tả</label>
                              <div id="skill_des_quill" class="h-50">{!!$data->des!!}</div>
                              <input type="hidden" name="skill_des" id="skill_des" class=" form-control form-control-sm" value="{{$data->des}}" required/>
                            </div>
                          @endforeach
                        <div class="col-md-1">
                          <button type="submit" class="btn btn-primary btn-block">Lưu</button>
                        </div>
                    </div>
                  </form>      
                   <!-- Header home -->
                   <section class="content">

                      <!-- Default box -->
                      <div class="">
                        <div class="card-body pb-0">
                            <div class="row">
                                <div class="col-md-2 ">
                                  <div class="form-group text-left">
                                      <button type="button" class="btn btn-success" id="btn_insert_skill_area"><i class="fa fa-plus" aria-hidden="true"></i> Thêm Mới</button>
                                  </div>
                                </div>
                            </div>

                            <div class="row">
                              <div class="col-md-12">
                                  <table class="table table-bordered hover table-hover table-striped" id="skill_area_table">
                                  </table>
                              </div>
                          </div> 

                        </div>
                        <!-- /.card-footer -->
                      </div>
                      <!-- /.card -->

                      </section>  
                      <!--end header home -->
                        </div>
         
                      </div>
                      <!-- /.card -->
                    </div>
                  </div>
                </div>
              </section>

         
              <!-- Cài đặt nội dung  featureds -->

              <section class="content">
                <div class="container-fluid">
                  <div class="row">
                    <div class="col-12">
                      <!-- Default box -->
                      <div class="card collapsed-card">
                        <div class="card-header">
                          <h3 class="card-title">   Cài đặt nội dung section 3</h3>

                          <div class="card-tools">
                            <button type="button" class="btn btn-tool collapsed" data-card-widget="collapse" title="Collapse" aria-controls="featureds">
                              <i class="fas fa-plus"></i>
                            </button>
                          </div>
                        </div>
                        <div class="card-body collapse" id="featureds">
                        <form id="featuredsForm">
                            @csrf
                            <div class="row">
                                  <input type="hidden" name="id" id="id_setting" value="{{ getConfigSetting()->id }}">
                                  @foreach(json_decode(getConfigSetting()->featureds) as $data)
                                  <div class="form-group w-100">
                                    <label>Tiêu đề</label>
                                    <input type="text" name="title_featureds" id="title_featureds" class="form-control form-control-sm" value="{{$data->title}}"/>
                                  </div>
                                  <div class="form-group w-100">
                                    <label>Mô tả</label>
                                    <div class="form-group w-100">
                                     <label>Mô tả</label>
                                    <div id="des_featureds_quill" class="h-50">{!!$data->des!!}</div>
                                      <input type="hidden" name="des_featureds" id="des_featureds" class=" form-control form-control-sm" value="{{$data->des}}" required/>
                                  </div>
                                @endforeach
                              <div class="col-md-1">
                                <button type="submit" class="btn btn-primary btn-block">Lưu</button>
                              </div>
                          </div>
                        </form>

                            <!-- Header home -->
                    <section class="content">
                    <!-- Default box -->
                    <div class="">
                      <div class="card-body pb-0">
                          <div class="row">
                              <div class="col-md-2 ">
                                <div class="form-group text-left">
                                    <button type="button" class="btn btn-success" id="btn_insert_featureds"><i class="fa fa-plus" aria-hidden="true"></i> Thêm Mới</button>
                                </div>
                              </div>
                          </div>

                          <div class="row">
                            <div class="col-md-12">
                                <table class="table table-bordered hover table-hover table-striped" id="featureds_table">
                                </table>
                            </div>
                        </div>  

                      </div>
                      <!-- /.card-footer -->
                    </div>
                    <!-- /.card -->

                    </section>  
                    <!--end header home -->
                    
                        </div>
         
                      </div>
                      <!-- /.card -->
                    </div>
                  </div>
                </div>
              </section>
     

              <!-- Cài đặt nội dung awesome -->
              
              <section class="content">
                <div class="container-fluid">
                  <div class="row">
                    <div class="col-12">
                      <!-- Default box -->
                      <div class="card">
                        <div class="card-header">
                          <h3 class="card-title">   Cài đặt nội dung section 4</h3>

                          <div class="card-tools">
                            <button type="button" class="btn btn-tool collapsed" data-card-widget="collapse" title="Collapse" aria-controls="awesome">
                              <i class="fas fa-plus"></i>
                            </button>
                          </div>
                        </div>
                        <div class="card-body collapse" id="awesome">
                        <form id="awesomeForm">
                        @csrf
                        <div class="row">
                              <input type="hidden" name="id" id="id_setting" value="{{ getConfigSetting()->id }}">
                              @foreach(json_decode(getConfigSetting()->awesome) as $data)
                              <div class="form-group w-100">
                                <label>Tiêu đề</label>
                                <input type="text" name="title_awesome" id="title_awesome" class="form-control form-control-sm" value="{{$data->title}}"/>
                              </div>
                              <div class="form-group w-100">
                                <label>Mô tả</label>
                                    <div id="des_awesome_quill" class="h-50">{!!$data->des!!}</div>
                                      <input type="hidden" name="des_awesome" id="des_awesome" class=" form-control form-control-sm" value="{{$data->des}}" required/>
                              </div>
                            @endforeach
                          <div class="col-md-1">
                            <button type="submit" class="btn btn-primary btn-block">Lưu</button>
                          </div>
                      </div>
                    </form>

                    <section class="content">

                      <!-- Default box -->
                      <div class="">
                        <div class="card-body pb-0">
                            <div class="row">
                                <div class="col-md-2 ">
                                  <div class="form-group text-left">
                                      <button type="button" class="btn btn-success" id="btn_insert_awesome"><i class="fa fa-plus" aria-hidden="true"></i> Thêm Mới</button>
                                  </div>
                                </div>
                            </div>

                            <div class="row">
                              <div class="col-md-12">
                                  <table class="table table-bordered hover table-hover table-striped" id="awesome_table">
                                  </table>
                              </div>
                          </div>  

                        </div>
                        <!-- /.card-footer -->
                      </div>
                      <!-- /.card -->

                      </section>  
                        
               
                        </div>
         
                      </div>
                      <!-- /.card -->
                    </div>
                  </div>
                </div>
              </section>
              
              <!-- Cài đặt nội dung  funfact -->

              <section class="content">
                <div class="container-fluid">
                  <div class="row">
                    <div class="col-12">
                      <!-- Default box -->
                      <div class="card">
                        <div class="card-header">
                          <h3 class="card-title">   Cài đặt nội dung section 5</h3>

                          <div class="card-tools">
                            <button type="button" class="btn btn-tool collapsed" data-card-widget="collapse" title="Collapse" aria-controls="funfact">
                              <i class="fas fa-plus"></i>
                            </button>
                          </div>
                        </div>
                        <div class="card-body collapse" id="funfact">
                        <form id="funfactForm">
                            @csrf
                            <div class="row">
                                  <input type="hidden" name="id" id="id_setting" value="{{ getConfigSetting()->id }}">
                                  @foreach(json_decode(getConfigSetting()->funfact) as $data)
                                  <div class="form-group w-100">
                                    <label>Tiêu đề</label>
                                    <input type="text" name="title_funfact" id="title_funfact" class="form-control form-control-sm" value="{{$data->title}}"/>
                                  </div>
                                  <div class="form-group w-100">
                                    <label>Mô tả</label>
                                      <div id="des_funfact_quill" class="h-50">{!!$data->des!!}</div>
                                      <input type="hidden" name="des_funfact" id="des_funfact" class=" form-control form-control-sm" value="{{$data->des}}" required/>
                                  </div>
                                @endforeach
                              <div class="col-md-1">
                                <button type="submit" class="btn btn-primary btn-block">Lưu</button>
                              </div>
                          </div>
                        </form>
                        </div>
         
                      </div>
                      <!-- /.card -->
                    </div>
                  </div>
                </div>
              </section>

              <!-- Cài đặt nội dung clients -->
              <section class="content">
                <div class="container-fluid">
                  <div class="row">
                    <div class="col-12">
                      <!-- Default box -->
                      <div class="card">
                        <div class="card-header">
                          <h3 class="card-title">   Cài đặt nội dung section 6</h3>

                          <div class="card-tools">
                            <button type="button" class="btn btn-tool collapsed" data-card-widget="collapse" title="Collapse" aria-controls="clients">
                              <i class="fas fa-plus"></i>
                            </button>
                          </div>
                        </div>
                        <div class="card-body collapse" id="clients">
                        <form id="clientsForm">
                          @csrf
                          <div class="row">
                                <input type="hidden" name="id" id="id_setting" value="{{ getConfigSetting()->id }}">
                                @foreach(json_decode(getConfigSetting()->clients) as $data)
                                <div class="form-group w-100">
                                  <label>Tiêu đề</label>
                                  <input type="text" name="title_clients" id="title_clients" class="form-control form-control-sm" value="{{$data->title}}"/>
                                </div>
                                <div class="form-group w-100">
                                  <label>Mô tả</label>
                                      <div id="des_clients_quill" class="h-50">{!!$data->des!!}</div>
                                      <input type="hidden" name="des_clients" id="des_clients" class=" form-control form-control-sm" value="{{$data->des}}" required/>
                                  <!-- <textarea type="text" name="des_clients" id="des_clients" class="form-control form-control-sm" value="{{$data->des}}" rows="4" cols="50">{!!$data->des!!}</textarea> -->
                                </div>
                              @endforeach
                            <div class="col-md-1">
                              <button type="submit" class="btn btn-primary btn-block">Lưu</button>
                            </div>
                        </div>
                      </form>
                      
                      <!-- Header home -->
                    <section class="content">

                    <!-- Default box -->
                    <div class="">
                      <div class="card-body pb-0">
                          <div class="row">
                              <div class="col-md-2 ">
                                <div class="form-group text-left">
                                    <button type="button" class="btn btn-success" id="btn_insert_clients"><i class="fa fa-plus" aria-hidden="true"></i> Thêm Mới</button>
                                </div>
                              </div>
                          </div>

                          <div class="row">
                            <div class="col-md-12">
                                <table class="table table-bordered hover table-hover table-striped" id="clients_table">
                                </table>
                            </div>
                        </div>  

                      </div>
                      <!-- /.card-footer -->
                    </div>
                    <!-- /.card -->

                    </section>  
                    <!--end header home -->

                        </div>
         
                      </div>
                      <!-- /.card -->
                    </div>
                  </div>
                </div>
              </section>
            </div>
            </section>
            <!-- /.content -->
        </div>
        <div role="tabpanel" class="tab-pane" id="email">
          <!-- email -->
          <div class=" mt-4">
            <div class="card-body">
              <form action="{{route('settings_update_mail')}}" method="post">
                @csrf
                <div class="row">
                  <div class="col-md-12 mb-3">
                    <h4>Cài đặt cấu hình gửi mail</h4>
                  </div>
                      <input type="hidden" name="id" value="{{ getConfigMail()->id }}">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Mail driver</label>
                      <input type="text" name="mail_driver" class="form-control form-control-sm" value="{{ getConfigMail()->mail_driver }}" required/>
                    </div>
                    <div class="form-group">
                      <label>Mail host</label>
                      <input type="text" name="mail_host" class="form-control form-control-sm" value="{{ getConfigMail()->mail_host }}" required/>
                    </div>
                    <div class="form-group">
                      <label>Mail port</label>
                      <input type="text" name="mail_port" class="form-control form-control-sm" value="{{ getConfigMail()->mail_port }}" required/>
                    </div>
                    <div class="form-group">
                      <label>Mail from address</label>
                      <input type="text" name="mail_from_address" class="form-control form-control-sm" value="{{ getConfigMail()->mail_from_address }}" required/>
                    </div>
                    <div class="form-group">
                      <label>Mail from name</label>
                      <input type="text" name="mail_from_name" class="form-control form-control-sm" value="{{ getConfigMail()->mail_from_name }}" required/>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Mail encryption</label>
                      <input type="text" name="mail_encryption" class="form-control form-control-sm" value="{{ getConfigMail()->mail_encryption }}" required/>
                    </div>
                    <div class="form-group">
                      <label>Mail username</label>
                      <input type="email" name="mail_username" class="form-control form-control-sm" value="{{ getConfigMail()->mail_username }}" required/>
                    </div>
                    <div class="form-group">
                      <label>Mail password</label>
                      <input type="text" name="mail_password" class="form-control form-control-sm" value="{{ getConfigMail()->mail_password }}" required/>
                    </div>
                    <div class="form-group">
                      <label>Mail người nhận</label>
                      <input type="email" name="mail_receive" class="form-control form-control-sm" value="{{ getConfigMail()->mail_receive }}" required/>
                    </div>
                  </div>
                <div class="col-md-1">
                  <button type="submit" class="btn btn-primary btn-block">Lưu</button>
                </div>
              </div>
            </form>
            </div>
            <!-- /.card-footer -->
          </div>
          <!-- end email -->
        </div>
        <div role="tabpanel" class="tab-pane" id="website">
        <div class="card-body bg-white shadow">
              <form id="update_website" action="{{route('settings_update_guest')}}" method="post" enctype="multipart/form-data">
              @csrf
              <input type="hidden" name="id" value="{{ getConfigMail()->id }}">
              <div class="row">
                <div class="col-md-12 mb-3">
                  <h4>Cài đặt trang chủ</h4>
                </div>
                <div class="col-md-6">
                <div class="form-group">
                      <label>Tiêu đề</label>
                      <input type="text" name="title" id="title" class="form-control" value="{{ getConfigMail()->title }}"/>
                    </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Link login admin</label>
                    <input type="text" id="route_login" name="route_login" class="form-control" value="{{ getConfigMail()->route_login }}"/>
                  </div>
                <div class="form-group">
                  <label>Chinh sửa đường dẫn admin</label>
                  <input type="text" name="route_admin" class="form-control" value="{{ getConfigMail()->route_admin }}"/>
                </div>
                </div>
                <div class="col-6">
                  <div class="form-group">
                    <label>Logo header</label>
                    @if(isset(getConfigMail()->guest_logo_header))
                    <p><img class="w-25" src="{{route('guest.home.index')}}/uploads/{{ getConfigMail()->guest_logo_header }}"/></p>
                    @else
                    @endif
                    <input type="hidden" name="header_file_old" value="{{ getConfigMail()->guest_logo_header }}" class="img-fluid"/>
                    <input type="file" name="guest_logo_header" class="w-100"/>
                  </div>
                  <div class="form-group">
                    <label>URL map</label>
                    <textarea name="url_map" class="form-control">{{ getConfigMail()->url_map }}</textarea>
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-group">
                    <label>Logo footer</label>
                    @if (isset(getConfigMail()->guest_logo_footer))
                    <p><img class="w-25" src="{{route('guest.home.index')}}/uploads/{{ getConfigMail()->guest_logo_footer }}" class="img-fluid"/></p>
                    @else
                    @endif
                    <input type="hidden" name="footer_file_old" value="{{ getConfigMail()->guest_logo_footer }}"/>
                    <input type="file" name="guest_logo_footer" class="w-100"/>
                  </div>
                  <div class="form-group">
                    <label>Mô tả footer</label>
                    <textarea name="guest_description_footer" class="form-control">{{ getConfigMail()->guest_description_footer }}</textarea>
                  </div>
                </div>
                <div class="col-6">
                    <label>Mô tả</label>
                    <textarea name="web_des" class="form-control">{{ getConfigMail()->web_des }}</textarea>
                </div>
            
               
                <div class="col-md-12 mt-4">
                  <button type="submit" class="btn btn-primary">Lưu</button>
                </div>
              </div>
              </form>
            </div>
        </div>
        <div role="tabpanel" class="tab-pane" id="settings">This is Settings content</div>
      </div>
    </div>
  </div>

</div>
@include('Admin.components.modal')
  @endsection
  @section('jsAdmin')
<script src="{{asset('app/admin/settings/settings.js')}}"></script>
<script src="{{asset('app/admin/header_home/header_home.js')}}"></script>
<script src="{{asset('app/admin/skill_area/skill_area.js')}}"></script>
<script src="{{asset('app/admin/featureds/featureds.js')}}"></script>
<script src="{{asset('app/admin/awesome/awesome.js')}}"></script>
<script src="{{asset('app/admin/clients/clients.js')}}"></script>
  <script>
    
  var settings = new settings(); 
        settings.datas={
            routes:{
              update_website: "{{route('settings_update_guest')}}",
              update_header:"{{route('admin.settings.update_header')}}",
              skill_area:"{{route('admin.settings.skill_area')}}",
              featureds:"{{route('admin.settings.featureds')}}",
              awesome:"{{route('admin.settings.awesome')}}",
              awesome:"{{route('admin.settings.awesome')}}",
              funfact:"{{route('admin.settings.funfact')}}",
              clients:"{{route('admin.settings.clients')}}",
            }
        }   
        settings.init();   
  </script>



<script>
var header_home = new header_home(); 
	    header_home.datas={
	        routes:{
	            datatable:"{{route('admin.header_home.datatables')}}",
	            insert:"{{route('admin.header_home.insert')}}",
              update:"{{route('admin.header_home.update')}}",
              delete:"{{route('admin.header_home.delete')}}",
	        }
	    }   
	header_home.init();   
</script> 

<script>
var skill_area = new skill_area(); 
	    skill_area.datas={
	        routes:{
	            datatable:"{{route('admin.skill_area.datatables')}}",
              insert:"{{route('admin.skill_area.insert')}}",
              update:"{{route('admin.skill_area.update')}}",
              delete_skill_area:"{{route('admin.skill_area.delete')}}",
	        }
	    }   
      skill_area.init();   
</script>   

<script>
var featureds = new featureds(); 
	    featureds.datas={
	        routes:{
	            datatable:"{{route('admin.featureds.datatables')}}",
              insert:"{{route('admin.featureds.insert')}}",
              update:"{{route('admin.featureds.update')}}",
              delete_featureds:"{{route('admin.featureds.delete')}}",
	        }
	    }   
      featureds.init();   
</script>   

<script>
var awesome = new awesome(); 
	    awesome.datas={
	        routes:{
	            datatable:"{{route('admin.awesome.datatables')}}",
              insert:"{{route('admin.awesome.insert')}}",
              update:"{{route('admin.awesome.update')}}",
              delete_awesome:"{{route('admin.awesome.delete')}}",
	        }
	    }   
      awesome.init();   
</script>   
<script>
var clients = new clients(); 
	    clients.datas={
	        routes:{
	            datatable:"{{route('admin.clients.datatables')}}",
              insert:"{{route('admin.clients.insert')}}",
              update:"{{route('admin.clients.update')}}",
              delete_clients:"{{route('admin.clients.delete')}}",
	        }
	    }   
      clients.init();   
</script>   


  @endsection
