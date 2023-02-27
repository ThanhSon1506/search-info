{{-- Modal Add --}}
<div class="modal fade" id="userModal" >
	<div class="modal-dialog modal-lg" role="document">
		<form id="userForm">
		<div class="modal-content">
		<div class="modal-header">
		<h5 class="modal-title" id="userTitle"></h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
		</div>
		<div class="modal-body">
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
                        <label>Tên khách hàng / Công ty</label>
						<input type="text" name="full_name" id="full_name" class="form-control form-control-sm"/>
					</div>
					<div class="form-group">
                        <label>Email</label>
						<input type="email" name="email" id="email" class="form-control form-control-sm"/>
					</div>
					<div class="form-group">
                        <label>Từ khóa</label>
						<input type="text" name="keyword" id="keyword" class="form-control form-control-sm"/>
					</div>	
				</div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Địa chỉ</label>
						<input type="text" name="address" id="address" class="form-control form-control-sm"/>
					</div>
                    <div class="form-group">
                        <label>Số điện thoại</label>
						<input type="number" name="phone_number" id="phone_number" class="form-control form-control-sm"/>
					</div>
                 
					<div class="form-group hide">
                        <label >Password <span id="passwordLabel" class="text-danger"></span></label>
						<input type="password" name="password" id="password" class="form-control form-control-sm"/>
					</div>     
				</div>
				<div class="col-md-12">
					<div class="form-group">
                        <label>Ghi chú</label>
						<div id="note_quill">

						</div>
						<input type="hidden" name="note" id="note" class="form-control form-control-sm"/>
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
                    <div id="users_note_view"></div>
				</div>
			</div>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-danger" data-dismiss="modal">Thoát</button>
		</div>
	</div>
	</div>
</div>