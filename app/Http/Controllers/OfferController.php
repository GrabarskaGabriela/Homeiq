<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OfferController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    // Strona główna z ofertami
    public function index(Request $request)
    {
        $offerts = Offer::with('property') // jeśli masz relację z właściwością
        ->latest()
            ->paginate(9); // lub ->get()

        return view('offers.index', compact('offerts'));
    }

    // Pokaż pojedynczą ofertę
    public function show($id)
    {
        $offer = Offer::with(['property', 'photos'])->findOrFail($id);
        return view('offers.show', compact('offer'));
    }

    // Lista ofert użytkownika
    public function myOffers()
    {
        $offerts = Offer::where('id_owner', Auth::id())->latest()->paginate(6);
        return view('offers.my_offers', compact('offerts'));
    }

    // Dodawanie nowej oferty – widok formularza
    public function create()
    {
        return view('offers.create');
    }

    // Zapis nowej oferty
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_property' => 'required|exists:properties,id',
            'offer_title' => 'required|string|max:150',
            'description' => 'required|string',
            'price' => 'required|integer',
            'deposit' => 'nullable|integer',
            'rent' => 'required|numeric',
        ]);

        $validated['id_owner'] = Auth::id();
        Offer::create($validated);

        return redirect()->route('offers.index')->with('success', 'Oferta została dodana.');
    }

    // Edycja oferty
    public function edit($id)
    {
        $offer = Offer::where('id', $id)->where('id_owner', Auth::id())->firstOrFail();
        return view('offers.edit', compact('offer'));
    }

    // Aktualizacja oferty
    public function update(Request $request, $id)
    {
        $offer = Offer::where('id', $id)->where('id_owner', Auth::id())->firstOrFail();

        $validated = $request->validate([
            'offer_title' => 'required|string|max:150',
            'description' => 'required|string',
            'price' => 'required|integer',
            'deposit' => 'nullable|integer',
            'rent' => 'required|numeric',
        ]);

        $offer->update($validated);

        return redirect()->route('offers.index')->with('success', 'Oferta została zaktualizowana.');
    }

    // Usunięcie oferty
    public function destroy($id)
    {
        $offer = Offer::where('id', $id)->where('id_owner', Auth::id())->firstOrFail();
        $offer->delete();

        return redirect()->route('offers.index')->with('success', 'Oferta została usunięta.');
    }
}
