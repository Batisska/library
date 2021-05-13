<?php


namespace App\Data\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\PersonalAccessToken as Model;

class PersonalAccessToken extends Model
{
    use HasFactory;
}
