<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Property;
use App\Models\Offer;
use App\Models\OfferPicture;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PropertyController extends Controller
{
    public function create()
    {
        return view('properties.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            // Walidacja danych nieruchomości
            'country' => 'required|string|max:50',
            'region' => 'required|string|max:50',
            'town' => 'required|string|max:50',
            'postal_code' => 'required|string|max:10',
            'street' => 'required|string|max:50',
            'building_number' => 'required|string|max:10',
            'apartment_number' => 'nullable|integer',
            'type' => 'required|in:Dom,Mieszkanie,Lokal użytkowy',
            'surface' => 'required|numeric|min:0|max:9999.99',
            'number_of_rooms' => 'required|integer|min:1',
            'floor' => 'required|integer',
            'technical_condition' => 'required|in:Do remontu,Do kapitalnego remontu,Budynek w stanie surowym,Gotowy do zamieszkania',
            'furnishings' => 'required|in:Nieumeblowane,Częściowo umeblowane,W pełni umeblowane',

            // Walidacja danych oferty
            'offer_title' => 'required|string|max:255',
            'description' => 'required|string',
            'offer_type' => 'required|in:Sprzedaż,Wynajem',
            'price' => 'required|integer|min:0',
            'deposit' => 'required|integer|min:0',
            'rent' => 'required|integer|min:0',

            // Walidacja zdjęć
            'pictures' => 'required|array|min:1',
            'pictures.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        DB::beginTransaction();

        try {
            // Tworzenie nieruchomości
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

            // Tworzenie oferty
            $offer = Offer::create([
                'owner_id' => Auth::id(),
                'property_id' => $property->id,
                'offer_title' => $request->offer_title,
                'offer_type' => $request->offer_type,
                'description' => $request->description,
                'price' => $request->price,
                'deposit' => $request->deposit,
                'rent' => $request->rent,
            ]);

            // Zapisywanie zdjęć
            if ($request->hasFile('pictures')) {
                foreach ($request->file('pictures') as $picture) {
                    $path = $picture->store('offers/' . $offer->id, 'public');

                    OfferPicture::create([
                        'offer_id' => $offer->id,
                        'path' => $path,
                    ]);
                }
            }

            DB::commit();

            return redirect()->route('offers.show', $offer->id)
                ->with('success', 'Nieruchomość i oferta zostały pomyślnie dodane!');

        } catch (\Exception $e) {
            DB::rollback();

            return back()->withInput()
                ->with('error', 'Wystąpił błąd podczas dodawania nieruchomości: ' . $e->getMessage());
        }
    }

    public function edit(Property $property)
    {
        return view('properties.edit', compact('property'));
    }

    public function update(Request $request, Property $property)
    {
        $offer = $property->offer;

        $request->validate([
            // Walidacja danych nieruchomości
            'country' => 'required|string|max:50',
            'region' => 'required|string|max:50',
            'town' => 'required|string|max:50',
            'postal_code' => 'required|string|max:10',
            'street' => 'required|string|max:50',
            'building_number' => 'required|string|max:10',
            'apartment_number' => 'nullable|integer',
            'type' => 'required|in:Dom,Mieszkanie,Lokal użytkowy',
            'surface' => 'required|numeric|min:0|max:9999.99',
            'number_of_rooms' => 'required|integer|min:1',
            'floor' => 'required|integer',
            'technical_condition' => 'required|in:Do remontu,Do kapitalnego remontu,Budynek w stanie surowym,Gotowy do zamieszkania',
            'furnishings' => 'required|in:Nieumeblowane,Częściowo umeblowane,W pełni umeblowane',

            // Walidacja danych oferty
            'offer_title' => 'required|string|max:255',
            'description' => 'required|string',
            'offer_type' => 'required|in:Sprzedaż,Wynajem',
            'price' => 'required|integer|min:0',
            'deposit' => 'required|integer|min:0',
            'rent' => 'required|integer|min:0',

            // Walidacja nowych zdjęć (opcjonalne)
            'pictures' => 'nullable|array',
            'pictures.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',

            // Walidacja usuniętych zdjęć
            'deleted_pictures' => 'nullable|string',
        ]);

        DB::beginTransaction();

        try {
            // Aktualizacja nieruchomości
            $property->update([
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

            // Aktualizacja oferty
            $offer->update([
                'offer_title' => $request->offer_title,
                'description' => $request->description,
                'offer_type' => $request->offer_type,
                'price' => $request->price,
                'deposit' => $request->deposit,
                'rent' => $request->rent,
            ]);

            // Usuwanie zaznaczonych zdjęć
            if ($request->deleted_pictures) {
                $deletedIds = explode(',', $request->deleted_pictures);
                $deletedIds = array_filter($deletedIds); // Usuń puste wartości

                if (!empty($deletedIds)) {
                    $picturesToDelete = OfferPicture::whereIn('id', $deletedIds)
                        ->where('offer_id', $offer->id)
                        ->get();

                    foreach ($picturesToDelete as $picture) {
                        // Usuń plik z dysku
                        if (Storage::disk('public')->exists($picture->path)) {
                            Storage::disk('public')->delete($picture->path);
                        }
                        // Usuń rekord z bazy
                        $picture->delete();
                    }
                }
            }

            // Dodawanie nowych zdjęć
            if ($request->hasFile('pictures')) {
                foreach ($request->file('pictures') as $picture) {
                    $path = $picture->store('offers/' . $offer->id, 'public');

                    OfferPicture::create([
                        'offer_id' => $offer->id,
                        'path' => $path,
                    ]);
                }
            }

            // Sprawdzenie czy oferta ma przynajmniej jedno zdjęcie
            $remainingPictures = OfferPicture::where('offer_id', $offer->id)->count();
            if ($remainingPictures === 0) {
                DB::rollback();
                return back()->withInput()
                    ->with('error', 'Oferta musi mieć przynajmniej jedno zdjęcie.');
            }

            DB::commit();

            return redirect()->route('offers.show', $offer->id)
                ->with('success', 'Nieruchomość została pomyślnie zaktualizowana!');

        } catch (\Exception $e) {
            DB::rollback();

            return back()->withInput()
                ->with('error', 'Wystąpił błąd podczas aktualizacji nieruchomości: ' . $e->getMessage());
        }
    }

    public function showOffer(Offer $offer)
    {
        $offer->load(['property', 'owner', 'pictures']);

        return view('offers.show', compact('offer'));
    }

    public function myOffers()
    {
        $offers = Offer::where('owner_id', Auth::id())
            ->with(['property', 'pictures'])
            ->latest()
            ->paginate(10);

        return view('offers.my-offers', compact('offers'));
    }
    public function destroy(Offer $offer)
    {
        DB::beginTransaction();

        try {
            $pictures = OfferPicture::where('offer_id', $offer->id)->get();

            foreach ($pictures as $picture) {
                // Usuń plik z dysku
                if (Storage::disk('public')->exists($picture->path)) {
                    Storage::disk('public')->delete($picture->path);
                }
                // Usuń rekord z bazy
                $picture->delete();
            }

            // Usuń folder oferty jeśli jest pusty
            $offerFolder = 'offers/' . $offer->id;
            if (Storage::disk('public')->exists($offerFolder)) {
                Storage::disk('public')->deleteDirectory($offerFolder);
            }

            // Usuń ofertę (nieruchomość zostanie usunięta przez kaskadę lub pozostanie)
            $offer->delete();

            // Opcjonalnie usuń nieruchomość jeśli nie ma innych ofert
            // Sprawdź czy nieruchomość ma inne oferty
            $property = $offer->property;
            $otherOffers = Offer::where('property_id', $property->id)->count();

            if ($otherOffers === 0) {
                $property->delete();
            }

            DB::commit();

            return redirect()->route('offers.my-offers')
                ->with('success', 'Oferta została pomyślnie usunięta!');

        } catch (\Exception $e) {
            DB::rollback();

            return back()
                ->with('error', 'Wystąpił błąd podczas usuwania oferty: ' . $e->getMessage());
        }
    }
    public function forSale(Request $request)
    {
        $query = Offer::with(['property', 'owner'])
            ->where('offer_type', 'Sprzedaż');

        // Filtry
        if ($request->filled('type')) {
            $query->whereHas('property', function($q) use ($request) {
                $q->where('type', $request->type);
            });
        }

        if ($request->filled('region')) {
            $query->whereHas('property', function($q) use ($request) {
                $q->where('region', 'like', '%' . $request->region . '%');
            });
        }

        if ($request->filled('town')) {
            $query->whereHas('property', function($q) use ($request) {
                $q->where('town', 'like', '%' . $request->town . '%');
            });
        }

        if ($request->filled('surface_min')) {
            $query->whereHas('property', function($q) use ($request) {
                $q->where('surface', '>=', $request->surface_min);
            });
        }

        if ($request->filled('surface_max')) {
            $query->whereHas('property', function($q) use ($request) {
                $q->where('surface', '<=', $request->surface_max);
            });
        }

        if ($request->filled('rooms_min')) {
            $query->whereHas('property', function($q) use ($request) {
                $q->where('number_of_rooms', '>=', $request->rooms_min);
            });
        }

        if ($request->filled('rooms_max')) {
            $query->whereHas('property', function($q) use ($request) {
                $q->where('number_of_rooms', '<=', $request->rooms_max);
            });
        }

        if ($request->filled('technical_condition')) {
            $query->whereHas('property', function($q) use ($request) {
                $q->where('technical_condition', $request->technical_condition);
            });
        }

        if ($request->filled('furnishings')) {
            $query->whereHas('property', function($q) use ($request) {
                $q->where('furnishings', $request->furnishings);
            });
        }

        if ($request->filled('price_min')) {
            $query->where('price', '>=', $request->price_min);
        }

        if ($request->filled('price_max')) {
            $query->where('price', '<=', $request->price_max);
        }

        $offers = $query->orderBy('created_at', 'desc')->paginate(12);

        return view('buy', compact('offers'));
    }

    /**
     * Wyświetl nieruchomości do wynajęcia
     */
    public function forRent(Request $request)
    {
        $query = Offer::with(['property', 'owner'])
            ->where('offer_type', 'Wynajem');

        // Filtry (identyczne jak w forSale ale dla wynajmu)
        if ($request->filled('type')) {
            $query->whereHas('property', function($q) use ($request) {
                $q->where('type', $request->type);
            });
        }

        if ($request->filled('region')) {
            $query->whereHas('property', function($q) use ($request) {
                $q->where('region', 'like', '%' . $request->region . '%');
            });
        }

        if ($request->filled('town')) {
            $query->whereHas('property', function($q) use ($request) {
                $q->where('town', 'like', '%' . $request->town . '%');
            });
        }

        if ($request->filled('surface_min')) {
            $query->whereHas('property', function($q) use ($request) {
                $q->where('surface', '>=', $request->surface_min);
            });
        }

        if ($request->filled('surface_max')) {
            $query->whereHas('property', function($q) use ($request) {
                $q->where('surface', '<=', $request->surface_max);
            });
        }

        if ($request->filled('rooms_min')) {
            $query->whereHas('property', function($q) use ($request) {
                $q->where('number_of_rooms', '>=', $request->rooms_min);
            });
        }

        if ($request->filled('rooms_max')) {
            $query->whereHas('property', function($q) use ($request) {
                $q->where('number_of_rooms', '<=', $request->rooms_max);
            });
        }

        if ($request->filled('technical_condition')) {
            $query->whereHas('property', function($q) use ($request) {
                $q->where('technical_condition', $request->technical_condition);
            });
        }

        if ($request->filled('furnishings')) {
            $query->whereHas('property', function($q) use ($request) {
                $q->where('furnishings', $request->furnishings);
            });
        }

        if ($request->filled('rent_min')) {
            $query->where('rent', '>=', $request->rent_min);
        }

        if ($request->filled('rent_max')) {
            $query->where('rent', '<=', $request->rent_max);
        }

        $offers = $query->orderBy('created_at', 'desc')->paginate(12);

        return view('rent', compact('offers'));
    }

    /**
     * Wyświetl szczegóły oferty
     */
    public function show($id)
    {
        $offer = Offer::with(['property', 'owner'])->findOrFail($id);
        return view('properties.show', compact('offer'));
    }
}
