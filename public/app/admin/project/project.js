function handleDate(date) {
	var d1 = new Date();
	var d2 = new Date(date);
	return d1 < d2;
}
function changeDate(data) {
	if (data == null || data == "") {
		return "";
	} else {
		return moment(data, "YYYY-MM-DD").format('DD/MM/YYYY')
	}
}
function project() {
	// init ckeditor
	// CKEDITOR.replace('projects_description');
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
		var table = $("#table-projects").DataTable({
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
					title: "Khách hàng/Công ty",
					data: "full_name",
					name: "full_name",
					className: "",

				},
				{
					title: "Dịch vụ",
					data: "services_name",
					name: "services_name",
					className: "",
				},
				{
					title: "Tên dự án",
					data: "projects_name",
					name: "projects_name",
					className: "",
				},
				{
					title: "Ngày bắt đầu",
					data: "time_start",
					name: "time_start",
					className: "",
					render: function (data, type, row, meta) {
						return changeDate(data);
					}
				},
				{
					title: "Ngày kết thúc",
					data: "time_end",
					name: "time_end",
					className: "",
					render: function (data, type, row, meta) {
						return changeDate(data);
					}
				},
				{
					title: "Trạng Thái",
					data: "time_end",
					name: "time_end",
					className: "",
					render: function (data, type, row, meta) {
						if (data == null) {
							return data;
						} else {
							if (handleDate(data)) {
								return 'Còn Hiệu Lực';
							} else {
								return '<span class="text-danger">Hết Hiệu Lực</span>';
							}
						}
					}
				},
				{
					title: "Mô tả",
					data: "id",
					name: "id",
					className: "",
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
					className: "",
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

		var projects_description = new Quill('#projects_description_quill', {
			modules: {
				toolbar: toolbarOptions
			},
			theme: 'snow'
		});
		// search data by key word
		$("#search").on('keyup', function (e) {
			table.ajax.reload();
		});
		// 
		Filevalidation = () => {
			const file = document.getElementById('projects_file');
			listFile.innerHTML = file;
		}
		// 
		window.addEventListener('load', function () {
			var listFile = document.getElementById('list_file');
			document.querySelector('input[type="file"]').addEventListener('change', function () {
				if (this.files && this.files[0]) {
					listFile.innerHTML = this.files[0].name;
				}
			});
		});
		// search data by key word
		$("#formSearch").on('submit', function (e) {
			e.preventDefault();
			table.ajax.reload();
		});
		// Open dialog detail
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
					$('#projects_description_view').html(data.data.projects_description);
				},
				error: function (error) {
					console.log(error);
				}
			});
		});
		// Open dialog update
		$(document).delegate(".btn-update", "click", function () {
			var id = $(this).val();
			$("#modal-title").text("Cập nhật dữ liệu");
			$("#projectModal").modal('show');
			$.ajax({
				url: datas.routes.update,
				data: {
					id: id
				},
				type: 'GET',
				dataType: 'JSON',
				success: function (data) {
					var listFile = document.getElementById('list_file');
					$("#submit").attr('data-url', datas.routes.update);
					$("#submit").attr('data-id', data.data.id);
					$('#projects_name').val(data.data.projects_name);
					$('#userID').val(data.data.userID);
					$('#serviceID').val(data.data.serviceID);
					$('#time_start').val(data.data.time_start);
					$('#time_end').val(data.data.time_end);
					listFile.innerHTML = data.data.projects_file;
					listFile.setAttribute('href', '/uploads/' + data.data.projects_file);
					projects_description.root.innerHTML = data.data.projects_description;

					// CKEDITOR.instances['projects_description'].setData(data.data.projects_description),
					$('#projects_file').val(data.data.projects_file)
				},
				error: function (error) {
					console.log(error);
				}
			});


		});
		// Open dialog insert
		$("#btn-insert").on("click", function () {
			var listFile = document.getElementById('list_file');
			$("#submit").attr('data-url', datas.routes.insert);
			$("#modal-title").text("Thêm mới dữ liệu");
			$("#submit").attr('data-action', 'insert');
			$("#projects_name").val('');
			$('#projects_file').val('');
			$('#userID').val('');
			$('#serviceID').val('');
			listFile.innerHTML = "";
			// CKEDITOR.instances['projects_description'].setData('');
			projects_description.root.innerHTML = '';

			$('#time_start').val('');
			$('#time_end').val('');
			$("#projectModal").modal('show');
		});
		// Insert and update data
		$('#projectForm').validate({
			rules: {
				serviceID: {
					required: true
				},
				userID: {
					required: true
				},
				projects_name: {
					required: true,
					maxlength: 150,
					validateScript: true
				},
				time_start: {
					required: true
				},
				time_end: {
					required: true
				},
				projects_file: {
					required: false,
					extension: "jpeg|png|jpg|gif|pdf|doc|docx|xls|xlxs|zip|rar|txt"
				}
			},
			messages: {
				serviceID: {
					required: "Vui lòng chọn dịch vụ!"
				},
				userID: {
					required: "Vui lòng chọn Công Ty!"
				},
				projects_name: {
					required: "Vui lòng nhập tên dự án !",
					maxlength: "Tên dự án không quá 150 ký tự !"
				},
				time_start: {
					required: "Vui lòng chọn ngày bắt đầu !"
				},
				time_end: {
					required: "Vui lòng chọn ngày kết thúc !"
				},
				projects_file: {
					extension: "Vui lòng chọn file jpeg,png,jpg,gif,pdf,doc,docx,xls,xlxs,zip,rar,txt"
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
				var getDescription = document.getElementById('projects_description').value = projects_description.root.innerHTML;
				var url = $('#submit').attr('data-url');
				var formData = new FormData($("#projectForm")[0]);
				formData.append('projects_file', $('#projects_file')[0].files[0]);
				formData.append('projects_description', getDescription);
				formData.append('id', $("#submit").attr('data-id'));
				$.ajax({
					url: url,
					data: formData,
					type: 'POST',
					contentType: false,
					processData: false,
					success: function (data) {
						console.log(data);
						if (data.status_validate === 1) {
							alert(data.data_error);
						} else {
							toastr.success(data.name);
							$('#projectForm')[0].reset();
							$('#projectModal').modal('hide');
							table.ajax.reload();
						}
					},
					error: function (error) {
						console.log("Lỗi");
						console.log(error);
					}
				});
			}

		});
		// Open dialog delete
		$(document).delegate(".btn-delete", "click", function () {
			var id = $(this).val();
			$('#modal-text-delete').text(" Bạn có muốn xóa không ?");
			$("#onDelete").attr('value', id);
			$("#modal-delete").modal('show');
		});
		// Delete data
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