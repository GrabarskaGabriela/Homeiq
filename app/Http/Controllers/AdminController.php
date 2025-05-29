<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Property;
use App\Models\Offer;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (auth()->user()->role !== 'admin') {
                abort(403, 'Brak uprawnień administratora');
            }
            return $next($request);
        });
    }

    public function dashboard()
    {
        // Podstawowe statystyki
        $stats = [
            'total_users' => User::count(),
            'total_properties' => Property::count(),
            'total_offers' => Offer::count(),
            'total_transactions' => Transaction::count(),
            'new_users_this_month' => User::whereMonth('created_at', Carbon::now()->month)->count(),
            'active_offers' => Offer::count(), // Możesz dodać pole 'active' do offers
            'transactions_this_month' => Transaction::whereMonth('created_at', Carbon::now()->month)->count(),
        ];

        // Średnie ceny według typów nieruchomości
        $avgPricesByType = Offer::join('properties', 'offers.property_id', '=', 'properties.id')
            ->select('properties.type', DB::raw('AVG(offers.price) as avg_price'))
            ->groupBy('properties.type')
            ->get();

        // Najpopularniejsze miasta
        $popularCities = Property::select('town', DB::raw('COUNT(*) as count'))
            ->groupBy('town')
            ->orderBy('count', 'desc')
            ->limit(10)
            ->get();

        // Transakcje w ostatnim roku (miesięcznie)
        $monthlyTransactions = Transaction::select(
            DB::raw('YEAR(transaction_date) as year'),
            DB::raw('MONTH(transaction_date) as month'),
            DB::raw('COUNT(*) as count')
        )
            ->where('transaction_date', '>=', Carbon::now()->subYear())
            ->groupBy('year', 'month')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get();

        return view('admin.dashboard', compact('stats', 'avgPricesByType', 'popularCities', 'monthlyTransactions'));
    }

    public function propertyReports()
    {
        // Analiza powierzchni nieruchomości
        $surfaceAnalysis = Property::select(
            DB::raw('
                CASE
                    WHEN surface <= 40 THEN "Kawalerka (do 40m²)"
                    WHEN surface <= 70 THEN "Małe mieszkanie (40-70m²)"
                    WHEN surface <= 100 THEN "Średnie mieszkanie (70-100m²)"
                    WHEN surface <= 150 THEN "Duże mieszkanie (100-150m²)"
                    ELSE "Bardzo duże (150m²+)"
                END as surface_category
            '),
            DB::raw('COUNT(*) as count'),
            DB::raw('AVG(surface) as avg_surface')
        )
            ->groupBy('surface_category')
            ->get();

        // Analiza według stanu technicznego
        $technicalCondition = Property::select('technical_condition', DB::raw('COUNT(*) as count'))
            ->groupBy('technical_condition')
            ->get();

        // Najpopularniejsze regiony
        $regionStats = Property::select('region', 'town', DB::raw('COUNT(*) as count'))
            ->groupBy('region', 'town')
            ->orderBy('count', 'desc')
            ->get();

        // Analiza typu nieruchomości vs liczba pokoi
        $typeRoomsAnalysis = Property::select(
            'type',
            'number_of_rooms',
            DB::raw('COUNT(*) as count'),
            DB::raw('AVG(surface) as avg_surface')
        )
            ->groupBy('type', 'number_of_rooms')
            ->orderBy('type')
            ->orderBy('number_of_rooms')
            ->get();

        return view('admin.property-reports', compact(
            'surfaceAnalysis',
            'technicalCondition',
            'regionStats',
            'typeRoomsAnalysis'
        ));
    }

    public function offerReports()
    {
        // Analiza cen według typu oferty
        $priceAnalysis = Offer::join('properties', 'offers.property_id', '=', 'properties.id')
            ->select(
                'offers.offer_type',
                'properties.type as property_type',
                DB::raw('COUNT(*) as count'),
                DB::raw('AVG(offers.price) as avg_price'),
                DB::raw('MIN(offers.price) as min_price'),
                DB::raw('MAX(offers.price) as max_price')
            )
            ->groupBy('offers.offer_type', 'properties.type')
            ->get();

        // Oferty z najwyższymi cenami
        $expensiveOffers = Offer::with(['property', 'owner'])
            ->orderBy('price', 'desc')
            ->limit(20)
            ->get();

        // Analiza cen według miast
        $cityPriceAnalysis = Offer::join('properties', 'offers.property_id', '=', 'properties.id')
            ->select(
                'properties.town',
                'offers.offer_type',
                DB::raw('COUNT(*) as count'),
                DB::raw('AVG(offers.price) as avg_price'),
                DB::raw('AVG(properties.surface) as avg_surface'),
                DB::raw('AVG(offers.price / properties.surface) as price_per_m2')
            )
            ->groupBy('properties.town', 'offers.offer_type')
            ->having('count', '>=', 2) // Tylko miasta z więcej niż 1 ofertą
            ->orderBy('avg_price', 'desc')
            ->get();

        // Trend cen w czasie
        $priceTrends = Offer::select(
            DB::raw('YEAR(created_at) as year'),
            DB::raw('MONTH(created_at) as month'),
            'offer_type',
            DB::raw('AVG(price) as avg_price'),
            DB::raw('COUNT(*) as count')
        )
            ->groupBy('year', 'month', 'offer_type')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get();

        return view('admin.offer-reports', compact(
            'priceAnalysis',
            'expensiveOffers',
            'cityPriceAnalysis',
            'priceTrends'
        ));
    }

    public function userReports()
    {
        // Aktywność użytkowników
        $userActivity = User::select(
            'role',
            DB::raw('COUNT(*) as count'),
            DB::raw('COUNT(CASE WHEN created_at >= DATE_SUB(NOW(), INTERVAL 30 DAY) THEN 1 END) as new_last_30_days'),
            DB::raw('COUNT(CASE WHEN created_at >= DATE_SUB(NOW(), INTERVAL 7 DAY) THEN 1 END) as new_last_7_days')
        )
            ->groupBy('role')
            ->get();

        // Najaktywniejsze osoby (właściciele z największą liczbą ofert)
        $topOwners = User::withCount(['ownedOffers'])
            ->orderBy('owned_offers_count', 'desc')
            ->limit(20)
            ->get();

        // Rejestracje w czasie
        $registrationTrends = User::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('COUNT(*) as count')
        )
            ->where('created_at', '>=', Carbon::now()->subDays(30))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Analiza użytkowników według transakcji
        $userTransactionAnalysis = User::leftJoin('transactions', 'users.id', '=', 'transactions.user_id')
            ->select(
                'users.role',
                DB::raw('COUNT(DISTINCT users.id) as total_users'),
                DB::raw('COUNT(transactions.id) as total_transactions'),
                DB::raw('COUNT(DISTINCT transactions.user_id) as users_with_transactions')
            )
            ->groupBy('users.role')
            ->get();

        return view('admin.user-reports', compact(
            'userActivity',
            'topOwners',
            'registrationTrends',
            'userTransactionAnalysis'
        ));
    }

    public function transactionReports()
    {
        // Analiza transakcji według miesięcy
        $monthlyTransactionStats = Transaction::join('offers', 'transactions.property_id', '=', 'offers.property_id')
            ->join('properties', 'transactions.property_id', '=', 'properties.id')
            ->select(
                DB::raw('YEAR(transaction_date) as year'),
                DB::raw('MONTH(transaction_date) as month'),
                DB::raw('COUNT(*) as count'),
                DB::raw('AVG(offers.price) as avg_transaction_value'),
                DB::raw('SUM(offers.price) as total_value')
            )
            ->groupBy('year', 'month')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get();

        // Najczęstsze lokalizacje transakcji
        $transactionLocations = Transaction::join('properties', 'transactions.property_id', '=', 'properties.id')
            ->select(
                'properties.region',
                'properties.town',
                DB::raw('COUNT(*) as transaction_count')
            )
            ->groupBy('properties.region', 'properties.town')
            ->orderBy('transaction_count', 'desc')
            ->limit(15)
            ->get();

        // Analiza czasu od utworzenia oferty do transakcji
        $timeToTransaction = DB::table('transactions')
            ->join('offers', 'transactions.property_id', '=', 'offers.property_id')
            ->select(
                DB::raw('AVG(DATEDIFF(transaction_date, offers.created_at)) as avg_days_to_transaction'),
                DB::raw('MIN(DATEDIFF(transaction_date, offers.created_at)) as min_days'),
                DB::raw('MAX(DATEDIFF(transaction_date, offers.created_at)) as max_days'),
                'offers.offer_type'
            )
            ->where('transaction_date', '>=', 'offers.created_at')
            ->groupBy('offers.offer_type')
            ->get();

        // Najaktywniejsze miesiące
        $seasonalTrends = Transaction::select(
            DB::raw('MONTH(transaction_date) as month'),
            DB::raw('COUNT(*) as count'),
            DB::raw('
                CASE
                    WHEN MONTH(transaction_date) IN (12, 1, 2) THEN "Zima"
                    WHEN MONTH(transaction_date) IN (3, 4, 5) THEN "Wiosna"
                    WHEN MONTH(transaction_date) IN (6, 7, 8) THEN "Lato"
                    ELSE "Jesień"
                END as season
            ')
        )
            ->groupBy('month', 'season')
            ->orderBy('month')
            ->get();

        return view('admin.transaction-reports', compact(
            'monthlyTransactionStats',
            'transactionLocations',
            'timeToTransaction',
            'seasonalTrends'
        ));
    }

    public function advancedReports()
    {
        // ROI Analysis - zwrot z inwestycji dla wynajmu
        $roiAnalysis = Offer::join('properties', 'offers.property_id', '=', 'properties.id')
            ->where('offers.offer_type', 'Wynajem')
            ->where('offers.rent', '>', 0)
            ->where('offers.price', '>', 0)
            ->select(
                'properties.town',
                'properties.type',
                DB::raw('AVG(offers.rent) as avg_rent'),
                DB::raw('AVG(offers.price) as avg_price'),
                DB::raw('AVG((offers.rent * 12) / offers.price * 100) as avg_roi_percentage'),
                DB::raw('COUNT(*) as count')
            )
            ->groupBy('properties.town', 'properties.type')
            ->having('count', '>=', 2)
            ->orderBy('avg_roi_percentage', 'desc')
            ->get();

        // Analiza konkurencyjności cenowej
        $priceCompetitiveness = DB::table('offers as o1')
            ->join('properties as p1', 'o1.property_id', '=', 'p1.id')
            ->leftJoin('offers as o2', function($join) {
                $join->on('o2.offer_type', '=', 'o1.offer_type')
                    ->on('o2.id', '!=', 'o1.id');
            })
            ->leftJoin('properties as p2', 'o2.property_id', '=', 'p2.id')
            ->where('p2.town', '=', DB::raw('p1.town'))
            ->where('p2.type', '=', DB::raw('p1.type'))
            ->select(
                'p1.town',
                'p1.type',
                'o1.offer_type',
                DB::raw('COUNT(DISTINCT o1.id) as total_offers'),
                DB::raw('AVG(o1.price) as avg_price'),
                DB::raw('MIN(o1.price) as min_price'),
                DB::raw('MAX(o1.price) as max_price'),
                DB::raw('STDDEV(o1.price) as price_std_dev')
            )
            ->groupBy('p1.town', 'p1.type', 'o1.offer_type')
            ->having('total_offers', '>=', 3)
            ->get();

        // Trendy powierzchni vs cena
        $surfacePriceTrends = Offer::join('properties', 'offers.property_id', '=', 'properties.id')
            ->select(
                'properties.type',
                'offers.offer_type',
                DB::raw('
                    CASE
                        WHEN properties.surface <= 40 THEN "Małe (≤40m²)"
                        WHEN properties.surface <= 70 THEN "Średnie (40-70m²)"
                        WHEN properties.surface <= 100 THEN "Duże (70-100m²)"
                        ELSE "Bardzo duże (>100m²)"
                    END as surface_category
                '),
                DB::raw('COUNT(*) as count'),
                DB::raw('AVG(offers.price) as avg_price'),
                DB::raw('AVG(offers.price / properties.surface) as avg_price_per_m2')
            )
            ->groupBy('properties.type', 'offers.offer_type', 'surface_category')
            ->orderBy('properties.type')
            ->orderBy('avg_price_per_m2', 'desc')
            ->get();

        return view('admin.advanced-reports', compact(
            'roiAnalysis',
            'priceCompetitiveness',
            'surfacePriceTrends'
        ));
    }

    public function exportReport(Request $request)
    {
        $reportType = $request->get('type');

        // Tutaj możesz dodać logikę eksportu do CSV/Excel
        // Przykład dla transaction report:

        if ($reportType === 'transactions') {
            $transactions = Transaction::with(['property', 'owner', 'user'])
                ->get();

            $filename = 'transactions_report_' . date('Y-m-d') . '.csv';

            $headers = [
                'Content-Type' => 'text/csv',
                'Content-Disposition' => 'attachment; filename="' . $filename . '"',
            ];

            $callback = function() use ($transactions) {
                $file = fopen('php://output', 'w');
                fputcsv($file, ['ID', 'Data transakcji', 'Właściciel', 'Nabywca', 'Miasto', 'Typ nieruchomości']);

                foreach ($transactions as $transaction) {
                    fputcsv($file, [
                        $transaction->id,
                        $transaction->transaction_date,
                        $transaction->owner->first_name . ' ' . $transaction->owner->last_name,
                        $transaction->user->first_name . ' ' . $transaction->user->last_name,
                        $transaction->property->town,
                        $transaction->property->type
                    ]);
                }
                fclose($file);
            };

            return response()->stream($callback, 200, $headers);
        }

        return redirect()->back()->with('error', 'Nieznany typ raportu');
    }
}
