<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::with(["category"])->paginate(9);

        $posts->each(function($post){
            $this->getUrl($post);
        });

        return response()->json(
            [
                "results" => $posts,
                "success" => true
            ]
        );
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {

        $post = Post::where("slug", $slug)->with(["category", "tags"])->first();
        $similarPosts = Post::where([["category_id", $post->category->id],["id", "!=" ,$post->id]])->with(["category"])->limit(4)->get();

        $this->getUrl($post);

        $similarPosts->each(function($similarPost){
            $this->getUrl($similarPost);
        });
       
        if($post){

            $response = response()->json(
                [
                    "showPost" => $post,
                    "similarPosts" => $similarPosts,
                    "success" => true
                ]
            );

        }else{

            $response = response()->json(
                [
                    "results" => "Non ho trovato risultati",
                    "success" => false
                ]
            );

        }

        return $response;
    }

    private function getUrl($post){
        if ($post->cover) {
            $post->cover = url("storage/" . $post->cover);
        } else {
            $post->cover = url("img/fallback.jpg");
        }
    }

}
