<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\BlogResource;

class BlogController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum')->only(
            ['store', 'update', 'currentuserblog', 'destroy', 'followedblogs']
        );
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = Blog::with('user')->get();
        return $blogs;
    }

    public function userblog(Request $request, int $userid)
    {
        $blogs = Blog::where('user_id', $userid)->with('user')->get();
        return $blogs;
    }

    public function currentuserblog(Request $request)
    {
        $blogs = Blog::where('user_id', $request->user()->id)->with('user')->get();
        return $blogs;
    }

    public function followedblogs(Request $request)
    {
        $user = $request->user();
        $followedUserIds = $user->following()->pluck('followed_id');
        $blogs = Blog::whereIn('user_id', $followedUserIds)->with('user')->get();
        return $blogs;
    }


    public function search(Request $request)
    {
        $pattern = $request->pattern;
        $type = $request->type;
        if ($type == 'regex') {
            $blogs = Blog::whereRaw('title REGEXP ? OR text REGEXP ?', [$pattern, $pattern])->with('user')->get();
        } else {
            $blogs = Blog::whereRaw('title LIKE ? OR text LIKE ?', ["%$pattern%", "%$pattern%"])->with('user')->get();
        }
        return $blogs;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $fullreq = ['text' => $request->text, 'title' => $request->title, 'user_id' => $request->user()->id, 'date' => date('Y-m-d')];
        // $fullreq = ['text' => $request->text, 'title' => $request->title, 'user_id' => '1', 'date' => date('Y-m-d')];
        Blog::create($fullreq);
        return $request;   
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        error_log("blog no $blog");
        // $blogs = Blog::where('id', $blog)->with('user')->get();
        return $blog->load('user');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Blog $blog)
    {
        $fullreq = ['text' => $request->text, 'title' => $request->title, 'date' => date('Y-m-d')];
        $blog->update($fullreq);
        // Blog::create($fullreq);
        // return $request;   
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        $blog->delete();
    }
}
