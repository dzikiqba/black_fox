// JavaScript Document
var url = "/blackfox/";

$(function() {
	$('#photos a').lightBox({fixedNavigation:true,
	imageLoading: url+'public/static/img/lightbox-ico-loading.gif',
	imageBtnClose: url+'public/static/img/lightbox-btn-close.gif',
	imageBtnPrev: url+'public/static/img/lightbox-btn-prev.gif',
	imageBtnNext: url+'public/static/img/lightbox-btn-next.gif',	
	
	});
});

function savein(id) {
	$.ajax({
    url: url+'json',
    type: 'GET',
	data: {id:id},
    success: function(result) {
		
        $('#'+id).html('saved');	
    }
});
	
}
