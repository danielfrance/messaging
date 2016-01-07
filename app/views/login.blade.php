@extends('layout')


@section('content')
	<section class="login">
		<div class="ui grid">
			<div class="twelve wide column">
			</div>
			<div class="four wide column">
				<?php 
				$response = Session::get('response');
					
	if (!is_null($response)) {
		// dd($response);
	
		echo "<div class='ui green message'>" . $response . "</div>";
		
		Session::forget('response');
	}

				 ?>
					<form action="/login" class='ui center form' method='post' enctype='multipart/form-data'>
					<input type="text" name='name' placeholder='hi!'>
					<br><br>
					<input type="password" name='password' placeholder='password'>
					<br><br>
					<input type="submit" value='Lets Chat!' class='ui blue button'>
				</form>
			</div>
		</div>
	</section>

@stop