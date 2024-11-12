<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGuestRequest;
use App\Http\Requests\UpdateGuestRequest;
use App\Models\Guest;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class GuestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $guests = Guest::all();
        return response()->json([
            'status' => 'success',
            'data' => $guests
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGuestRequest $request)
    {
        return response()->json([
            'status' => 'success',
            'created guest' => Guest::create($request->all())
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Guest $guest)
    {
        return response()->json([
            'status' => 'success',
            'selected data' => $guest,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGuestRequest $request, Guest $guest)
    {
        $guest->update($request->all());
        return response()->json([
            'status' => 'success',
            'updated data' => $guest,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Guest $guest)
    {
        $guest->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'guest removed'
        ]);
    }
}
