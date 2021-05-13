<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Models\Product;

class ProductController extends Controller
{
    private $product;

    /**
     * Create a new instance of ProductController
     * 
     * @param App\Models\Product $product
     */
    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    /**
     * @OA\Get(
     *     path="/api/product",
     *     tags={"product"},
     *     summary="Fetch a listing of products registed",
     *     operationId="index",
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Product")
     *         )
     *     )
     * )
     */
    public function index()
    {
        $products = $this->product->all();

        return $products; 
    }

    /**
     * @OA\Get(
     *     path="/api/product/{id}",
     *     tags={"product"},
     *     summary="Fetch a product by its id",
     *     operationId="show",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="product id",
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
     *         description="Product not found"
     *     )
     * )
     */
    public function show($id)
    {
        $product = $this->product->findOrFail($id);

        return $product;
    }

    /**
     * @OA\Post(
     *     path="/api/product/{id}",
     *     tags={"product"},
     *     summary="Register a new product",
     *     operationId="store",
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="name",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="description",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="price",
     *                     type="float"
     *                 ),
     *                 @OA\Property(
     *                     property="sku",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="stock_amount",
     *                     type="integer"
     *                 ),
     *                 example={"name": "sapato", "description": "Sapato exclusivo da Linha Reserva pra Calçar!", "price": 299.50, "sku": "TSH-MED-WHI-COT", "stock_amount": 10}
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="successful operation"
     *     )
     * )
     */
    public function store(ProductStoreRequest $request)
    {
        $productData = $request->validated();

        auth()
            ->user()
            ->product()
            ->create($productData);

        return response(null, 201);
    }

    /**
     * @OA\Put(
     *     path="/api/product/{id}",
     *     tags={"product"},
     *     summary="Update a product by its id",
     *     operationId="update",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="product id",
     *         required=true,
     *         @OA\Schema(
     *             type="number"
     *         )
     *     ),
     *      @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="name",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="description",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="price",
     *                     type="float"
     *                 ),
     *                 @OA\Property(
     *                     property="sku",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="stock_amount",
     *                     type="integer"
     *                 ),
     *                 example={"name": "sapato", "description": "Sapato exclusivo da Linha Reserva pra Calçar!", "price": 299.50, "sku": "TSH-MED-WHI-COT", "stock_amount": 10}
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="successful operation"
     *     ),
     *      @OA\Response(
     *         response=404,
     *         description="Product not found"
     *     )
     * )
     */
    public function update($id, ProductUpdateRequest $request)
    {
        $data = $request->validated();

        $product = $this->product->findOrFail($id);

        $product->fill($data)->save();

        return response(null, 201);
    }

    /**
     * @OA\Delete(
     *     path="/api/product/{id}",
     *     tags={"product"},
     *     summary="Delete a product by its id",
     *     operationId="destroy",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="product id",
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
     *         description="Product not found"
     *     )
     * )
     */
    public function destroy($id)
    {
        $product = $this->product->findOrFail($id);

        $product->delete();

        return response(null, 201);
    }
}
