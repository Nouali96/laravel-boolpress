<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ValidationPost;
use App\Tag;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::with("category")->get();
        return view("admin.posts.index", compact("posts"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view("admin.posts.create", compact("categories", "tags"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidationPost $request)
    {

        $data = $request->all();
        
        if(isset($data["image"])){
            $data["cover"] = Storage::put("posts_image", $data["image"]);   
        }

        $slug = Str::slug($data['title']);

        $counter = 1;
        while (Post::where('slug', $slug)->first()) {
            $slug = Str::slug($data['title']) . '-' . $counter;
            $counter++;
        }

        $data['slug'] = $slug;

        $post = new Post();
        $post->fill($data);
        $post->type = "posts";
        $post->save();
        
        if($request->tags == Null){
    
            $post->tags()->sync([]);
        }else{
 
            $post->tags()->sync($data["tags"]);
        }
        

        return redirect()->route('admin.posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {

        $now = Carbon::now();
        $dataCreatedAt = $post->created_at;
        $diff = $now->diff($dataCreatedAt);

        if($diff->d == 0){
            $diff = [
                "difference" => $diff->i,
                "unit" => "m"
            ];
        }else{
            $diff = [
                "difference" => $diff->d,
                "unit" => "d"
            ];
        }

        return view("admin.posts.show", compact("post", "diff"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view("admin.posts.edit", compact("post", "categories", "tags"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ValidationPost $request, Post $post)
    {

        $data = $request->all();

        if($post->cover){
            Storage::delete($post->cover);
        }

        if(isset($data["image"])){
            $data["cover"] = Storage::put("posts_image", $data["image"]); 

        }else{
            $data["cover"] = null;
        }

        $slug = Str::slug($data['title']);

        if($post->slug != $slug){ 
            $counter = 1;
            while (Post::where('slug', $slug)->first()) {
                $slug = Str::slug($data['title']) . '-' . $counter;
                $counter++;
            }    
            $data['slug'] = $slug;
        }

        $post->update($data);
        $post->save();

        if($request->tags == Null){
    
            $post->tags()->sync([]);
        }else{
    
            $post->tags()->sync($data["tags"]);
        }
    

        return redirect()->route("admin.posts.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if($post->cover){
            Storage::delete($post->cover);
        }

        $post->delete();

        return redirect()->route("admin.posts.index");
    }
}
