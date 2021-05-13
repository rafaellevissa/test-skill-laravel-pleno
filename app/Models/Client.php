<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * Class Client
 *
 * @package App
 *
 * @OA\Schema(
 *     description="Client model",
 *     title="Client model",
 *     required={"display_name", "full_name", "email", "document", "document_type"},
 *     @OA\Xml(
 *         name="Client"
 *     )
 * )
 */
class Client extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $table = 'clients';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'display_name',
        'full_name',
        'email',
        'document',
        'document_type',
        'phone',
        'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password'
    ];

    public function product()
    {
        return $this->hasMany(Product::class);
    }
}
