cekLebar();
cekPanjang();

$(window).on("resize", function() {
	cekLebar();
	cekPanjang();
});

var urlMenu = window.location;
$('#menu ul li a[href="' + urlMenu + '"]').parent().addClass("active");
$("#menu ul li a").filter(function() {
	return this.href == urlMenu;
}).parent().addClass("active");

$("#sidebar ul li").on("click", function() {
	$(this).toggleClass("active");
});

function cekLebar() {
	var lebar = $("body .container-fluid").outerHeight(true);
	if (lebar < $(window).height()) {
		$(".footer").addClass("fixed-bottom");
	} else {
		$(".footer").removeClass("fixed-bottom");
	}
}
function cekPanjang() {
	if ($(window).width() <= 678) {
		$("#sidebar").addClass("border-bottom");
		$("#sidebar").removeClass("border-right");
		$("#sidebarVarian").addClass("border-bottom");
		$("#sidebarVarian").removeClass("border-right");
	} else {
		$("#sidebar").addClass("border-right");
		$("#sidebar").removeClass("border-bottom");
		$("#sidebarVarian").addClass("border-right");
		$("#sidebarVarian").removeClass("border-bottom");
	}
}