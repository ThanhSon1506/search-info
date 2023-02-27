function contact() {
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
		var table = $("#table-contact").DataTable({
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
					title: "Họ và tên",
					data: "contact_name",
					name: "contact_name",
					className: "",

				},
				{
					title: "Số điện thoại",
					data: "contact_phone",
					name: "contact_phone",
					className: "",
				},
				{
					title: "Email",
					data: "contact_email",
					name: "contact_email",
					className: "",
				},
				{
					title: "Nội dung",
					data: "contact_content",
					name: "contact_content",
					className: "text-center",
				},
				{
					title: "Thao tác",
					data: "id",
					name: "id",
					className: "text-center",
					bSortable: false,
					render: function (data, type, row, meta) {
						return renderAction([
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
		$("#search").on('keyup', function (e) {
			table.ajax.reload();
		});
		$("#formSearch").on('submit', function (e) {
			e.preventDefault();
			table.ajax.reload();
		});

		$(document).delegate(".btn-delete", "click", function () {
			var id = $(this).val();
			$('#modal-text-delete').text(" Bạn có muốn xóa không ?");
			$("#onDelete").attr('value', id);
			$("#modal-delete").modal('show');
		});

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