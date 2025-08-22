<?php

namespace WeeWorxxSDK\SharedResources\Modules\User\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use WeeWorxxSDK\SharedResources\Modules\User\Repositories\Contracts\UserPostRepositoryInterface;
use WeeWorxxSDK\SharedResources\Modules\User\Services\Contracts\PostServicesInterface;

class UserPostController extends Controller
{
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
    public function store(
        Request $request,
        PostServicesInterface $postServices
    ) {
			$postServices->create($request->all());

			return response()->json([
				'message' => 'success',
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
