<?php

namespace WeeWorxxSDK\SharedResources\Modules\User\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
            $repository->create(array_merge($request->all(), ['auth_type' => 'app']));
        } catch (\Throwable $exception) {
            return throw new HttpException($exception->getCode(), $exception->getMessage());
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

    public function verifyByToken(Request $request)
    {
        return $request->user();
    }
}
