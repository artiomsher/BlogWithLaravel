@extends ('layout')

@section ('content')
  <div class="container">
    <div class="card w-80 mt-4">
        <div class="card-header">
        	New post creation!
        </div>
        <div class="card-body">
		<!-- Form -->
			<form method="POST" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data" id="myForm" action="{{action('PagesController@store')}}">
				{{ csrf_field() }}
				<div>
					<label for="title" class="mb-1">Title:</label>
					<input class="form-control mb-2"  type="text" placeholder="Title" name="title" required>
					<label for="txtarea" class="mb-1">Message:</label>
					<textarea class="form-control z-depth-1 mb-2 is-danger" id="txtarea" name="content" rows="4" placeholder="What's new?" required></textarea>
					<input hidden class="form-control" type="text" value="{{ Auth::user()->id }}" name="user_id">
					<div class="form-group">
        				<label for="document">Documents</label>
        				<div class="needsclick dropzone" id="document-dropzone">
        				</div>
    				</div>
					<div class="form-inline d-flex justify-content-end">
						<input type="submit" value="Create!" class="btn btn-primary mt-4">&nbsp;
							<a href="{{ redirect()->back()->getTargetUrl() }}" role="button"
							class="btn btn-outline-danger mt-4">Cancel</a>
					</div>
				</div>

			</form>
	    </div>
    </div>
  </div>
<script>
  var uploadedDocumentMap = {}
  Dropzone.options.documentDropzone = {
    maxFilesize: 2, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="document[]" value="' + response.name + '">')
      uploadedDocumentMap[file.name] = response.name
    },
    removedfile: function (file) {
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedDocumentMap[file.name]
      }
      $('form').find('input[name="document[]"][value="' + name + '"]').remove()
    },
    init: function () {
      @if(isset($project) && $project->document)
        var files =
          {!! json_encode($project->document) !!}
        for (var i in files) {
          var file = files[i]
          this.options.addedfile.call(this, file)
          file.previewElement.classList.add('dz-complete')
          $('form').append('<input type="hidden" name="document[]" value="' + file.file_name + '">')
        }
      @endif
    }
  }
</script>
@endsection