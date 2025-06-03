<?php

namespace App\Http\Controllers;

use App\Models\post;
use App\Http\Requests\StorepostRequest;
use App\Http\Requests\UpdatepostRequest;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller implements HasMiddleware

{   
    public static function middleware()
    {
        return[
            new Middleware("auth:sanctum",except:['index','show'])
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Post::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorepostRequest $request)
    {
        $validate = $request->validate([
            'title' => 'required|max:255',
            'body'=>'required'
        ]);

        // $post = Post::create($validate);
        $post = $request->user()->posts()->create($validate);
        
        return $post;
    }

    /**
     * Display the specified resource.
     */
    public function show(post $post)
    {
        return $post;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatepostRequest $request, post $post)
    {
        Gate::authorize("modify",$post);
        $validate = $request->validate([
            'title' => 'required|max:255',
            'body' => 'required'
        ]);

        $post->update($validate);
        return $post;
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(post $post)
    {   
        Gate::authorize("modify",$post);

        $post->delete();
        return ['message' => 'Post was Deleted!'];
    }
}
