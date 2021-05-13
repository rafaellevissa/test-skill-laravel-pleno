<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Client;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/register",
     *     tags={"Register"},
     *     summary="Register a new user",
     *     operationId="register",
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="display_name",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="full_name",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="email",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="password",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="document",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="document_type",
     *                     type="string"
     *                 ),
     *                  @OA\Property(
     *                     property="phone",
     *                     type="string"
     *                 ),
     *                 example={"name": "Jessica", "full_name": "Smith", "email": "jessica@email.com", "password": "123", "document": "864.997.710-31", "document_type": "cpf"}
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="successful operation",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Client")
     *         )
     *     )
     * )
     */
    public function register(Request $request)
    {
        $user = Client::create([
            'display_name' => $request->display_name,
            'full_name' => $request->full_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'document' => $request->document,
            'document_type' => $request->document_type,
            'phone' => $request->phone
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response(['token' => $token], 201);
    }

    /**
     * @OA\Post(
     *     path="/api/login",
     *     tags={"Login"},
     *     summary="create a token to have access to the resources",
     *     operationId="login",
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="email",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="password",
     *                     type="string"
     *                 ),
     *                 example={"email": "jessica@email.com", "password": "123"}
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Client")
     *         )
     *     )
     * )
     */
    public function login(Request $request)
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){ 
            $user = Auth::user(); 
            $success['token'] =  $user->createToken('auth_token')->plainTextToken; 
            $success['name'] =  $user->display_name;
   
            return response($success, 200);
        } 
        else{ 
            return response(['error'=>'Unauthorised'], 403);
        } 
    }
}
