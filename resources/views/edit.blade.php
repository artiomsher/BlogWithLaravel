@extends('layout')

@section('content')
	<div class="container">
    <div class="card w-80 mt-4">
        <div class="card-header">
        	Edit existing post!
        </div>
        <div class="card-body">
		<!-- Form -->
			<form method="POST" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data" id="myForm" action="{{action('PagesController@update', $post->id)}}">
				@method('PATCH')
				@csrf
				<div>
					<label for="title" class="mb-1">Title:</label>
					<input class="form-control mb-2"  type="text" placeholder="Title" name="title" required value="{{ $post->title}}">
					<label for="txtarea" class="mb-1">Message:</label>
					<textarea class="form-control z-depth-1 mb-2 is-danger" id="txtarea" name="content" rows="4" placeholder="What's new?" required>{{$post->content}}</textarea>
					<input hidden class="form-control" type="text" value="{{ Auth::user()->id }}" name="user_id">
					<div class="form-group">
        				<label for="document">Documents</label>
        				<div class="needsclick dropzone" id="document-dropzone">
        				</div>
    				</div>
					<div class="form-inline d-flex justify-content-end">
						<input type="submit" value="Edit!" class="btn btn-primary mt-4"> &nbsp;
							<a href="{{ redirect()->back()->getTargetUrl() }}" role="button"
							class="btn btn-outline-danger mt-4">Cancel</a>
					</div>
				</div>

			</form>
	    </div>
    </div>
  </div>
@endsection