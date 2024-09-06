<?php
namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $request->validate([
            'content' => 'required|max:255',
        ]);

        Comment::create([
            'content' => $request->content,
            'post_id' => $post->id,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('posts.show', $post)->with('success', 'Comment added successfully.');
    }
    // Display the form to edit a comment
    public function edit(Comment $comment)
    {
        // Ensure the user can only edit their own comment
        if (Auth::id() !== $comment->user_id) {
            return redirect()->back()->with('error', 'You are not authorized to edit this comment.');
        }

        return view('comments.edit', compact('comment'));
    }

    // Update the comment
    public function update(Request $request, Comment $comment)
    {
        // Ensure the user can only update their own comment
        if (Auth::id() !== $comment->user_id) {
            return redirect()->back()->with('error', 'You are not authorized to update this comment.');
        }

        // Validate the request
        $request->validate([
            'content' => 'required|max:255',
        ]);

        // Update the comment
        $comment->update([
            'content' => $request->content,
        ]);

        return redirect()->route('posts.show', $comment->post_id)->with('success', 'Comment updated successfully.');
    }

    // Delete a comment
    public function destroy(Comment $comment)
    {
        // Ensure the user can only delete their own comment
        if (Auth::id() !== $comment->user_id) {
            return redirect()->back()->with('error', 'You are not authorized to delete this comment.');
        }

        $comment->delete();

        return redirect()->back()->with('success', 'Comment deleted successfully.');
    }
}
