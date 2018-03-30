// Get the modal
var modal;
var span = document.getElementsByClassName("close")[0];

$('div.griddy').on('click', function(){
	var appid = $(this).attr('data-id');
	var modal = document.getElementById(appid);
	
	modal.style.display = "block";

	$('span.close').on('click', function() {
		var modal = $(this).parent().parent()[0];
		//console.log(modal); //.display = "none";
		modal.style.display = "none";
	});
	window.onclick = function(event) {
		if (event.target == modal) {
			modal.style.display = "none";
		}
	}
});

