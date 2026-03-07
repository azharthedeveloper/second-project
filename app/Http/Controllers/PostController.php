<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    // public function addData()
    // {
    //     $post = new Post();
    //     $post->title = "Post 11";
    //     $post->description = "Post 11, Post 11, Post 11, Post 11,Post 11, Post 11, Post 11, Post 11, Post 11";
    //     $post->save();

    //     dd("DATA ADDED");
    // }

    // public function getData()
    // {
    //     // $posts = Post::all();

    //     // $posts = Post::select('id', 'title')->get();

    //     // $posts = Post::where('id', 1)->first();

    //     $posts = Post::find(2);



    //     // return $posts;

    //     dd("GET DATA", $posts);
    // }

    // public function updateData()
    // {
    //     // $post = Post::where('id', 2)->first();
    //     // $post->title = "Post 2 Updated";
    //     // $post->description = "Post 2, Post 2, Post 2, Post 2,Post 2, Post 2, Post 2, Post 2, Post 2 Updated";
    //     // $post->update();

    //     $post = Post::find(1);
    //     $post->title = "Post 1 Updated";
    //     $post->description = "Post 1, Post 1, Post 1, Post 1,Post 1, Post 1, Post 1, Post 1, Post 1 Updated";
    //     $post->update();

    //     dd("UPDATED DATA", $post);
    // }

    // public function deleteData()
    // {

    //     // $post = Post::find(11);
    //     // $post->delete();
    //     // Agar record exists nahi krta hoga to error de dega upar wala code

    //     // $post = Post::findOrFail(11);
    //     // $post->delete();

    //     // $post = Post::findOrFail(10)->delete();

    //     Post::findOrFail(10)->delete();

    //     dd("DELETED DATA");
    // }

    // public function firstMethod(){
    //     $posts = Post::greaterthanfive()->get();
    //     dd("First Method", $posts);
    // }

    // public function secondMethod(){
    //     $posts = Post::greaterthanfive(1, 6)->get();
    //     dd("Second Method", $posts);
    // }

    public function index(Request $request)
    {
        // Without Filter
        // $posts = Post::all();

        //With Filter
        $posts = Post::when($request->search, function ($query) use ($request) {
            return $query->whereAny([
                'id',
                'title',
                'description',
                'status',
                'post_type',
                'views',
                'likes'
            ], 'like', '%' . $request->search . '%');
        })->paginate(10);


        return view('posts.index', compact('posts'));
    }

    public function create()
    {

        $types_drp = ['Article', 'News', 'Blog', 'Tutorial', 'Facebook', 'Instagram', 'TikTok', 'Thread', 'Twitter', 'Linkedin'];
        $status_drp = ['draft', 'published', 'archived'];
        return view('posts.create', compact('types_drp', 'status_drp'));
    }

    public function store(Request $request)
    {

        // dd($request->all());

        $request->validate(
            [
                'title' => ['required', 'string', 'min:3', 'max:255'],
                'description' => ['required', 'string', 'min:10'],
                'post_type' => ['required', 'string'],
                'status' => ['required', 'string', 'in:draft,published,archived'],
                'views' => ['required', 'integer', 'min:0'],
                'likes' => ['required', 'integer', 'min:0'],
                'image_path' => ['nullable', 'image', 'mimes:jpeg,png,webp,gif', 'max:2048'],
            ],
            [
                // ── Title ──────────────────────────────────────────────
                'title.required' => 'Post ka title zaroor likhein.',
                'title.string' => 'Title sirf text hona chahiye.',
                'title.min' => 'Title kam se kam 3 characters ka hona chahiye.',
                'title.max' => 'Title 255 characters se zyada nahi ho sakta.',

                // ── Description ────────────────────────────────────────
                'description.required' => 'Post ki description zaroor likhein.',
                'description.string' => 'Description sirf text hona chahiye.',
                'description.min' => 'Description kam se kam 10 characters ki honi chahiye.',

                // ── Post Type ──────────────────────────────────────────
                'post_type.required' => 'Post type select karna zaroor hai.',
                'post_type.string' => 'Post type ki value galat hai.',
                'post_type.in' => 'Post type sirf: Article, Tutorial, News, ya Review ho sakta hai.',

                // ── Status ─────────────────────────────────────────────
                'status.required' => 'Status select karna zaroor hai.',
                'status.string' => 'Status ki value galat hai.',
                'status.in' => 'Status sirf: draft, published, ya archived ho sakta hai.',

                // ── Views ──────────────────────────────────────────────
                'views.required' => 'Views ki value zaroor dikhein.',
                'views.integer' => 'Views sirf poori sankhya (number) honi chahiye.',
                'views.min' => 'Views 0 se kam nahi ho sakti.',

                // ── Likes ──────────────────────────────────────────────
                'likes.required' => 'Likes ki value zaroor dikhein.',
                'likes.integer' => 'Likes sirf poori sankhya (number) honi chahiye.',
                'likes.min' => 'Likes 0 se kam nahi ho sakti.',

                // ── Image ──────────────────────────────────────────────
                'image_path.image' => 'Sirf image file upload kar sakte hain.',
                'image_path.mimes' => 'Image format JPG, PNG, WEBP, ya GIF hona chahiye.',
                'image_path.max' => 'Image ka size 2MB se zyada nahi ho sakta.',
            ]
        );

        $image_path = null;
        if ($request->hasFile('image_path')) {
            $image_path = $request->file('image_path')->store('photos', 'public');
        }

        $post = new Post();
        $post->title = $request->title;
        $post->description = $request->description;
        $post->post_type = $request->post_type;
        $post->status = $request->status;
        $post->views = $request->views;
        $post->likes = $request->likes;
        $post->image_path = $image_path;
        $post->save();

        return redirect('posts');
    }

    public function edit($id)
    {

        $post = Post::findOrFail($id);

        $types_drp = ['Article', 'News', 'Blog', 'Tutorial', 'Facebook', 'Instagram', 'TikTok', 'Thread', 'Twitter', 'Linkedin'];
        $status_drp = ['draft', 'published', 'archived'];

        return view('posts.edit', compact('post', 'types_drp', 'status_drp'));
    }

    public function update(Request $request, $id)
    {


        $request->validate(
            [
                'title' => ['required', 'string', 'min:3', 'max:255'],
                'description' => ['required', 'string', 'min:10'],
                'post_type' => ['required', 'string'],
                'status' => ['required', 'string', 'in:draft,published,archived'],
                'views' => ['required', 'integer', 'min:0'],
                'likes' => ['required', 'integer', 'min:0'],
                'image_path' => ['nullable', 'image', 'mimes:jpeg,png,webp,gif', 'max:2048'],
            ],
            [
                // ── Title ──────────────────────────────────────────────
                'title.required' => 'Post ka title zaroor likhein.',
                'title.string' => 'Title sirf text hona chahiye.',
                'title.min' => 'Title kam se kam 3 characters ka hona chahiye.',
                'title.max' => 'Title 255 characters se zyada nahi ho sakta.',

                // ── Description ────────────────────────────────────────
                'description.required' => 'Post ki description zaroor likhein.',
                'description.string' => 'Description sirf text hona chahiye.',
                'description.min' => 'Description kam se kam 10 characters ki honi chahiye.',

                // ── Post Type ──────────────────────────────────────────
                'post_type.required' => 'Post type select karna zaroor hai.',
                'post_type.string' => 'Post type ki value galat hai.',
                'post_type.in' => 'Post type sirf: Article, Tutorial, News, ya Review ho sakta hai.',

                // ── Status ─────────────────────────────────────────────
                'status.required' => 'Status select karna zaroor hai.',
                'status.string' => 'Status ki value galat hai.',
                'status.in' => 'Status sirf: draft, published, ya archived ho sakta hai.',

                // ── Views ──────────────────────────────────────────────
                'views.required' => 'Views ki value zaroor dikhein.',
                'views.integer' => 'Views sirf poori sankhya (number) honi chahiye.',
                'views.min' => 'Views 0 se kam nahi ho sakti.',

                // ── Likes ──────────────────────────────────────────────
                'likes.required' => 'Likes ki value zaroor dikhein.',
                'likes.integer' => 'Likes sirf poori sankhya (number) honi chahiye.',
                'likes.min' => 'Likes 0 se kam nahi ho sakti.',

                // ── Image ──────────────────────────────────────────────
                'image_path.image' => 'Sirf image file upload kar sakte hain.',
                'image_path.mimes' => 'Image format JPG, PNG, WEBP, ya GIF hona chahiye.',
                'image_path.max' => 'Image ka size 2MB se zyada nahi ho sakta.',
            ]
        );

        

        $post = Post::findOrFail($id);

        $image_path = $post->image_path; // purani value rakho by default

        if ($request->hasFile('image_path')) {
            // purani image delete karo
            if ($post->image_path) {
                Storage::disk('public')->delete($post->image_path);
            }
            // nayi store karo
            $image_path = $request->file('image_path')->store('photos', 'public');
        }

        $post->title = $request->title;
        $post->description = $request->description;
        $post->post_type = $request->post_type;
        $post->status = $request->status;
        $post->views = $request->views;
        $post->likes = $request->likes;
        $post->image_path = $image_path;
        $post->update();

        return redirect('posts');
    }

    public function destroy(Request $request, $id)
    {
        $post = Post::findOrFail($id);

        if($post->image_path){
            Storage::disk('public')->delete($post->image_path);
        }

        $post->delete();

        return redirect('posts');
    }
}
