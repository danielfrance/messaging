//Main



	function get_messages_submit()
	{
		 var url = "/show_comment";
		  $.ajax({
		  	url: url,
		  	type: 'GET',
		  	dataType: 'json',
		  	data: '',
		  })
		  .success(function(data){
		  	// console.dir(data);

			var id = data.id	
			// console.log(id);

			var last = $('.comment').last(); 

			var last_comment = last[0].attributes[1].nodeValue;
			// console.dir(last_comment);

			if (id != last_comment) {
				var html = "<div class='comment' data-id='"+ data.id +"'>"+
					    "<a class='avatar'>" +
					      "<img src='images/avatars/"+ data.avatar +"'>" +
					    "</a>"+
					   "<div class='content'>" +
					      "<a class='author'>"+data.name+"</a>" +
					      "<div class='metadata'>" +
					        "<span class='date'>"+data.created_at+"   </span>" +
					      "</div>"+
					      "<div class='text'>" +
					        data.comment
					      +"</div>" +
					    "</div> "+
					  "</div>";

				$(html).insertAfter(last);
				scroll_bottom();


			};

		  })
	}

	function get_messages()
	{

		window.setInterval(function(){
		  // location.reload();

		  var url = "/show_comment";
		  $.ajax({
		  	url: url,
		  	type: 'GET',
		  	dataType: 'json',
		  	data: '',
		  })
		  .success(function(data){
		  	// console.dir(data);

			var id = data.id	
			// console.log(id);

			var last = $('.comment').last(); 

			var last_comment = last[0].attributes[1].nodeValue;
			// console.dir(last_comment);

			if (id != last_comment) {
				var html = "<div class='comment' data-id='"+ data.id +"'>"+
					    "<a class='avatar'>" +
					      "<img src='images/avatars/"+ data.avatar +"'>" +
					    "</a>"+
					   "<div class='content'>" +
					      "<a class='author'>"+data.name+"</a>" +
					      "<div class='metadata'>" +
					        "<span class='date'>"+data.created_at+"   </span>" +
					      "</div>"+
					      "<div class='text'>" +
					        data.comment
					      +"</div>" +
					    "</div> "+
					  "</div>";

				$(html).insertAfter(last);

				scroll_bottom();

			};

		  })
		  

		}, 5000);
	}



function scroll_bottom()
{
	var cont = $('#comment_area');
	cont[0].scrollTop = cont[0].scrollHeight;

	

}

	$(document).ready(function() {
		
		scroll_bottom();

		get_messages();


		$('#submit').on('click', function(event) {
			event.preventDefault();
	
			var url  = "/store_comment";

			$.ajax({
				url: url,
				type: 'POST',
				dataType: 'json',
				data: $('form#comment_form').serialize(),
			})
			.success(function(data){
				$('form#comment_form').find('textarea').val('');
				$('div.emoji-wysiwyg-editor').empty();
				get_messages_submit();
				
			})
			.fail(function() {
				console.log("error");
			})
			;
			


		});

		
		
		

	});