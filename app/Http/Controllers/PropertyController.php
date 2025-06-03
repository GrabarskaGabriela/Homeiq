<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Property;
use App\Models\Offer;
use App\Models\OfferPicture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;


class PropertyController extends Controller
{
    public function create()
    {
         return view('properties.create');
    }

    public function store(Request $request)
    {
        $request->validate([
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

            'offer_title' => 'required|string|max:255',
            'description' => 'required|string',
            'offer_type' => 'required|in:Sprzedaż,Wynajem',
            'price' => 'required|integer|min:0',
            'deposit' => 'required|integer|min:0',
            'rent' => 'required|integer|min:0',

            'pictures' => 'required|array|min:1',
            'pictures.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        DB::beginTransaction();

        try {
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

            return redirect()->route('properties.show', $offer->id)
                ->with('success', 'Nieruchomość i oferta zostały pomyślnie dodane!');

        } catch (\Exception $e) {
            DB::rollback();

            return back()->withInput()
                ->with('error', 'Wystąpił błąd podczas dodawania nieruchomości: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $property = Property::findOrFail($id);
        $offer = Offer::where('property_id', $property->id)->firstOrFail();
        $offer->load('pictures');

        return view('properties.edit', compact('property', 'offer'));
    }

    public function update(Request $request, $id)
    {
        $property = Property::findOrFail($id);
        $offer = Offer::where('property_id', $property->id)->firstOrFail();

        if ($offer->owner_id !== Auth::id()) {
            abort(403, 'Brak uprawnień do edycji tej nieruchomości.');
        }

        $validatedData = $request->validate([
            'country' => 'required|string|max:100',
            'region' => 'required|string|max:100',
            'town' => 'required|string|max:100',
            'postal_code' => 'required|string|max:10',
            'street' => 'required|string|max:255',
            'building_number' => 'required|string|max:10',
            'apartment_number' => 'nullable|integer|min:1',

            'type' => 'required|in:Dom,Mieszkanie,Lokal użytkowy',
            'surface' => 'required|numeric|min:1|max:9999.99',
            'number_of_rooms' => 'required|integer|min:1|max:50',
            'floor' => 'required|integer|min:-5|max:100',
            'technical_condition' => 'required|in:Do remontu,Do kapitalnego remontu,Budynek w stanie surowym,Gotowy do zamieszkania',
            'furnishings' => 'required|in:Nieumeblowane,Częściowo umeblowane,W pełni umeblowane',

            'offer_title' => 'required|string|max:255',
            'offer_type' => 'required|in:Sprzedaż,Wynajem',
            'description' => 'required|string|min:50|max:2000',
            'price' => 'required|numeric|min:0|max:999999999',
            'deposit' => 'required|numeric|min:0|max:999999999',
            'rent' => 'required|numeric|min:0|max:999999999',

            'pictures.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'deleted_pictures' => 'nullable|string'
        ], [
            'country.required' => 'Pole kraj jest wymagane.',
            'region.required' => 'Pole województwo jest wymagane.',
            'town.required' => 'Pole miasto jest wymagane.',
            'postal_code.required' => 'Pole kod pocztowy jest wymagane.',
            'street.required' => 'Pole ulica jest wymagane.',
            'building_number.required' => 'Pole numer budynku jest wymagane.',
            'type.required' => 'Wybierz typ nieruchomości.',
            'surface.required' => 'Podaj powierzchnię nieruchomości.',
            'surface.min' => 'Powierzchnia musi być większa od 0.',
            'number_of_rooms.required' => 'Podaj liczbę pokoi.',
            'floor.required' => 'Podaj piętro.',
            'technical_condition.required' => 'Wybierz stan techniczny.',
            'furnishings.required' => 'Wybierz opcję umeblowania.',
            'offer_title.required' => 'Tytuł oferty jest wymagany.',
            'offer_type.required' => 'Wybierz typ oferty.',
            'description.required' => 'Opis jest wymagany.',
            'description.min' => 'Opis musi mieć co najmniej 50 znaków.',
            'price.required' => 'Cena jest wymagana.',
            'deposit.required' => 'Kaucja jest wymagana.',
            'rent.required' => 'Czynsz jest wymagany.',
            'pictures.*.image' => 'Przesłany plik musi być obrazem.',
            'pictures.*.max' => 'Rozmiar zdjęcia nie może przekraczać 2MB.'
        ]);

        try {
            DB::beginTransaction();
            $property->update([
                'country' => $validatedData['country'],
                'region' => $validatedData['region'],
                'town' => $validatedData['town'],
                'postal_code' => $validatedData['postal_code'],
                'street' => $validatedData['street'],
                'building_number' => $validatedData['building_number'],
                'apartment_number' => $validatedData['apartment_number'],
                'type' => $validatedData['type'],
                'surface' => $validatedData['surface'],
                'number_of_rooms' => $validatedData['number_of_rooms'],
                'floor' => $validatedData['floor'],
                'technical_condition' => $validatedData['technical_condition'],
                'furnishings' => $validatedData['furnishings'],
            ]);
            $offer->update([
                'offer_title' => $validatedData['offer_title'],
                'offer_type' => $validatedData['offer_type'],
                'description' => $validatedData['description'],
                'price' => $validatedData['price'],
                'deposit' => $validatedData['deposit'],
                'rent' => $validatedData['rent'],
            ]);
            if ($request->filled('deleted_pictures')) {
                $deletedPictureIds = explode(',', $request->deleted_pictures);
                $deletedPictureIds = array_filter($deletedPictureIds);

                if (!empty($deletedPictureIds)) {
                    $deletedPictures = PropertyPicture::whereIn('id', $deletedPictureIds)
                        ->where('offer_id', $offer->id)
                        ->get();

                    foreach ($deletedPictures as $picture) {
                        if (Storage::exists($picture->path)) {
                            Storage::delete($picture->path);
                        }
                        $picture->delete();
                    }
                }
            }
            if ($request->hasFile('pictures')) {
                foreach ($request->file('pictures') as $picture) {
                    $filename = time() . '_' . uniqid() . '.' . $picture->getClientOriginalExtension();
                    $path = $picture->storeAs('property_pictures', $filename, 'public');
                    PropertyPicture::create([
                        'offer_id' => $offer->id,
                        'path' => $path,
                        'filename' => $filename
                    ]);
                }
            }
            DB::commit();
            return redirect()
                ->route('properties.show', $offer->id)
                ->with('success', 'Nieruchomość została pomyślnie zaktualizowana!');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Błąd podczas aktualizacji nieruchomości:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Wystąpił błąd podczas aktualizacji nieruchomości. Spróbuj ponownie.');
        }
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
                if (Storage::disk('public')->exists($picture->path)) {
                    Storage::disk('public')->delete($picture->path);
                }
                $picture->delete();
            }
            $offerFolder = 'offers/' . $offer->id;
            if (Storage::disk('public')->exists($offerFolder)) {
                Storage::disk('public')->deleteDirectory($offerFolder);
            }
            $offer->delete();
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
    public function forRent(Request $request)
    {
        $query = Offer::with(['property', 'owner'])
            ->where('offer_type', 'Wynajem');

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
    public function show($id)
    {
        $offer = Offer::with(['property', 'owner'])->findOrFail($id);
        return view('properties.show', compact('offer'));
    }
}
