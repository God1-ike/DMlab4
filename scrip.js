$("#complite").click( function() { 
var str = document.getElementById("str").value; 
var start = document.getElementById("start").value; 
var end = document.getElementById("end").value; 
if(str != "") {
	$.ajax({ 
	type: "POST", 
	url: "script.php", 
	data: {str: str, start: start, end: end}, 
		success: function(res) { 
			document.getElementById("out").innerHTML = res; 
		} 
	});
} else {
	document.getElementById("out").innerHTML = "Введите хотябы 1-ну пару"; 
}
}); 	