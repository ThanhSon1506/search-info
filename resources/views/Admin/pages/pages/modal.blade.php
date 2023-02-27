{{-- Modal Edit --}}
<div class="modal fade" id="pageModal" >
	<div class="modal-dialog" role="document">
		<form id="pageForm" onsubmit="return false">
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
                        <label>Tên trang</label>
						<input type="text" name="pages_name" id="pages_name" class=" form-control form-control-sm " required/>
					</div>
					<div class="form-group">
                        <label> Mô Tả</label>
						<div id="pages_content_quill"></div>
						<input type="hidden" name="pages_content" id="pages_content" class=" form-control form-control-sm " required/>
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
                    <div id="pages_description_view"></div>
				</div>
			</div>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-danger" data-dismiss="modal">Thoát</button>
		</div>
	</div>
	</div>
</div>