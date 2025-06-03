<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use App\Models\Property;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use League\Csv\Writer;

class AdminController extends Controller
{
    public function properties(Request $request)
    {
        $query = Property::query()->with('offer');

        if ($request->type) {
            $query->where('type', $request->type);
        }
        if ($request->town) {
            $query->where('town', 'like', '%' . $request->town . '%');
        }
        if ($request->surface_from) {
            $query->where('surface', '>=', $request->surface_from);
        }
        if ($request->surface_to) {
            $query->where('surface', '<=', $request->surface_to);
        }

        $properties = $query->paginate(20);

        $typeAnalysis = Property::select('type', DB::raw('count(*) as count'), DB::raw('avg(surface) as avg_surface'))
            ->groupBy('type')
            ->get();

        return view('admin.properties', compact('properties', 'typeAnalysis'));
    }

    public function users(Request $request)
    {
        $query = User::query();

        if ($request->role) {
            $query->where('role', $request->role);
        }
        if ($request->name) {
            $query->whereRaw('CONCAT(first_name, " ", last_name) LIKE ?', ['%' . $request->name . '%']);
        }

        $users = $query->with('offers')->paginate(20);

        $roleAnalysis = User::select('role', DB::raw('count(*) as count'))
            ->groupBy('role')
            ->get();

        return view('admin.users', compact('users', 'roleAnalysis'));
    }

    public function offers(Request $request)
    {
        $query = Offer::query()->with(['property', 'owner']);

        if ($request->offer_type) {
            $query->where('offer_type', $request->offer_type);
        }
        if ($request->price_from) {
            $query->where('price', '>=', $request->price_from);
        }
        if ($request->price_to) {
            $query->where('price', '<=', $request->price_to);
        }
        if ($request->city) {
            $query->whereHas('property', fn($q) => $q->where('town', 'like', '%' . $request->city . '%'));
        }
        if ($request->date_from) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        $offers = $query->orderBy('price', 'desc')->paginate(20);

        $priceAnalysis = Offer::select('offer_type', 'properties.type as property_type',
            DB::raw('count(*) as count'), DB::raw('avg(price) as avg_price'))
            ->join('properties', 'offers.property_id', '=', 'properties.id')
            ->groupBy('offer_type', 'properties.type')
            ->get();

        $priceTrends = Offer::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('YEAR(created_at) as year'),
            'offer_type',
            DB::raw('avg(price) as avg_price'),
            DB::raw('count(*) as count')
        )
            ->groupBy('month', 'year', 'offer_type')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();

        $expensiveOffers = Offer::with(['property', 'owner'])->orderBy('price', 'desc')->take(20)->get();

        return view('admin.offers', compact('offers', 'priceAnalysis', 'priceTrends', 'expensiveOffers'));
    }

    public function transactions(Request $request)
    {
        $query = Transaction::query()->with(['property', 'owner', 'user']);

        if ($request->date_from) {
            $query->whereDate('transaction_date', '>=', $request->date_from);
        }
        if ($request->date_to) {
            $query->whereDate('transaction_date', '<=', $request->date_to);
        }
        if ($request->city) {
            $query->whereHas('property', fn($q) => $q->where('town', 'like', '%' . $request->city . '%'));
        }

        $transactions = $query->paginate(20);

        $trendAnalysis = Transaction::select(
            DB::raw('MONTH(transaction_date) as month'),
            DB::raw('YEAR(transaction_date) as year'),
            DB::raw('count(*) as count')
        )
            ->groupBy('month', 'year')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();

        return view('admin.transactions', compact('transactions', 'trendAnalysis'));
    }

    public function exportReport(Request $request)
    {
        $type = $request->query('type');
        $csv = Writer::createFromString('');

        switch ($type) {
            case 'properties':
                $csv->insertOne(['ID', 'Type', 'Town', 'Surface', 'Number of Rooms']);
                $properties = Property::select('id', 'type', 'town', 'surface', 'number_of_rooms')->get();
                foreach ($properties as $property) {
                    $csv->insertOne([$property->id, $property->type, $property->town, $property->surface, $property->number_of_rooms]);
                }
                return response($csv->toString(), 200, [
                    'Content-Type' => 'text/csv',
                    'Content-Disposition' => 'attachment; filename="properties.csv"',
                ]);

            case 'users':
                $csv->insertOne(['ID', 'Full Name', 'Email', 'Role']);
                $users = User::select('id', 'first_name', 'last_name', 'email', 'role')->get();
                foreach ($users as $user) {
                    $csv->insertOne([$user->id, $user->first_name . ' ' . $user->last_name, $user->email, $user->role]);
                }
                return response($csv->toString(), 200, [
                    'Content-Type' => 'text/csv',
                    'Content-Disposition' => 'attachment; filename="users.csv"',
                ]);

            case 'offers':
                $csv->insertOne(['ID', 'Title', 'Offer Type', 'Price', 'Town', 'Owner']);
                $offers = Offer::with(['property', 'owner'])->get();
                foreach ($offers as $offer) {
                    $csv->insertOne([
                        $offer->id,
                        $offer->offer_title,
                        $offer->offer_type,
                        $offer->price,
                        $offer->property ? $offer->property->town : 'N/A',
                        $offer->owner ? $offer->owner->full_name : 'N/A',
                    ]);
                }
                return response($csv->toString(), 200, [
                    'Content-Type' => 'text/csv',
                    'Content-Disposition' => 'attachment; filename="offers.csv"',
                ]);

            case 'expensive_offers':
                $csv->insertOne(['ID', 'Price', 'Offer Type', 'Property Type', 'Town', 'Surface', 'Owner', 'Price per m²']);
                $offers = Offer::with(['property', 'owner'])->orderBy('price', 'desc')->take(20)->get();
                foreach ($offers as $offer) {
                    $csv->insertOne([
                        $offer->id,
                        $offer->price,
                        $offer->offer_type,
                        $offer->property ? $offer->property->type : 'N/A',
                        $offer->property ? $offer->property->town : 'N/A',
                        $offer->property ? $offer->property->surface : 'N/A',
                        $offer->owner ? $offer->owner->full_name : 'N/A',
                        $offer->property ? ($offer->price / $offer->property->surface) : 'N/A',
                    ]);
                }
                return response($csv->toString(), 200, [
                    'Content-Type' => 'text/csv',
                    'Content-Disposition' => 'attachment; filename="expensive_offers.csv"',
                ]);

            case 'transactions':
                $csv->insertOne(['ID', 'Transaction Date', 'Town', 'Owner', 'User']);
                $transactions = Transaction::with(['property', 'owner', 'user'])->get();
                foreach ($transactions as $transaction) {
                    $csv->insertOne([
                        $transaction->id,
                        $transaction->transaction_date->format('Y-m-d'),
                        $transaction->property ? $transaction->property->town : 'N/A',
                        $transaction->owner ? $transaction->owner->full_name : 'N/A',
                        $transaction->user ? $transaction->user->full_name : 'N/A',
                    ]);
                }
                return response($csv->toString(), 200, [
                    'Content-Type' => 'text/csv',
                    'Content-Disposition' => 'attachment; filename="transactions.csv"',
                ]);

            default:
                abort(400, 'Invalid export type');
        }
    }
}
