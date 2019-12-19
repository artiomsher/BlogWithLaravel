@extends ('layout')
@section ('content')
<head>
  <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
  <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
</head>
 <div class="container">
    <div class="col d-flex justify-content-center">
     <div class="card mt-3" style="width: 50rem;" >
       <div class="card-header">
        Recently added posts
        @can('create', App\Post::class)
        <a class="btn btn-outline-primary" href="{{action('PagesController@create')}}" style="float: right;" role="button">New post</a>
        @endcan
       </div>
       <div class="card-body" id="root">
       	@foreach($posts as $post)
       	  <div class="card mb-5">
                      <div class="card-header h-10 pl-1">
                        @can('update', $post)
                        <form method="POST" action="/posts/{{$post->id}}">
                        @method('DELETE')
                        @csrf
                        <button style="float: right;" class="btn btn-outline-danger mt-1" type="submit">Delete</button>
                        </form> &nbsp;
                        <a class="btn btn-outline-primary mt-1" href="/posts/{{$post->id}}/edit" style="float: right;" role="button">Edit</a>
                        @endcan
                          <div class="d-flex justify-content-between align-items-center">
                              <div class="d-flex justify-content-between align-items-center">
                                  <div class="ml-2">
                                      <div class="h5 m-0"> <i class='far fa-paper-plane mr-2'></i>{{$post->user->name}}</div>
                                  </div>                            
                              </div>
                          </div>
                      </div>
                      <div class="card-body">
                          <h5 class="card-title">{{$post->title}}</h5>
                          <p class="card-text">
                              {{$post->content}}
                          </p>
                      </div>
                      <div class="card-footer">
                         <div class="container" v-for="comment in comments" v-if="comment.post_id == {{$post->id}}">
                              <div class="card">
                                <div v-if="comment.user_id == {{ Auth::user()->id }}">
                                <a :href="'/posts/comments/' + comment.id + '/edit'" style="float: right;"> Edit comment</a>
                                </div>
                                <h6 class="ml-3 mb-1"> @{{ comment.username }}  </h6>
                                <p class="mb-1 ml-4"> @{{ comment.content }}  </p>
                              </div>
                            </div>
                          @auth
                          <a href="#comment{{$post->id}}" class="card-link" data-toggle="collapse"><i class="fa fa-comment"></i> Comment</a>
                          <div id="comment{{$post->id}}" class="collapse">
                                @csrf
                                <div>
                                  <textarea class="form-control" type="text" name="description{{$post->id}}" placeholder="Your comment here..." v-model="newCommentContent" id="txtarea{{$post->id}}">
                                  </textarea>
                                  <input hidden class="form-control" type="text" value="{{ Auth::user()->id }}" name="user_id">
                                  <div class="form-inline d-flex justify-content-end">
                                    <button id="update" @click="createComment({{$post}})">Create</button>
                                  </div>
                                </div>
                          </div>
                          @endauth
                      </div>
          </div>
       	@endforeach
        </div>
     </div>
   </div>
 </div>
<script>
   var app = new Vue({
            el: '#root',
            data: {
                comments: [],
                newCommentContent: '',
            },
            
            mounted() {
                axios.get("{{ route ('api.comments.index')}}")
                .then(response => {
                    this.comments = response.data;
                    console.log(this.comments);
                })
                .catch(response=> {
                    console.log(response);

                })
            },
            methods: {
                createComment: function(post) {
                    axios.post("{{ route('api.comments.store') }}", {
                        content: this.newCommentContent,
                        user_id: {{ Auth::user()->id }},
                        post_id: post.id,
                    })
                    .then(response=> {
                        console.log(this.comments);
                        this.comments.push(response.data);
                        this.newCommentContent = '';

                    })
                    .catch(response=> {
                        console.log(response);
                    })
                }
            },
        })
 </script>
@endsection

 