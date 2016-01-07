<?php

class CommentsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		
		$comments = DB::table('comments')
					->join('users', 'users.id', '=', 'comments.user_id')
					->select('users.name', 'users.avatar', 'comments.user_id', 'comments.comment','comments.created_at', 'comments.id')
					->orderBy('comments.created_at')
					->get();
		;


		// dd($comments);
		// die();

		return View::make('messages')->with('comments',$comments);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{

		$input = Input::all();

		$id = Auth::id();

		// dd($id);

		try {

			$validator = Validator::make(
				$input,
				array(
					'comment' => 'required'
					)
				);

			if ($validator->fails()) {
				
				$response['message'] = $validator->messages();
				// dd($response['message']);
				return Redirect::back()->withResponse($response['message']);

				$response = false;

			}

			else{

				$comment = new Comments;

				$comment->user_id = $id;
				$comment->comment = $input['comment'];

				$comment->save();

				$response = true;

			}
			
		} catch (Exception $e) {
			$response['message'] = $e->getMessage();
		}

		return Response::json($response);
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show()
	{
		$comments = DB::table('comments')
					->join('users', 'users.id', '=', 'comments.user_id')
					->select('users.name', 'users.avatar', 'comments.user_id', 'comments.comment','comments.created_at', 'comments.id')
					->orderBy('comments.created_at', 'desc')
					->first();
					
		;



		return Response::json($comments);
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
