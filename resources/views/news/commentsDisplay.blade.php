@foreach ($comments as $comment)
    <div class="display-comment" @if ($comment->parent_id != null) style="margin-left:40px;" @endif>
        <strong>{{ $comment->user->name }}</strong>
        <p>{{ $comment->body }}</p>
@if(Auth::user())
        @if (Auth::user()->id == $comment->user_id)
            <form action="{{ route('comments.destroy', $comment) }}" method="POST" class="float-right">
                @csrf
                {{ method_field('DELETE') }}
                <button type="submit" class="btn btn-danger"> Delete comment
                </button>
            </form>
        @else
            @can('delete-users')
                <form action="{{ route('comments.destroy', $comment) }}" method="POST" class="float-right">
                    @csrf
                    {{ method_field('DELETE') }}
                    <button type="submit" class="btn btn-danger"> Delete comment
                    </button>
                </form>
            @endcan
        @endif
@endif

        <a href="" id="reply"></a>
        <form method="post" action="{{ route('comments.store') }}">
            @csrf
            <div class="form-group">
                <input type="text" name="body" class="form-control" />
                <input type="hidden" name="news_id" value="{{ $news_id }}" />
                <input type="hidden" name="parent_id" value="{{ $comment->id }}" />
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-warning" value="Reply" />
            </div>
        </form>
        @include('news.commentsDisplay', ['comments' => $comment->replies])

    </div>
@endforeach
