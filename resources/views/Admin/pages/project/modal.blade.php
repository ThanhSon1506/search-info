{{-- Modal Add --}}
<div class="modal fade" id="projectModal" >
	<div class="modal-dialog modal-lg" role="document">
		<form id="projectForm" enctype="multipart/form-data" action="" autocomplete="off" onsubmit="return false">
		<div class="modal-content">
		<div class="modal-header">
		<h5 class="modal-title" id="modal-title"></h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
		</div>
		<div class="modal-body">
			<div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Tên dự án</label>
						<input type="text" name="projects_name" id="projects_name" class="form-control form-control-sm" required/>
					</div>
					<div class="form-group">
                        <select name="userID" id="userID" class="form-control form-control-sm">
						<option selected disabled value="">Chọn Khách hàng / Công ty</option>
						@foreach (getCompany() as $item)
						<option value="{{$item->id}}">{{$item->full_name}}</option>
						@endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <select name="serviceID" id="serviceID" class="form-control form-control-sm">
                            <option selected disabled value="">Chọn dịch vụ</option>
							@foreach (getServices() as $item)
                                <option value="{{$item->id}}">{{$item->services_name}}</option>
                            @endforeach
                        </select>
                    </div>    
				</div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Ngày bắt đầu</label>
						<input type="date" name="time_start" id="time_start" class="form-control form-control-sm" required/>
					</div>
                    <div class="form-group">
                        <label>Ngày kết thúc</label>
						<input type="date" name="time_end" id="time_end" class="form-control form-control-sm" required/>
					</div>
                    <div class="form-group">
                        <label for="projects_file">Chọn file đính kèm</label>
						<input type="file" ref="upload" name="projects_file" id="projects_file" class="form-control-file" hidden  />
						<a class="d-block" id="list_file" href=""></a>
					</div>         
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Mô tả dự án</label>
						<div id="projects_description_quill">

						</div>
						<input type="hidden" name="projects_description" id="projects_description" class="form-control form-control-sm" required/>
					</div>
                </div>
			</div>
		</div>
		<div class="modal-footer">
			<button type="submit" class="btn btn-success" id="submit">Lưu</button>
		</div>
	</div>
	</div>
</form>
</div>

{{-- Modal view description --}}
<div class="modal fade" id="modal-action-view-description" >
	<div class="modal-dialog" role="document">
		<div class="modal-content">
		<div class="modal-header">
		<h5 class="modal-title" id="modal-action-title-view"></h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
		</div>
		<div class="modal-body">
			<div class="row">
                <div class="col-md-12">
                    <div id="projects_description_view"></div>
				</div>
			</div>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-danger" data-dismiss="modal">Thoát</button>
		</div>
	</div>
	</div>
</div>