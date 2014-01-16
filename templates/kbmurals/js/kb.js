$(document).ready(function(){
	$("#thumbnail_detail").dialog({
		modal: true,
		autoOpen: false,
		width: 680,
		height: 600,
		title : "Image Detail"
	});
	
	$("#thumbnails img").live("click",function(){
		var image_id = $(this).attr("rel");
		open_thumbnail_detail(image_id);
	});
	
	$("#theme_nav a").click(function(){
		var theme = "";
		theme = $(this).attr("rel");
		$.ajax({
			url: "../controllers/",
			data : {action:"get_thumbnails","theme":theme},
			type : "POST",
			beforeSend : function(){
				$("#thumbnails").html("");
				$("#loading").show();
			},
			success : function(data){
				if(data.status == "success"){
					$("#loading").hide();
					$("#thumbnails").html(data.content);
				}
			},
			dataType : "json"
		});
		
	});
	
	$(".select_image").live("click",function(){
			var image_id = $(this).closest('div').children("img").attr("rel");
			window.location.href = "ready_to_hang_preview.php?image_id=" + image_id;
		}
	);
	
	$(".select_image_from_detail").live("click",function(){
		var image_id = $(this).closest('#thumbnail_detail').attr("rel");
	});
});

function open_thumbnail_detail(image_id){
	var image_url = "http://lorempixel.com/640/480/nature/" + image_id + "/";
	$("#thumbnail_detail img").attr("src",image_url);
	$("#thumbnail_detail img").attr("rel",image_id);
	$("#thumbnail_detail").dialog("open");
}











