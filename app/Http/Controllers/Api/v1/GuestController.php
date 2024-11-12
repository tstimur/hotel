<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGuestRequest;
use App\Http\Requests\UpdateGuestRequest;
use App\Http\Resources\V1\GuestResource;
use App\Models\Guest;

class GuestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'status' => 'success',
            'data' => GuestResource::collection(Guest::all())
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGuestRequest $request): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'status' => 'success',
            'created guest' => new GuestResource(Guest::create($request->all()))
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Guest $guest): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'status' => 'success',
            'selected data' => new GuestResource($guest),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGuestRequest $request, Guest $guest): \Illuminate\Http\JsonResponse
    {
        $guest->update($request->all());
        return response()->json([
            'status' => 'success',
            'updated data' => new GuestResource($guest),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Guest $guest): \Illuminate\Http\JsonResponse
    {
        $guest->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'guest removed'
        ]);
    }
}
