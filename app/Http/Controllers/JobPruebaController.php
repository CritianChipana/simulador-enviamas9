<?php

namespace App\Http\Controllers;

use App\Jobs\ProccessPersonalizado;
use Illuminate\Http\Request;

class JobPruebaController extends Controller
{
    public function JobPrueba () {

        ProccessPersonalizado::dispatch("cristian")->onQueue("ProccessPersonalizado");

        return "asas";
    }
}
