<?php

namespace WeeWorxxSDK\SharedResources\Modules\Post\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use WeeWorxxSDK\SharedResources\Modules\Post\Models\Post;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Post::with([
            'company',
            'postedBy',
            'status',
            'pay',
            'skills',
            'benefits'
        ])->paginate(10);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        dd('sdfsdf');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
