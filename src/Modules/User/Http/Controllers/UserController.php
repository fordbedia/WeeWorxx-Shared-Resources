<?php

namespace WeeWorxxSDK\SharedResources\Modules\User\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;
use WeeWorxxSDK\SharedResources\Modules\User\OAuth\OAuthContract;
use WeeWorxxSDK\SharedResources\Modules\User\Repositories\Contracts\UserRepositoryInterface;

class UserController extends Controller
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
    public function store(Request $request, UserRepositoryInterface $repository)
    {
        try {
            $repository->create($request->all());
        } catch (\Throwable $exception) {
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage()
            ]);
        }

        return response()->json([
            'success' => true,
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

    public function authenticate(OAuthContract $auth)
    {
        try {
            return $auth->createToken();
        } catch (\Throwable $e) {
            throw new HttpException(500, 'Cannot login, please check your email and password.');
        }
    }
}
