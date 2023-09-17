<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:post-list|post-create|post-edit|post-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:post-list', ['only' => ['list']]);
        $this->middleware('permission:post-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:post-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:post-delete', ['only' => ['destroy']]);
        $this->middleware('permission:post-comment', ['only' => ['comment']]);
    }

    public function index(): View
    {
        $posts = Post::latest()->paginate(5);
        return view('posts.index', compact('posts'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function list(): View
    {
        $posts = Post::all();
        return view('home', compact('posts'));
    }

    public function create(): View
    {
        return view('posts.create');
    }

    public function store(Request $request): RedirectResponse
    {
        request()->validate([
            'title' => 'required',
            'content' => 'required',
            'image' => 'required|max:1048',
        ]);

        $filename = "";
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extention = $file->getClientOriginalExtension();
            $originalFilename = $file->getClientOriginalName();
            $filenameWithoutExtension = pathinfo($originalFilename, PATHINFO_FILENAME);
            $filename = $filenameWithoutExtension . '_' . Str::random(20) . '.' . $extention;
            $file->move('images/', $filename);
            $request->merge(['image' => $filename]);
        }

        //Post::create($request->all());

        $post = Post::create([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'image' => $request->input('image'),
            'userId' => auth()->id(),
        ]);

        if ($post->image) {
            $post->image = $filename;
            $post->save();
        }

        return redirect()->route('posts.index')
            ->with('success', 'post created successfully.');
    }

    public function comment(Post $post, Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'content' => ['required', 'string', 'between:2,255'],
        ]);

        Comment::create([
            'content' => $validated['content'],
            'postId' => $post->id,
            'userId' => Auth::id(),
        ]);

        return back()->withStatus('Commentaire publié !');
    }


    public function show(post $post): View
    {
        $userName = $post->users->userName;
        $comments = Comment::where('postId', $post->id)->get();
        $numComments = Comment::where('postId', $post->id)->count();
        return view('posts.show', compact('userName', 'post', 'comments', 'numComments'));
    }

    public function edit(post $post): View
    {
        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, post $post): RedirectResponse
    {
        request()->validate([
            'title' => 'required',
            'content' => 'required',
            'image' => 'max:1048',
        ]);

        $filename = "";
         $post = Post::find($post->id);
       
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extention = $file->getClientOriginalExtension();
            $originalFilename = $file->getClientOriginalName();
            $filenameWithoutExtension = pathinfo($originalFilename, PATHINFO_FILENAME);
            $filename = $filenameWithoutExtension . '_' . Str::random(20) . '.' . $extention;
            $file->move('images/', $filename);
            $request->merge(['image' => $filename]);
            File::delete(public_path('images/' . $post->image));
            $post->image = $filename;
        } else {
            $filename = $post->image;
        }

        $post->update($request->all());

        if ($post->image) {
            $post->image = $filename;
            $post->save();
        }

        return redirect()->route('posts.index')
            ->with('success', 'post updated successfully');
    }

    public function destroy(post $post): RedirectResponse
    {
        $post->delete();

        return redirect()->route('posts.index')
            ->with('success', 'post deleted successfully');
    }
}
