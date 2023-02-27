function home() {

	this.datas = null;

	var datas = null;

	this.init = function () {
		datas = this.datas;
		var me = this;
		me.datatables();
		me.action();
	}

	this.datatables = function () {
		var getDataSearch = null;
		var table = $("#table-search-info").DataTable({
			serverSide: true,
			processing: true,
			pageLength: datas.pageLength,
			paging: true,
			lengthChange: false,
			searching: false,
			ordering: true,
			info: true,
			autoWidth: false,
			ajax: {
				url: datas.routes.search,
				type: 'GET',
				data: function (d) {
					return $.extend({}, d, {
						search: getDataSearch,
					});
				},
			},
			order: [0, "desc"],
			columns: [
				{
					title: "#",
					data: "id",
					name: "id",
					className: "text-center",
					render: function (data, type, row, meta) {
						return meta.row + meta.settings._iDisplayStart + 1;
					}
				},
				{
					title: "Khách hàng / Công Ty",
					data: "full_name",
					name: "full_name",
					className: "text-center",
					render: function (data, type, row, meta) {
						if (data === null) {
							return 'Chưa có dữ liệu';
						} else {
							return data;
						}

					},
				},
				{
					title: "Số điện thoại",
					data: "phone_number",
					name: "phone_number",
					className: "text-center",
					render: function (data, type, row, meta) {
						if (data === null) {
							return 'Chưa có dữ liệu';
						} else {
							return data;
						}

					},
				},
				{
					title: "Dịch Vụ",
					data: "services_name",
					name: "services_name",
					className: "text-center",
					render: function (data, type, row, meta) {
						if (data === null) {
							return 'Chưa có dữ liệu';
						} else {
							return data;
						}

					},
				},
				{
					title: "Dự Án",
					data: "projects_name",
					name: "projects_name",
					className: "text-center",
					render: function (data, type, row, meta) {
						if (data === null) {
							return 'Chưa có dữ liệu';
						} else {
							return data + '<span class="btn-info-project" id-project="' + row.projects_name + '"> (Chi tiết) </a>';
						}

					},
				},
				{
					title: "Từ khóa",
					data: "keyword",
					name: "keyword",
					className: "text-center",
				},
				{
					title: "Trạng Thái",
					data: "time_end",
					name: "time_end",
					className: "text-center",
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
				}
			]
		});

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

		$('#form-search').on('submit', function (event) {
			event.preventDefault();
		});

		$('#form-search').validate({
			rules: {
				keyword: {
					required: true
				},
			},
			messages: {
				keyword: {
					required: "Từ khóa tìm kiếm không được trống !",
				},
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
				var formData = new FormData($("#form-search")[0]);
				getDataSearch = formData.get("keyword");
				table.ajax.reload();
				if ($('#result').hasClass('d-none')) {
					$('#result').removeClass('d-none');
				}
			}
		});
		$("#form-search").on('submit', function (e) {
			e.preventDefault();

		});

		$(document).delegate(".btn-info-project", "click", function () {
			var projectID = $(this).attr('id-project');
			$.ajax({
				url: datas.routes.information,
				data: {
					projectID: projectID
				},
				type: 'GET',
				dataType: 'JSON',
				success: function (data) {
					$('.projects_name').text(data.data.projects_name);
					$('.time_start').text(changeDate(data.data.time_start));
					$('.time_end').text(changeDate(data.data.time_end));
					$('.projects_description').html(data.data.projects_description);
					if (data.data.projects_file === null) {
						$('.projects_file').html('Chưa có file nào');
					} else {
						$('.projects_file').html('<a href="uploads/' + data.data.projects_file + '">Download</a>');
					}
					$("#ModalInfoProject").modal('show');
				},
				error: function (error) {
					alert("Lỗi");
					console.log(error);
				}
			});

		});


	}
	this.action = function () {
		// var y = document.getElementsByClassName("hidden").parentElement;
		// var x = document.querySelectorAll(".hidden");
		// for (let i = 0; i < x.length; i++) {
		// 	x[i].parentElement.remove();
		// }
	}
}