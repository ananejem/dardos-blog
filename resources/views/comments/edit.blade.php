@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Comment</h1>

    {{-- Display validation errors --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Edit comment form --}}
    <form action="{{ route('comments.update', $comment->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <textarea name="content" class="form-control" rows="3" required>{{ old('content', $comment->content) }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Update Comment</button>
    </form>
</div>
@endsection
