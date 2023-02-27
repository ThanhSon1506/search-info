$(document).ready(function () {
	$.ajaxSetup({ headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") } });
	console.log("ajax");
	var x = document.querySelectorAll(".hidden");
	for (let i = 0; i < x.length; i++) {
		x[i].parentElement.remove();
	}
});
jQuery(document).ready(function ($) {
	$('.share').click(function () {
		var NWin = window.open($(this).prop('href'), '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');
		if (window.focus) {
			NWin.focus();
		}
		return false;
	});
});