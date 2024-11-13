<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGuestRequest;
use App\Http\Requests\UpdateGuestRequest;
use App\Http\Resources\V1\GuestResource;
use App\Models\Guest;
use Illuminate\Http\JsonResponse;
use libphonenumber\NumberParseException;
use libphonenumber\PhoneNumberUtil;

class GuestController extends Controller
{
    /**
     * Display a listing of the resource with paginate.
     */
    public function index(): JsonResponse
    {
        $guests = Guest::paginate(5);

        return response()->json([
            'status' => 'success',
            'data' => GuestResource::collection($guests),
            'links' => [
                'previous_page' => $guests->previousPageUrl(),
                'next_page' => $guests->nextPageUrl()
            ],
            'meta' => [
                'current_page' => $guests->currentPage(),
                'per_page' => $guests->perPage(),
                'total' => $guests->total(),
                'from' => $guests->firstItem(),
                'to' => $guests->lastItem(),
            ]
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGuestRequest $request): JsonResponse
    {
        $country = $request->input('country') ?? '';
        if ($country === '') {
            $country = $this->getCountryCode($request->input('phone_number'));
        }

        $guest = Guest::create(
            array_merge(
                $request->all(),
                ['country' => $country]
            )
        );

        return response()->json([
            'status' => 'success',
            'created_guest' => new GuestResource($guest)
        ]);
    }

    /**
     * This method returns code of country.
     *
     * @param $phoneNumber
     * @return array|string|null
     */
    private function getCountryCode($phoneNumber): array|string|null
    {
        try {
            $phoneUtil = PhoneNumberUtil::getInstance();
            $parsedNumber = $phoneUtil->parse($phoneNumber, 'None');
            return $phoneUtil->getRegionCodeForNumber($parsedNumber);
        } catch (NumberParseException $e) {
            return [
                'status' => false,
                'message' => 'Invalid phone number'
            ];
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Guest $guest): JsonResponse
    {
        return response()->json([
            'status' => 'success',
            'selected_guest' => new GuestResource($guest),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGuestRequest $request, Guest $guest): JsonResponse
    {
        $guest->update($request->all());
        return response()->json([
            'status' => 'success',
            'updated_guest' => new GuestResource($guest),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Guest $guest): JsonResponse
    {
        $guest->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'guest removed'
        ]);
    }
}
