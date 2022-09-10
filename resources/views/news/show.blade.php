@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Pregled vijesti - {{ $news->title }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif


                    <p class="text-justify">{{ $news->content}} </p>

                    <div class="row">
                        <div class="span2">
                          <a href="#" class="thumbnail">
                          </a>
                        </div>
                        <div class="span6">      
    
                        </div>
                      </div>
                      <div class="row">
                        <div class="span8">
                          <p>
                            <i class="icon-user"></i> by <a href="#">{{ $user->name }}</a> 
                            | <i class="icon-calendar"></i>{{ \Carbon\Carbon::parse($news->created_at)->isoFormat('MMM Do YYYY')}}
                            | <i class="icon-comment"></i> <a href="#">{{ $comments_count }} Comments</a>
                          </p>
                        </div>
                      </div>
                    </div>

                    <h4>Display Comments</h4>
  
                    @include('news.commentsDisplay', ['comments' => $news->comments, 'news_id' => $news->id])
                    <hr />


                    <h4>Add comment</h4>
                    <form method="post" action="{{ route('comments.store') }}">
                        @csrf
                        <div class="form-group">
                            <textarea class="form-control" name="body"></textarea>
                            <input type="hidden" name="news_id" value="{{ $news->id }}" />
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-success" value="Add Comment" />
                        </div>
                    </form>
                  </div>
                  
                </div>
            </div>
        </div>

    </div>
@endsection
