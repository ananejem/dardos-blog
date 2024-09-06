@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $post->title }}</h1>
    <p>{{ $post->content }}</p>

    <hr>

    <h3>Comments</h3>
    @foreach ($post->comments as $comment)
        <div class="comment">
            <strong>{{ $comment->user->name }}:</strong>
            <p>{{ $comment->content }}</p>

            {{-- Show edit and delete buttons only if the comment belongs to the current user --}}
            @if (Auth::check() && Auth::user()->id === $comment->user_id)
                <div class="comment-actions">
                    {{-- Edit Comment Link --}}
                    <a href="{{ route('comments.edit', $comment->id) }}" class="btn btn-sm btn-warning">Edit</a>

                    {{-- Delete Comment Form --}}
                    <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this comment?')">Delete</button>
                    </form>
                </div>
            @endif
        </div>
        <hr>
    @endforeach

    {{-- Comment form --}}
    @auth
        <h4>Add a Comment</h4>
        <form action="{{ route('comments.store', $post->id) }}" method="POST">
            @csrf
            <div class="form-group">
                <textarea name="content" class="form-control" rows="3" placeholder="Write your comment here..." required></textarea>
            </div>
            <button type="submit" class="btn btn-primary mt-2">Submit</button>
        </form>
    @else
        <p>Please <a href="{{ route('login') }}">login</a> to comment.</p>
    @endauth
</div>
@endsection
