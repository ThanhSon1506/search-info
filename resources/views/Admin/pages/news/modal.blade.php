
<!-- Modal -->
<div class="modal fade" id="newsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal-title">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
		<form id="newsForm" onsubmit="return false" enctype="multipart/form-data">
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
                        <label>Tiêu đề</label>
						<input type="text" name="title" id="title" class=" form-control form-control-sm " required/>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label> Danh mục</label>
                        <select name="category_id" id="category_id" class="form-control form-control-sm">
						<option selected disabled value="">--Chọn danh mục--</option>
						@foreach (getCategories() as $item)
						<option value="{{$item->id}}">{{$item->name}}</option>
						@endforeach
                        </select>
                    </div>
				</div>
			</div>
			<div >
				<div class="form-group">
					<label for="summary">Tóm lược</label>
					<textarea name="summary" id="summary" cols="50" maxlength="500" class="form-control form-control-sm" required></textarea>
				</div>
			</div>
			<div >
				<div class="form-group">
					<label> Mô Tả</label>
					<div id="content_quill" class="h-50">
					</div>
					<input type="hidden"  name="content" id="content"  class="form-control form-control-sm"/>
				</div>
			</div>
			<div>
				<div class="form-group ">
					<div class="image position-relative opacity-25 bg-secondary text-center d-flex justify-content-center align-items-center">
						<input type="file" name="image" id="image" accept="image/*" 
							class="d-none" ref="upload" accept=".jpeg, .jpg, .png, .webp, .svg"
							required  onchange="Filevalidation()">
						<img id="image_preview" src="" class="w-100 h-100 position-absolute" alt="no-image">
						<label for="image" class="text-white text position-absolute p-5 "><span class="text">click to upload</span></label>
						<p id="size"></p>
					</div>	
					<div class="col-md-6">
					</div>
				</div>
			</div>
			<div>
				<button type="submit" class="btn btn-success"  id="submit">Lưu</button>
			</div>
		</form>
      </div>
    </div>
  </div>
</div>




{{-- Modal view description --}}
<div class="modal fade" id="descriptionModal" >
	<div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
		<div class="modal-content">
		<div class="modal-header">
		<h5 class="modal-title" id="modal-action-title-view">Thông tin chi tiết</h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
		</div>
		<div class="modal-body">
			<div class="row">
                <div class="col-md-12" class="container px-3 py-5">
					<div class="d-flex justify-content-center" >
						<img src="" alt="" id="image_view" width="480" height="240" >
					</div>
					<h1 id="title_view" class="text-center"></h1>
                    <div id="description_view"></div>
				</div>
			</div>
		</div>
	
	</div>
	</div>
</div>