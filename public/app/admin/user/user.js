const { isEmpty } = require("lodash");

function user() {
	// CKEDITOR.replace('note');
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

	var note = new Quill('#note_quill', {
		modules: {
			toolbar: toolbarOptions
		},
		theme: 'snow'
	});
	this.datas = null;
	var datas = null;
	this.init = function () {
		datas = this.datas;
		var me = this;
		me.datatables();
	}
	//Datatables
	this.datatables = function () {
		var me = this;
		var table = $("#table-users").DataTable({
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
					title: "Tên KH",
					data: "full_name",
					name: "full_name",
					className: "",

				},
				{
					title: "Email",
					data: "email",
					name: "email",
					className: "",
				},
				{
					title: "Địa chỉ",
					data: "address",
					name: "address",
					className: "text-center",
				},
				{
					title: "Số điện thoại",
					data: "phone_number",
					name: "phone_number",
					className: "text-center",
				},
				{
					title: "Ghi chú",
					data: "note",
					name: "note",
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
					title: "Từ khóa",
					data: "keyword",
					name: "keyword",
					className: "text-center",
				},
				{
					title: "Thao tác",
					data: "id",
					name: "id",
					className: "text-center",
					bSortable: false,
					render: function (data, type, row, meta) {
						if (row.is_admin == 0) {
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
						return '<i class="fas fa-ban"></i>';

					}
				},]
		});
		me.action(table);
	}
	//Action
	this.action = function (table) {
		$("#search").on('keyup', function (e) {
			table.ajax.reload();
		});
		$("#formSearch").on('submit', function (e) {
			e.preventDefault();
			table.ajax.reload();
		});
		// Open dialog insert 
		$("#btn-insert").on("click", function () {
			$('.hide').show();
			$('#userTitle').text("Thêm mới dữ liệu");
			$('#passwordLabel').text("(mặc định: abc123456)");
			$("#submit").attr('data-url', datas.routes.insert);
			$("#submit").attr('data-id', "");
			$('#full_name').val('');
			$('#email').val('');
			$('#password').val('abc123456');
			$('#address').val('');
			$('#phone_number').val('');
			$('#keyword').val('');
			// CKEDITOR.instances['note'].setData("");
			note.root.innerHTML = '';
			$("#userModal").modal('show');
		});
		// Open dialog update
		$(document).delegate(".btn-update", "click", function () {
			$('#userTitle').text("Cập nhật dữ liệu");
			$('#passwordLabel').text("(Không bắt buộc)");
			$('.hide').hide();
			$("#userModal").modal('show');
			var id = $(this).val();
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
					$('#full_name').val(data.data.full_name);
					$('#email').val(data.data.email);
					$('#address').val(data.data.address);
					$('#phone_number').val(data.data.phone_number);
					$('#keyword').val(data.data.keyword);
					$('#password').val('');
					note.root.innerHTML = data.data.note;

					// CKEDITOR.instances['note'].setData(data.data.note);
				},
				error: function (error) {
					console.log(error);
				}
			});
		});

		// Insert and update data
		$('#userForm').validate({
			rules: {
				full_name: {
					required: true,
					validateScript: true
				},
				email: {
					required: true,
					validateScript: true
				},
				password: {
					validatePassword: true
				},
				address: {
					required: true,
					validateScript: true
				},
				phone_number: {
					required: true,
					validatePhone: true,
					minlength: 10,
					maxlength: 10,
				},
				keyword: {
					required: true,
					validateScript: true
				}

			},
			messages: {
				full_name: {
					required: "Tên khách hàng/công ty không được trống !"
				},
				email: {
					required: "Email không được trống !"
				},
				address: {
					required: "Địa chỉ không được trống !"
				},
				phone_number: {
					required: "Số điện thoại không được trống !",
					minlength: "Vui lòng nhập đủ 10 ký tự",
					maxlength: "Vui lòng nhập tối thiểu 10 ký tự"
				},
				keyword: {
					required: "Từ khóa không được trống !"
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
				// var getNote = CKEDITOR.instances['note'].getData();
				var getNote = document.getElementById('note').value = note.root.innerHTML;
				var url = $('#submit').attr('data-url');
				var formData = new FormData($("#userForm")[0]);
				formData.append('note', getNote);
				formData.append('id', $("#submit").attr('data-id'));
				$.ajax({
					url: url,
					data: formData,
					type: 'POST',
					contentType: false,
					processData: false,
					success: function (data) {
						if (data.status_validate === 1) {
							alert(data.data_error);
						} else {
							$("#userModal").modal('hide');
							toastr.success(data.name);
							table.ajax.reload();
						}


					},
					error: function (error) {
						console.log("Lỗi");
					}
				});
			}


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
					$('#users_note_view').html(data.data.note);
				},
				error: function (error) {
					console.log(error);
				}
			});
		});
		//Open dialog delete
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
		// Check validate value phone
		jQuery.validator.addMethod("validatePhone", function (value, element) {
			if (/((09|03|07|08|05)+([0-9]{8})\b)/g.test(value)) {
				return true;
			} else {
				return false;
			};
		}, "Vui lòng nhập đúng định dạng số điện thoại");
		// Check validate value password
		$.validator.addMethod("validatePassword", function (value, elemt) {
			return this.optional(elemt) || /^[\w'\-,.][^_!¡?÷?¿/\\+=@#$%ˆ&*(){}|~<>;:[\]]{8,}$/.test(value);
		}, 'Vui lòng nhập 8 ký tự, có chữ và số');


	}


}