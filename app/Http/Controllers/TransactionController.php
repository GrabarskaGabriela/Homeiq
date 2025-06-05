<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use App\Notifications\TransactionInitiated;

class TransactionController extends Controller
{
    public function create(Request $request, Offer $offer)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Musisz być zalogowany, aby dokonać transakcji.');
        }

        if (Auth::id() === $offer->owner_id) {
            return back()->with('error', 'Nie możesz dokonać transakcji na własnej ofercie.');
        }

        if ($offer->status !== 'available') {
            return back()->with('error', 'Ta oferta nie jest już dostępna.');
        }

        $request->validate([
            'transaction_type' => 'required|in:purchase,rental',
        ]);

        $transaction = Transaction::create([
            'property_id' => $offer->property_id,
            'owner_id' => $offer->owner_id,
            'user_id' => Auth::id(),
            'transaction_date' => now(),
            'status' => 'pending',
        ]);

        $offer->update(['status' => 'pending']);
        $offer->property->update(['status' => 'pending']);

        $type = $request->transaction_type === 'purchase' ? 'kupna' : 'wynajmu';
        return back()->with('success', "Transakcja $type została zainicjowana. Oczekuje na potwierdzenie właściciela.");
    }

    public function pending()
    {
        $transactions = Transaction::where('owner_id', Auth::id())
            ->where('status', 'pending')
            ->with(['property.offer', 'user'])
            ->get();
        return view('transactions.pending', compact('transactions'));
    }

    public function showConfirmation(Transaction $transaction)
    {
        if (Auth::id() !== $transaction->owner_id) {
            return back()->with('error', 'Nie masz uprawnień do potwierdzenia tej transakcji.');
        }

        return view('transactions.confirm', compact('transaction'));
    }

    public function confirm(Request $request, Transaction $transaction)
    {
        if (Auth::id() !== $transaction->owner_id) {
            return back()->with('error', 'Nie masz uprawnień do potwierdzenia tej transakcji.');
        }

        $offer = $transaction->property->offer;
        $request->validate([
            'action' => 'required|in:confirm,reject',
        ]);

        if ($request->action === 'confirm') {
            $newStatus = $offer->offer_type === 'Sprzedaż' ? 'sold' : 'rented';
            $transaction->update(['status' => $newStatus]);
            $offer->update(['status' => $newStatus]);
            $offer->property->update(['status' => $newStatus]);
            return redirect()->route('transactions.pending')->with('success', 'Transakcja została potwierdzona.');
        } else {
            $transaction->delete();
            $offer->update(['status' => 'available']);
            $offer->property->update(['status' => 'available']);
            return redirect()->route('transactions.pending')->with('success', 'Transakcja została odrzucona.');
        }
    }
}
