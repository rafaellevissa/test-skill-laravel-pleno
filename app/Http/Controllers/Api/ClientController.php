<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClientUpdateRequest;
use App\Models\Client;

/**
 * Class ClientController
 *
 * @package App\controllers\Api
 *
 */
class ClientController extends Controller
{
    private $client;

    /**
     * Create a new instance of ClientController
     * 
     * @param App\Models\Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;   
    }

    /**
     * @OA\Get(
     *     path="/api/client",
     *     tags={"client"},
     *     summary="Fetch a listing of clients registed",
     *     operationId="index",
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
    public function index()
    {
        $clients = $this->client->all();

        return response($clients, 200);
    }

    /**
     * @OA\Get(
     *     path="/api/client/{id}",
     *     tags={"client"},
     *     summary="Fetch a client by its id",
     *     operationId="show",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="client id",
     *         required=true,
     *         @OA\Schema(
     *             type="number"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\JsonContent(
     *             type="object",
     *         )
     *     ),
     *      @OA\Response(
     *         response=404,
     *         description="Client not found"
     *     )
     * )
     */
    public function show($id)
    {
        $client = $this->client->findOrFail($id);

        return response($client, 200);
    }

    /**
     * @OA\Put(
     *     path="/api/client/{id}",
     *     tags={"client"},
     *     summary="Update a client by its id",
     *     operationId="update",
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
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="client id",
     *         required=true,
     *         @OA\Schema(
     *             type="number"
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="successful operation"
     *     ),
     *      @OA\Response(
     *         response=404,
     *         description="Client not found"
     *     )
     * )
     */
    public function update(ClientUpdateRequest $request, $id)
    {
        $data = $request->validated();

        $client = $this->client->findOrFail($id);

        $client->fill($data)->save();

        return response(null, 201);
    }

    /**
     * @OA\Delete(
     *     path="/api/client/{id}",
     *     tags={"client"},
     *     summary="Delete a client by its id",
     *     operationId="destroy",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="client id",
     *         required=true,
     *         @OA\Schema(
     *             type="number"
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="successful operation"
     *     ),
     *      @OA\Response(
     *         response=404,
     *         description="Client not found"
     *     )
     * )
     */
    public function destroy($id)
    {
        $client = $this->client->findOrFail($id);

        $client->delete();

        return response(null, 201);
    }
}
