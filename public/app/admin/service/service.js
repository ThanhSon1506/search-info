function service() {
	// CKEDITOR.replace('services_description');
	this.datas = null;
	var datas = null;
	this.init = function () {
		datas = this.datas;
		var me = this;
		me.datatables();
	}
	// Datatables
	this.datatables = function () {
		var me = this;
		var table = $("#table-services").DataTable({
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
					title: "Tên Dịch Vụ",
					data: "services_name",
					name: "services_name",
					class: "text-center",
					className: "",

				},
				{
					title: "Mô Tả",
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
					title: "Đường dẫn",
					data: "services_slug",
					name: "services_slug",
					className: "text-center",
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
							title: 'Sửa',
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
	// Action
	this.action = function (table) {
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

		var services_description = new Quill('#services_description_quill', {
			modules: {
				toolbar: toolbarOptions
			},
			theme: 'snow'
		});
		$("#search").on('keyup', function (e) {
			table.ajax.reload();
		});
		$("#formSearch").on('submit', function (e) {
			e.preventDefault();
			table.ajax.reload();
		});
		$(document).delegate(".btn-outline-secondary", "click", function () {
			var id = $(this).val();
			$('#modal-action-title-view').text("Chi tiết mô tả");
			$("#deltaiModal").modal('show');
			$.ajax({
				url: datas.routes.update,
				data: {
					id: id
				},
				type: 'GET',
				dataType: 'JSON',
				success: function (data) {
					$('#services_description_view').html(data.data.services_description);
				},
				error: function (error) {
					console.log(error);
				}
			});
		});
		//Mở dialog cập nhật dữ liệu
		$(document).delegate(".btn-update", "click", function () {
			var id = $(this).val();
			$("#submit").attr('data-url', datas.routes.update);
			$("#modal-title").text("Cập nhật dữ liệu");
			$("#submit").attr('data-action', 'update');
			$("#serviceModal").modal('show');
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
					$('#services_name').val(data.data.services_name)
					// CKEDITOR.instances['services_description'].setData(data.data.services_description);
					services_description.root.innerHTML = data.data.services_description;

				},
				error: function (error) {
					console.log(error);
				}
			});
		});
		// Mở dialog thêm mới dữ liệu
		$("#btn-insert").on("click", function () {
			$("#submit").attr('data-url', datas.routes.insert);
			$("#modal-title").text("Thêm mới dữ liệu");
			$("#submit").attr('data-action', 'insert');
			$("#services_name").val('');
			// CKEDITOR.instances['services_description'].setData('');
			services_description.root.innerHTML = '';
			$("#serviceModal").modal('show');
		});
		// Thêm và cập nhật dữ liệu
		$('#formAction').validate({
			rules: {
				services_name: {
					required: true,
					maxlength: 150,
					validateScript: true
				},
			},
			messages: {
				services_name: {
					required: "Tên dịch vụ không được trống !",
					maxlength: "Tên dịch vụ không được quá 150 ký tự !"
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
				var getDescription = document.getElementById('services_description').value = services_description.root.innerHTML;
				// var getDescription = CKEDITOR.instances['services_description'].getData();
				var formData = new FormData($("#formAction")[0]);
				formData.append('services_description', getDescription);
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
							$('#formAction')[0].reset();
							$('#serviceModal').modal('hide');
							table.ajax.reload();
						}
					},
					error: function (error) {
						console.log("Lỗi");
					}
				});
			}

		});
		// Validate kiểm tra định dạng ký tự
		jQuery.validator.addMethod("validateScript", function (value, element) {
			return !(value.includes("script>") ||
				value.includes("script&gt;") ||
				value.includes("<?") ||
				value.includes("&lt;?"));
		}, "Vui lòng nhập đúng định dạng chữ");
		// Hàm mô tả trong dialog xóa
		$(document).delegate(".btn-delete", "click", function () {
			var id = $(this).val();
			$('#modal-text-delete').text(" Bạn có muốn xóa không ?");
			$("#onDelete").attr('value', id);
			$("#modal-delete").modal('show');
		});
		// Hàm xóa dữ liệu
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
	}


}