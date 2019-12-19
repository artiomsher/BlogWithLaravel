@extends('layout')

@section('content')
	<div class="container">
    <div class="card w-80 mt-4">
        <div class="card-header">
        	<form method="POST" action="{{action('CommentsController@destroy', $comment->id)}}">
                        @method('DELETE')
                        @csrf
                        <button style="float: right;" class="btn btn-outline-danger mt-1" type="submit">Delete comment</button>
            </form>
        	Edit existing comment!
        </div>
        <div class="card-body">
		<!-- Form -->
			<form method="POST" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data" id="myForm" action="{{action('CommentsController@update', $comment->id)}}">
				@method('PATCH')
				@csrf
				<div>
					<label for="txtarea" class="mb-1">Message:</label>
					<textarea class="form-control z-depth-1 mb-2 is-danger" id="txtarea" name="content" rows="4" placeholder="What's new?" required>{{$comment->content}}</textarea>
					<input hidden class="form-control" type="text" value="{{ Auth::user()->id }}" name="user_id">
					<div class="form-inline d-flex justify-content-end">
						<input type="submit" value="Edit comment!" class="btn btn-primary mt-4"> &nbsp;
							<a href="{{ redirect()->back()->getTargetUrl() }}" role="button"
							class="btn btn-outline-danger mt-4">Cancel</a>
					</div>
				</div>

			</form>
	    </div>
    </div>
  </div>
@endsection