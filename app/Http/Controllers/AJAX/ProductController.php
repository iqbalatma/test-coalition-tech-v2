<?php

namespace App\Http\Controllers\AJAX;

use App\Http\Controllers\Controller;
use App\Http\Requests\Products\StoreProductRequest;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    private string $dataPath = "/data.json";

    // this should be placed to service class, but no time for this
    private function createFileIfDoesNotExists(): void
    {
        if (!Storage::disk("public")->exists($this->dataPath)) {
            Storage::disk("public")->put("data.json", "");
        }
    }

    private function createNewData(array $requestedData)
    {
        Storage::disk("public")->put($this->dataPath, json_encode(["products" => [$requestedData]]));
    }

    private function appendNewData(array &$storedData, array $requestedData)
    {
        $requestedData["id"] = $storedData["products"][count($storedData["products"]) - 1]["id"] + 1;
        array_push($storedData["products"], $requestedData);
        Storage::disk("public")->put($this->dataPath, json_encode($storedData));
    }
    public function store(StoreProductRequest $request): JsonResponse
    {
        $requestedData = $request->validated();
        $requestedData["date_time"] = Carbon::now()->format('Y-m-d H:i:s');
        $requestedData["id"] = 1;

        // check is file exists and create one
        $this->createFileIfDoesNotExists();

        // get data content
        $storedData = Storage::disk("public")->get($this->dataPath);
        $storedData = json_decode($storedData, true);


        // need to separate to micro function to make it modular
        if (isset($storedData["products"])) {
            if (count($storedData["products"]) == 0) {
                $this->createNewData($requestedData);
                // Storage::disk("public")->put($this->dataPath, json_encode(["products" => [$requestedData]]));
            } else {
                $this->appendNewData($storedData, $requestedData);
            }
        } else {
            $this->createNewData($requestedData);
        }

        return response()->json(["data" => $requestedData]);
    }
}
