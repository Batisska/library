<?php

namespace App\Http\Controllers;

use App\Features\TakeBookFeature;
use Lucid\Units\Controller;

/**
 * Class TakeBookController
 * @package App\Http\Controllers
 */
class TakeBookController extends Controller
{
    /**
     * @return mixed
     */
    public function store(): mixed
    {
        return $this->serve(TakeBookFeature::class);
    }
}
