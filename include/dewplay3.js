$(document).ready(function(){
	$("span.musiclist").click(function(){
		var listurl = $("#listurl").attr('url');
		var msg = '';
		var mid = $(this).attr('mid');
		var op = $(this).attr('op');
		var url = $('#'+mid).attr('url');
		var name = $('#'+mid).html();
		if ( !name ) {
			msg = "Music name required";
		} 
		if ( !url ) {
			msg = "Music URL required";
		} else {
			if ( !validateUrl(url) ) {
				msg = "URL is invalid. only mp3 address can be added!like:http://www.xx.com/xxx.mp3";
			}
		}
		
		if ( msg ) {
			formsg = $('#musicinfo').html();
			$('#musicinfo').html(msg);
			$('#musicinfo').fadeOut(3000, function(){
				$('#musicinfo').html(formsg).fadeIn(1000);
			});			
		} else {
			$.ajax({
				type: "GET",
				url: listurl,
				cache: false ,
				data: 'op=' + op + '&name=' + name + '&url=' + url ,
				success: function(msg1){
					$("#musiclist").html(msg1);
				}	
			});
		}
	});
	
	$("span.musiclistnav").click(function(){
		var url  = $("#searchurl").attr("url");
		var start = $(this).attr('start');
		$.ajax({
			type: "GET",
			url: url,
			cache: false ,
			data: 'op=list&searchstart=' + start,
			success: function(msg){
				$("#top500result").html(msg);
			}	
		});
	});
	
});
