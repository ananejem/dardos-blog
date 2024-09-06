@extends('layouts.app')

@section('content')
<div class="container">
    <h1>All Blog Posts</h1>
    {{-- Check if the logged-in user is an admin --}}
    @if (Auth::check() && Auth::user()->type === "admin")
    <span class="nav-item">
        <a href="{{ route('posts.create') }}" class="btn btn-primary active">Add Post</a>
    </span>
    @endif
    @foreach ($posts as $post)
    <div class="post">
        <h2>{{ $post->title }}</h2>
        <p>{{ \Illuminate\Support\Str::limit($post->content, 150, '...') }}</p>
        <a href="{{ route('posts.show', $post->id) }}">Read More</a>
    </div>
    @endforeach

    {{-- Pagination links (if using pagination) --}}
    {{ $posts->links() }}
</div>
@endsection
