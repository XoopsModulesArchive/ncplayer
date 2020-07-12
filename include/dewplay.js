$(document).ready(function(){
	
	var listurl = $("#listurl").attr('url');
	
	$.ajax({
		type: "GET",
		url: listurl,
		cache: false ,
		success: function(msg){
			$("#musiclist").html(msg);
		}	
	});
	
	$("#musicbutton").click(function(){
		var name = $("#musicname").val();
		var url  = $("#musicurl").val();
		var op  = $("#musicbutton").attr('op');
		var msg = '';
		
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
	
	$("#top500button").click(function(){
		var url  = $("#searchurl").attr("url");
		var op  = $(this).attr('op');
		$.ajax({
			type: "GET",
			url: url,
			cache: false ,
			data: 'op=' + op ,
			success: function(msg1){
				$("#top500result").html(msg1);
			}	
		});	
	});
	
	$("#musicsearch").click(function(){
		var url  = $("#searchurl").attr("url");
		var op  = $(this).attr('op');
		var word  = $("#searchword").val();
		$.ajax({
			type: "GET",
			url: url,
			cache: false ,
			data: 'op=' + op + '&word=' + word,
			success: function(msg1){
				$("#searchresult").html(msg1);
			}	
		});	
	});
			
});

function validateUrl(o)
 {
  var pattern = /^http:\/\/?.+\.mp3$/;
  return pattern.test(o);
 }