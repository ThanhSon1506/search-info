{{-- Modal Edit --}}
<div class="modal fade" id="categoriesModal" >
	<div class="modal-dialog" role="document">
		<form id="categoriesForm" onsubmit="return false">
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
                        <label>Tên danh mục</label>
						<input type="text" name="name" id="name" class=" form-control form-control-sm " required/>
					</div>
					<div class="form-group">
						<label> Danh mục cha</label>
                        <select name="category_id" id="category_id" class="form-control form-control-sm">
						<option selected  value="">--Chọn danh mục--</option>
						@foreach (fetchCategories() as $item)
						<optgroup label="{{$item->name}}">
							<option value="{{$item->id}}">{{$item->name}}
								@foreach ($item->childrenCategories as $child)
									@include('admin.components.menu_category',['child'=>$child])
								@endforeach
							</option>
						</optgroup>
						@endforeach
                        </select>
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

{{-- Modal view description --}}
<div class="modal fade" id="descriptionModal" >
	<div class="modal-dialog" role="document">
		<div class="modal-content">
		<div class="modal-header">
		<h5 class="modal-title" id="modalTitle"></h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
		</div>
		<div class="modal-body">
			<div class="row">
                <div class="col-md-12">
                    <div id="description_view"></div>
				</div>
			</div>
		</div>
		<div class="modal-footer">
		</div>
	</div>
	</div>
</div>