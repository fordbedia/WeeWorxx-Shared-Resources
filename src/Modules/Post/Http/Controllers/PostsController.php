<?php

namespace WeeWorxxSDK\SharedResources\Modules\Post\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;
use WeeWorxxSDK\SharedResources\Modules\Post\Models\Post;

class PostsController extends Controller
{
    protected array $relationships = [
        'postedBy',
        'status',
        'skills',
        'benefits',
        'bookmarks'
    ];
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Post::active()->with($this->relationships)->paginate(10);
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
     * @throws HttpException
     */
    public function show(string $id)
    {
        $post = Post::where('permalink', $id)
            ->with($this->relationships)
            ->first();

        if (! $post) {
            throw new HttpException(404, 'Post Not Found.');
        }

        return $post;
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
