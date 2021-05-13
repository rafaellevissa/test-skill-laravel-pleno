<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Product
 *
 * @package App
 *
 * @OA\Schema(
 *     description="Product model",
 *     title="Product model",
 *     required={"name", "description", "price", "sku", "client_id"},
 *     @OA\Xml(
 *         name="Product"
 *     )
 * )
 */
class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'sku',
        'client_id',
        'stock_amount'
    ];
}
