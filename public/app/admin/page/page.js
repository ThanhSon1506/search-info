function page() {
	// CKEDITOR.replace('pages_content');
	this.datas = null;
	var datas = null;
	this.init = function () {
		datas = this.datas;
		var me = this;
		me.datatables();
	}
	//Datatable
	this.datatables = function () {
		var me = this;
		var table = $("#table-pages").DataTable({
			serverSide: true,
			processing: true,
			paging: true,
			lengthChange: true,
			searching: false,
			ordering: true,
			info: true,
			responsive: true,
			autoWidth: false,
			ajax: {
				url: datas.routes.datatable,
				type: "GET",
				data: function (d) {
					return $.extend({}, d, {
						search: $("#search").val(),
					});
				}
			},
			order: [0, "desc"],
			columns: [
				{
					title: "Tên Trang",
					data: "pages_name",
					name: "pages_name",
					className: "",

				},
				{
					title: "Đường dẫn",
					data: "pages_slug",
					name: "pages_slug",
					className: "",
				},
				{
					title: "Mô tả",
					data: "id",
					name: "id",
					className: "text-center",
					render: function (data, type, row, meta) {
						if (data === null) {
							return 'Chưa có dữ liệu';
						} else {
							return '<button class="btn btn-outline-secondary" value="' + row.id + '"><i class="fa fa-eye"></i></button>';
						}

					}
				},
				{
					title: "Thao tác",
					data: "id",
					name: "id",
					className: "text-center",
					bSortable: false,
					render: function (data, type, row, meta) {
						return renderAction([{
							class: 'btn-update',
							value: row.id,
							title: 'Chỉnh Sửa',
							icon: 'fas fa-edit',
							color: 'primary'
						},
						{
							class: 'btn-delete',
							value: row.id,
							title: 'Xóa',
							icon: 'fa fa-trash',
							color: 'danger'
						}]);
					}
				},]
		});
		me.action(table);
	}
	//Actions
	this.action = function (table) {
		// Quill js
		var toolbarOptions = [
			[{
				'header': [1, 2, 3, 4, 5, 6, false]
			}],
			['bold', 'italic', 'underline', 'strike', 'blockquote', 'code-block'],
			[{
				'list': 'ordered',
			}, {
				'list': 'bullet'
			}],
		];

		var pages_content = new Quill('#pages_content_quill', {
			modules: {
				toolbar: toolbarOptions
			},
			theme: 'snow'
		});
		//search data in keywork
		$("#search").on('keyup', function (e) {
			table.ajax.reload();
		});
		//search data in keywork
		$("#formSearch").on('submit', function (e) {
			e.preventDefault();
			table.ajax.reload();
		});
		//fetch data in modal deltail
		$(document).delegate(".btn-outline-secondary", "click", function () {
			var id = $(this).val();
			$('#modal-action-title-view').text("Chi tiết mô tả");
			$("#modal-action-view-description").modal('show');
			$.ajax({
				url: datas.routes.update,
				data: {
					id: id
				},
				type: 'GET',
				dataType: 'JSON',
				success: function (data) {
					$('#pages_description_view').html(data.data.pages_content);
				},
				error: function (error) {
					console.log(error);
				}
			});
		});
		// fetch data in modal update
		$(document).delegate(".btn-update", "click", function () {
			var id = $(this).val();
			$("#submit").attr('data-url', datas.routes.update);
			$("#modal-title").text("Cập nhật dữ liệu");
			$("#submit").attr('data-action', 'update');
			$("#pageModal").modal('show');
			$.ajax({
				url: datas.routes.update,
				data: {
					id: id
				},
				type: 'GET',
				dataType: 'JSON',
				success: function (data) {
					$("#submit").attr('data-url', datas.routes.update);
					$("#submit").attr('data-id', data.data.id);
					$('#pages_name').val(data.data.pages_name)
					// CKEDITOR.instances['pages_content'].setData(data.data.pages_name);
					pages_content.root.innerHTML = data.data.pages_content;

				},
				error: function (error) {
					console.log(error);
				}
			});


		});
		// fetch data in modal insert
		$("#btn-insert").on("click", function () {
			$("#submit").attr('data-url', datas.routes.insert);
			$("#modal-title").text("Thêm mới dữ liệu");
			$("#submit").attr('data-action', 'insert');
			$("#pages_name").val('');
			// CKEDITOR.instances['pages_content'].setData('');
			pages_content.root.innerHTML = "";

			$("#pageModal").modal('show');
		});

		// Insert and update data with form
		$('#pageForm').validate({
			rules: {

				pages_name: {
					required: true,
					validateScript: true,
					maxlength: 150
				},

			},
			messages: {
				pages_name: {
					required: "Tên trang không được trống !",
					maxlength: "Tên trang không quá 150 ký tự !"
				}
			},
			errorElement: 'span',
			errorPlacement: function (error, element) {
				error.addClass('invalid-feedback');
				element.closest('.form-group').append(error);
			},
			highlight: function (element, errorClass, validClass) {
				$(element).addClass('is-invalid');
			},
			unhighlight: function (element, errorClass, validClass) {
				$(element).removeClass('is-invalid');
			},
			submitHandler: function (e) {
				// var getDescription = CKEDITOR.instances['pages_content'].getData();
				var getDescription = document.getElementById('pages_content').value = pages_content.root.innerHTML;

				var formData = new FormData($("#pageForm")[0]);
				formData.append('pages_content', getDescription);
				formData.append('id', $("#submit").attr('data-id'));
				var url = $('#submit').attr('data-url');
				$.ajax({
					url: url,
					data: formData,
					type: 'POST',
					dataType: 'JSON',
					processData: false,
					contentType: false,
					success: function (data) {
						if (data.status_validate === 1) {
							alert(data.data_error);
						} else {
							toastr.success(data.name);
							$('#pageForm')[0].reset();
							$('#pageModal').modal('hide');
							table.ajax.reload();
						}
					},
					error: function (error) {
						console.log("Lỗi");
					}
				});
			}

		});
		// Open delete dialog
		$(document).delegate(".btn-delete", "click", function () {
			var id = $(this).val();
			$('#modal-text-delete').text(" Bạn có muốn xóa không ?");
			$("#onDelete").attr('value', id);
			$("#modal-delete").modal('show');
		});
		//Delete dât
		$("#onDelete").on("click", function (e) {
			e.preventDefault(e);
			var id = $(this).val();
			var result = AjaxDelete({
				id: id
			}, datas.routes.delete);
			if (result) {
				table.ajax.reload();
				$("#modal-delete").modal('hide');
			} else {
				$("#modal-delete").modal('hide');
			}
		});
		// Check validate value text
		jQuery.validator.addMethod("validateScript", function (value, element) {
			return !(value.includes("script>") ||
				value.includes("script&gt;") ||
				value.includes("<?") ||
				value.includes("&lt;?"));
		}, "Vui lòng nhập đúng định dạng chữ");


	}


}