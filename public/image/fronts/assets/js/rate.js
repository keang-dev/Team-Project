$(document).ready(function(){
	  /* 1. Visualizing things on Hover - See next part for action on click */
	$('#stars li').on('mouseover', function(){
		var onStar = parseInt($(this).data('value'), 10); // The star currently mouse on

		// Now highlight all the stars that's not after the current hovered star
		$(this).parent().children('li.star').each(function(e){
			if (e < onStar) {
				$(this).addClass('hover');
			}
			else {
				$(this).removeClass('hover');
			}
		});

		}).on('mouseout', function(){
			$(this).parent().children('li.star').each(function(e){
			$(this).removeClass('hover');
		});
	});

	/* 2. Action to perform on click */
	$('#stars li').on('click', function(){
		var onStar = parseInt($(this).data('value'), 10); // The star currently selected
		var stars = $(this).parent().children('li.star');
		$("#rate_number").val(onStar);

		for (i = 0; i < stars.length; i++) {
			$(stars[i]).removeClass('selected');
		}

		for (i = 0; i < onStar; i++) {
			$(stars[i]).addClass('selected');
		}

		// JUST RESPONSE (Not needed)
		// var ratingValue = parseInt($('#stars li.selected').last().data('value'), 10);
		// var msg = "";
		// if (ratingValue > 1) {
		// 	msg = "Thanks! You rated this " + ratingValue + " stars.";
		// }
		// else {
		// 	msg = "We will improve ourselves. You rated this " + ratingValue + " stars.";
		// }
		// responseMessage(msg);

	});

	//Rating progress bar
	var elem = document.getElementById("myBar");   
	var width = 1;
	var id = setInterval(frame, 10);
	function frame() {
		if (width >= 100) {
			clearInterval(id);
		} else {
			width++; 
			elem.style.width = width + '%'; 
		}
	}
});

