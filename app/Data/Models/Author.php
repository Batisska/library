<?php

namespace App\Data\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static orderBy(mixed $param, mixed $param1)
 * @method static create(array $input)
 * @method static count()
 * @property string $first_name
 * @property string $last_name
 */
class Author extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * @var string[]
     */
    protected $fillable = [
        'first_name',
        'last_name',
    ];
}
