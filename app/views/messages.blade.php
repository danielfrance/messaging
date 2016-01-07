@extends('layout')

@section('content')

	<header class='ui two item purple inverted menu'>
		<a href="" class="item">
			<i class='home icon'></i>
		</a>
		<a href="/logout" class='item'>
			<i class='sign out icon'></i>
		</a>
	</header>
	<div class="wrapper">
	<h2>Hi <?php echo Session::get('name') ?>, I was bored and needed to create</h2>
	<br><br>

	<br><br>
	<?php 
		// if (!is_null($response)) {
		// // dd($response);
	
		// 	echo "<div class='ui green message'>" . $response . "</div>";
			
		// 	Session::forget('response');
		// }

	 ?>
	
		<section class='comment_section '>
			<div class="ui comments">
				  <h3 class="ui dividing header">Comments</h3>

				  {{--  --}}
				<div id="comment_area">
				<?php foreach ($comments as $comment): ?>


					<div class="comment" data-id="<?php echo $comment->id ?>">
					    <a class="avatar">
					      <img src="images/avatars/<?php echo $comment->avatar ?>">
					    </a>
					    <div class="content">
					      <a class="author"><?php echo $comment->name ?></a>
					      <div class="metadata">
					        <span class="date"><?php echo $comment->created_at ?></span>
					      </div>
					      <div class="text">
					        <?php echo $comment->comment ?>
					      </div>
					    </div>
					  </div>
				<?php endforeach ?>
				</div>
				 
				  <form id='comment_form' class="ui reply form" method='post' action='/store_comment' enctype='multipart/form-data'>
				    <div class="field">
				      <textarea name='comment'></textarea>
				    </div>
				    <div id='submit' class="ui blue labeled submit icon button">
				      <i class="icon edit"></i> Add Reply
				    </div>
				  </form>
			</div>
		</section>
	</div>
	<script>
	$(document).ready(function() {

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

			};

		  })
		  
		  


		}, 5000);

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
				console.log(data)
				location.reload();
			})
			.fail(function() {
				console.log("error");
			})
			;
			


		});

		
		
		

	});

	</script>
@stop