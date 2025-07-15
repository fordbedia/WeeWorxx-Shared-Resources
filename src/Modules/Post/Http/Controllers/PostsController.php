<?php

namespace WeeWorxxSDK\SharedResources\Modules\Post\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use WeeWorxxSDK\SharedResources\Modules\Post\Models\Post;

class PostsController extends Controller
{
    protected array $relationships = [
        'company',
        'postedBy',
        'status',
        'skills',
        'benefits'
    ];
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Post::with($this->relationships)->paginate(10);
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
        return Post::where('permalink', $id)
            ->with($this->relationships)
            ->first();
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
