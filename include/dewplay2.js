$(document).ready(function(){
	$("span.play").click(function(){
		var music = $(this).attr('music');
		var url = $("#url").attr('url');
		
		$.ajax({
			type: "GET",
			url: url,
			cache: false ,
			data: "music=" + music,
			success: function(msg){
				$("#player").html(msg);
			}	
		});
	});
	
	$("span.delete").click(function(){
		var listurl = $("#listurl").attr('url');
		var id = $(this).attr('musicid');
		var op = $(this).attr('op');
		$.ajax({
			type: "GET",
			url: listurl,
			cache: false ,
			data: "op=" + op + "&id=" + id,
			success: function(msg){
				$("#musiclist").html(msg);
			}	
		});
	});
	
	$("#add").click(function(){
		if ( $("#add1").css('display') == 'block' ) {
			$("#add1").css('display', 'none');
		} else {
			$("#add1").css('display', 'block');
		}
	});
	
	$("#search").click(function(){
		if ( $("#search1").css('display') == 'block' ) {
			$("#search1").css('display', 'none');
		} else {
			$("#search1").css('display', 'block');
		}
	});
	
	$("span.nav").click(function(){
		var listurl = $("#listurl").attr('url');
		var start = $(this).attr('start');
		$.ajax({
			type: "GET",
			url: listurl,
			cache: false ,
			data: 'start=' + start,
			success: function(msg){
				$("#musiclist").html(msg);
			}	
		});
	});
	
	
	$("#top500").click(function(){
		if ( $("#top5001").css('display') == 'block' ) {
			$("#top5001").css('display', 'none');
		} else {
			$("#top5001").css('display', 'block');
		}
	});
	
//	$("span.nav").click(function(){
//		var listurl = $("#listurl").attr('url');
//		var start = $(this).attr('start');
//		$.ajax({
//			type: "GET",
//			url: listurl,
//			data: 'start=' + start,
//			success: function(msg){
//				$("#musiclist").html(msg);
//			}	
//		});
//	});

	$(".checkbox").click(function(){
		var url  = $(this).attr("music");
		if ( $(this).attr("checked") ) {
			var list  = $("#mutilmusiclist").attr('musiclist');
			if ( list ) {
				var str = list + '|' + url ;
			} else {
				var str = url ;
			}
			$("#mutilmusiclist").attr('musiclist', str);
		} else {
			var list  = $("#mutilmusiclist").attr('musiclist');
			if ( list ) {
				listArr = list.split('|');
				var newListArr = new Array();
				var i = 0;
				for ( i=0 ; i < listArr.length ; i++ ) {
					if ( listArr[i] != url ) {
						newListArr.push(listArr[i]);
					} 
				}
				var str = newListArr.join("|");
				$("#mutilmusiclist").attr('musiclist', str);
			}
			
		}

	});	
	
	$("#multiplay").click(function(){
		var music = $("#multimusiclist").attr('musiclist');
		var url = $("#url").attr('url');
		$.ajax({
			type: "GET",
			url: url,
			cache: false ,
			data: "music=" + music,
			success: function(msg){
				$("#player").html(msg);
				$("#multimusiclist").attr('musiclist', '');
			}	
		});
	});
	
	
});
