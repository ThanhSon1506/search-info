$(document).ready(function () {
	$.ajaxSetup({ headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") } });
});
function renderAction(data) {
	var htmlBtn = '';
	$.each(data, function (index, item) {
		htmlBtn += '<button type="button" class="mr-2 btn btn-' +
			item.color +
			' ' +
			item.class +
			'" value="' +
			item.value +
			'" title="' +
			item.title +
			'">' +
			'<i class="' +
			item.icon +
			'"></i></button>';
	});
	return htmlBtn;
}
function AjaxDelete(dataOject, url) {
	var checkBool = false;
	$.ajax({
		url: url,
		type: "POST",
		data: dataOject,
		dataType: "JSON",
		async: false,
		success: function (data) {
			if (data.statusBoolean) {
				checkBool = true;
				toastr.success(data.msg);
			}
			else {
				toastr.error(data.msg);
			}
		},
		error: function (error) {
			toastr.error(data.msg)
			console.log(error);
		},
	});
	return checkBool;
}
function AjaxPost(dataOject, url) {
	var checkBool = false;
	$.ajax({
		url: url,
		type: "POST",
		data: dataOject,
		dataType: "JSON",
		async: false,
		success: function (data) {
			checkBool = true;
			toastr.success(data.msg);
		},
		error: function (error) {
			toastr.error(data.msg)
			console.log(error);
		},
	});
	return checkBool;
}
function changeDate(data) {
	if (data == null || data == "") {
		return "";
	} else {
		return moment(data, "YYYY-MM-DD").format('DD/MM/YYYY')
	}
}