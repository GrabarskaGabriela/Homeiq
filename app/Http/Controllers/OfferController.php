<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Models\Property;
use App\Models\Offer;
use App\Models\OfferPicture;

class OfferController extends Controller
{
    public function store(Request $request)
    {
        // Validate the incoming request
        $validator = Validator::make($request->all(), [
            // Property validation
            'country' => 'required|string|max:50',
            'region' => 'required|string|max:50',
            'town' => 'required|string|max:50',
            'postal_code' => 'required|string|max:10|regex:/^\d{2}-\d{3}$/',
            'street' => 'required|string|max:50',
            'building_number' => 'required|string|max:10',
            'apartment_number' => 'nullable|integer|min:1',
            'type' => 'required|in:Dom,Mieszkanie,Lokal użytkowy',
            'surface' => 'required|numeric|min:0.01|max:9999.99',
            'number_of_rooms' => 'required|integer|min:1|max:10',
            'floor' => 'required|integer',
            'technical_condition' => 'required|in:Do remontu,Do kapitalnego remontu,Budynek w stanie surowym,Gotowy do zamieszkania',
            'furnishings' => 'required|in:Nieumeblowane,Częściowo umeblowane,W pełni umeblowane',

            // Offer validation
            'offer_title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|integer|min:0',
            'rent' => 'nullable|integer|min:0',
            'deposit' => 'nullable|integer|min:0',

            // Images validation
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:5120', // 5MB max per image
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Błąd walidacji danych',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            DB::beginTransaction();

            // Create property record
            $property = Property::create([
                'country' => $request->country,
                'region' => $request->region,
                'town' => $request->town,
                'postal_code' => $request->postal_code,
                'street' => $request->street,
                'building_number' => $request->building_number,
                'apartment_number' => $request->apartment_number,
                'type' => $request->type,
                'surface' => $request->surface,
                'number_of_rooms' => $request->number_of_rooms,
                'floor' => $request->floor,
                'technical_condition' => $request->technical_condition,
                'furnishings' => $request->furnishings,
            ]);

            // Create offer record
            $offer = Offer::create([
                'owner_id' => auth()->id(), // Assuming user is authenticated
                'property_id' => $property->id,
                'offer_title' => $request->offer_title,
                'description' => $request->description,
                'price' => $request->price,
                'rent' => $request->rent ?? 0,
                'deposit' => $request->deposit ?? 0,
            ]);

            // Handle image uploads
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    // Generate unique filename
                    $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();

                    // Store image in storage/app/public/offer_images/
                    $path = $image->storeAs('offer_images', $filename, 'public');

                    // Save image path to database
                    OfferPicture::create([
                        'offer_id' => $offer->id,
                        'path' => $path,
                    ]);
                }
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Oferta została pomyślnie dodana!',
                'data' => [
                    'offer_id' => $offer->id,
                    'property_id' => $property->id,
                ]
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Wystąpił błąd podczas dodawania oferty',
                'error' => config('app.debug') ? $e->getMessage() : 'Internal server error'
            ], 500);
        }
    }

    public function create()
    {
        // Return the form view
        return view('offers.create');
    }

    public function show($id)
    {
        try {
            $offer = Offer::with(['property', 'pictures', 'owner'])->findOrFail($id);

            return response()->json([
                'success' => true,
                'data' => $offer
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Nie znaleziono oferty'
            ], 404);
        }
    }

    public function index(Request $request)
    {
        $query = Offer::with(['property', 'pictures']);

        // Add filters if provided
        if ($request->has('type')) {
            $query->whereHas('property', function($q) use ($request) {
                $q->where('type', $request->type);
            });
        }

        if ($request->has('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }

        if ($request->has('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        if ($request->has('town')) {
            $query->whereHas('property', function($q) use ($request) {
                $q->where('town', 'like', '%' . $request->town . '%');
            });
        }

        if ($request->has('rooms')) {
            $query->whereHas('property', function($q) use ($request) {
                $q->where('number_of_rooms', $request->rooms);
            });
        }

        $offers = $query->orderBy('created_at', 'desc')->paginate(12);

        return response()->json([
            'success' => true,
            'data' => $offers
        ]);
    }
    public function myOffers()
    {
        $offers = Offer::where('owner_id', auth()->id())
            ->with(['property', 'pictures'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('offers.my-offers', compact('offers'));
    }
}
