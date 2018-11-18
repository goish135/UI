$.get("./ww.php",function(data){
	$("html").html(data);
	console.log(data)
});