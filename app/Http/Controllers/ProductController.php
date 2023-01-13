<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(): Response
    {
        $data = Storage::disk("public")->get("data.json");
        $data = json_decode($data);
        return response()->view("index", ["products" => $data->products ?? []]);
    }
}
