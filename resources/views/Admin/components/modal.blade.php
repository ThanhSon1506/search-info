{{-- Modal header_home_modal Edit --}}
<div class="modal fade" id="header_home_modal" >
	<div class="modal-dialog" role="document">
		<form id="header_home_form" onsubmit="return false">
		<div class="modal-content">
		<div class="modal-header">
		<h5 class="modal-title" id="modal-title"></h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
		</div>
		<div class="modal-body">
			<div class="row">
                <div class="col-md-12">
					<div class="form-group">
						<label for="" class="d-block">Icon</label>
						<select class="w-100" name="header_home_icon" id="header_home_icon" >
							@include('Admin.components.select_icon')
						</select>
						<span id="icon_header_home_icon"></span>
						<!-- <label>Icon</label>
						<input type="text" name="header_home_title" id="header_home_icon" class=" form-control form-control-sm " placeholder="Nhập icon" required/> -->
					</div>
                    <div class="form-group">
                        <label>Tiêu đề</label>
						<input type="text" name="header_home_title" id="header_home_title" class=" form-control form-control-sm " required/>
					</div>
					<div class="form-group">
                        <label> Mô Tả</label>
						<div id="description_quill" class="h-50"></div>
						<input type="hidden" name="description" id="description" class=" form-control form-control-sm " required/>
					</div>
				</div>
				
			</div>
		</div>
		<div class="modal-footer">
			<button type="submit" class="btn btn-success"  id="submit">Lưu</button>
		</div>
	</div>
	</div>
</form>
</div>

{{-- Modal skill_area_modal Edit --}}
<div class="modal fade" id="skill_area_modal" >
	<div class="modal-dialog" role="document">
		<form id="skill_area_form" onsubmit="return false">
		<div class="modal-content">
		<div class="modal-header">
		<h5 class="modal-title" id="modal-title-skill-area"></h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
		</div>
		<div class="modal-body">
			<div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Tiêu đề</label>
						<input type="text" name="skill_area_title" id="skill_area_title" class=" form-control form-control-sm " required/>
					</div>
				</div>
			</div>
		</div>
		<div class="modal-footer">
			<button type="submit" class="btn btn-success"  id="submit_skill_area">Lưu</button>
		</div>
	</div>
	</div>
</form>
</div>

{{-- Modal featureds_modal  Edit --}}
<div class="modal fade" id="featureds_modal" >
	<div class="modal-dialog" role="document">
		<form id="featureds_form" onsubmit="return false">
		<div class="modal-content">
		<div class="modal-header">
		<h5 class="modal-title" id="modal-title-featureds"></h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
		</div>
		<div class="modal-body">
			<div class="row">
                <div class="col-md-12">
					<label for="" class="d-block">Icon</label>
					<select class="w-100"  name="featureds_icon" id="featureds_icon" required>
						@include('Admin.components.select_icon')
					</select>
					<span id="icon_featureds_icon"></span>

                    <div class="form-group">
                        <label>Tiêu đề</label>
						<input type="text" name="featureds_title" id="featureds_title" class=" form-control form-control-sm " required/>
					</div>
					<div class="form-group">
                        <label> Mô Tả</label>
						<div id="description_quill_featureds" class="h-50"></div>
						<input type="hidden" name="featureds_des" id="featureds_des" class=" form-control form-control-sm " required/>
					</div>
				</div>
				
			</div>
		</div>
		<div class="modal-footer">
			<button type="submit" class="btn btn-success"  id="submit_featureds">Lưu</button>
		</div>
	</div>
	</div>
</form>
</div>
{{-- Modal awesome_modal Edit --}}
<div class="modal fade" id="awesome_modal" >
	<div class="modal-dialog" role="document">
		<form id="awesome_form" onsubmit="return false">
		<div class="modal-content">
		<div class="modal-header">
		<h5 class="modal-title" id="modal-title-awesome"></h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
		</div>
		<div class="modal-body">
			<div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Tên</label>
						<input type="text" name="awesome_name" id="awesome_name" class=" form-control form-control-sm " required/>
					</div>
					<div class="form-group">
                        <label>Chức vụ</label>
						<input type="text" name="awesome_position" id="awesome_position" class=" form-control form-control-sm " required/>
					</div>
					<div class="form-group">
						<label> Mô Tả</label>
						<div id="description_quill_awesome" class="h-50"></div>
						<input type="hidden" name="awesome_des" id="awesome_des" class=" form-control form-control-sm " required/>
					</div>
					<div>
						<div class="form-group ">
							<div class="image position-relative opacity-25 bg-secondary text-center d-flex justify-content-center align-items-center">
								<input type="file" name="image" id="image" accept="image/*" 
									class="d-none" ref="upload" accept=".jpeg, .jpg, .png, .webp, .svg"
									required  onchange="Filevalidation()">
								<img id="image_preview" src="" class="w-100 h-100 position-absolute " alt="no-image">
								<label for="image" class="text-white text position-absolute p-5 " id="label_image"><span class="text">click to upload</span></label>
								<p id="size"></p>
							</div>	
							<div class="col-md-6">
							</div>
						</div>
					</div>
				</div>
				
			</div>
		</div>
		<div class="modal-footer">
			<button type="submit" class="btn btn-success"  id="submit_awesome">Lưu</button>
		</div>
	</div>
	</div>
</form>
</div>
{{-- Modal clients_modal Edit --}}
<div class="modal fade" id="clients_modal" >
	<div class="modal-dialog " role="document">
		<form id="clients_form" onsubmit="return false">
		<div class="modal-content">
		<div class="modal-header">
		<h5 class="modal-title" id="modal-title-clients"></h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
		</div>
		<div class="modal-body">
			<div class="row">
				<div class="col-md-6">
				<div class="form-group ">
					<label for="">Ảnh không màu</label>
						<div class="image position-relative opacity-25 bg-secondary text-center d-flex justify-content-center align-items-center">
							<input type="file" name="image" id="image" accept="image/*" 
								class="d-none" ref="upload" accept=".jpeg, .jpg, .png, .webp, .svg"
								required  onchange="Filevalidation()">
							<img id="image_preview_clients" src="" class="w-100 h-100 position-absolute " alt="no-image">
							<label for="image" class="text-white text position-absolute p-5 " id="label_image_clients"><span class="text">click to upload</span></label>
							<p id="size"></p>
						</div>	
						<div class="col-md-6">
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group ">
						<label for="">Ảnh màu</label>
							<div class="image position-relative opacity-25 bg-secondary text-center d-flex justify-content-center align-items-center">
								<input type="file" name="image_color" id="image_color" accept="image/*" 
									class="d-none" ref="upload" accept=".jpeg, .jpg, .png, .webp, .svg"
									required  onchange="Filevalidation2()">
								<img id="image_preview_clients_color" src="" class="w-100 h-100 position-absolute " alt="no-image">
								<label for="image_color" class="text-white text position-absolute p-5 " id="label_image_clients_color"><span class="text">click to upload</span></label>
								<p id="size"></p>
							</div>	
							<div class="col-md-6">
							</div>
						</div>
				</div>
				
				</div>
			</div>
			<div class="modal-footer">
			<button type="submit" class="btn btn-success"  id="submit_clients">Lưu</button>
		</div>
		</div>
	
	</div>
	</div>
</form>
</div>

