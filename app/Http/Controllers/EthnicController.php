<?php

namespace App\Http\Controllers;

use App\Ethnic;
use Illuminate\Http\Request;

class EthnicController extends Controller
{
    public function getAll()
    {
        $etnias = Ethnic::all();
        return $etnias;
    }
}
