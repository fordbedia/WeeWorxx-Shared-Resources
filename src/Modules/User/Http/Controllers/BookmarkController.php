<?php

namespace WeeWorxxSDK\SharedResources\Modules\User\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use WeeWorxxSDK\SharedResources\Modules\Post\Models\Post;
use WeeWorxxSDK\SharedResources\Modules\Post\Models\UserPostBookmark;
use WeeWorxxSDK\SharedResources\Modules\User\Traits\PostRelation;

class BookmarkController extends Controller
{
	use PostRelation;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
			$userHasPost = $request->user()->bookmarks()->where('post_id', $request->post_id)->exists();
			if ($userHasPost) {
				$request->user()->bookmarks()->detach([$request->post_id]);
			} else {
				$request->user()->bookmarks()->attach([$request->post_id]);
			}

			return response()->json([
				'post_id' => $request->post_id,
				'user_id' => $request->user()->id,
				'bookmarked' => !$userHasPost,
				'post' => Post::find($request->post_id)->loadMissing($this->postRelation)
			]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
