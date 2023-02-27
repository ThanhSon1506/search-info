{{-- Modal Service --}}
<div class="modal fade" id="serviceModal" >
	<div class="modal-dialog modal-lg" role="document">
		<form id="formAction" onsubmit="return false">
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
                        <label> Tên Dịch Vụ</label>
						<input type="text" name="services_name" id="services_name" class=" form-control form-control-sm "/>
					</div>
					<div class="form-group">
                        <label> Mô Tả</label>
						<div id="services_description_quill">

						</div>
						<input type="hidden"  name="services_description" id="services_description" class=" form-control form-control-sm "/>
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
{{-- Modal Service --}}

{{-- Modal view description --}}
<div class="modal fade" id="deltaiModal" >
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
                    <div id="services_description_view"></div>
				</div>
			</div>
		</div>
		
	</div>
	</div>
</div>
{{-- Modal view description --}}
