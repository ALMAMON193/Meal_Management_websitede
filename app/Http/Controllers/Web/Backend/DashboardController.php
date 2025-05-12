<?php

namespace App\Http\Controllers\Web\Backend;

use Carbon\Carbon;
use App\Models\Meal;
use App\Models\User;
use App\Models\Market;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
   public function index()
{
    $user = Auth::user();
    $isManager = $user->role === 'manager';

    // Total markets and expenses
    $totalMarkets = Market::count();
    $totalExpenses = Market::sum('total_price');

    // Current month expenses
    $currentMonthExpenses = Market::whereMonth('bazaar_date', Carbon::now()->month)
        ->whereYear('bazaar_date', Carbon::now()->year)
        ->sum('total_price');

    // Meal rate calculation
    $totalMeals = Meal::whereMonth('date', Carbon::now()->month)
        ->whereYear('date', Carbon::now()->year)
        ->sum(DB::raw('breakfast + lunch + dinner'));
    $mealRate = $totalMeals > 0 ? $currentMonthExpenses / $totalMeals : 0;

    // User-specific data
    $userMarkets = Market::where('user_id', $user->id)
        ->whereMonth('bazaar_date', Carbon::now()->month)
        ->whereYear('bazaar_date', Carbon::now()->year)
        ->sum('total_price');
    $userMeals = Meal::where('user_id', $user->id)
        ->whereMonth('date', Carbon::now()->month)
        ->whereYear('date', Carbon::now()->year)
        ->sum(DB::raw('breakfast + lunch + dinner'));
    $userMealCost = $userMeals * $mealRate;
    $userBalance = $userMarkets - $userMealCost;

    // Manager-specific data
    $managedUsers = [];
    $userBalances = [];
    if ($isManager) {
        $managedUsers = User::all();
        foreach ($managedUsers as $managedUser) {
            $marketTotal = Market::where('user_id', $managedUser->id)
                ->whereMonth('bazaar_date', Carbon::now()->month)
                ->whereYear('bazaar_date', Carbon::now()->year)
                ->sum('total_price');
            $mealCount = Meal::where('user_id', $managedUser->id)
                ->whereMonth('date', Carbon::now()->month)
                ->whereYear('date', Carbon::now()->year)
                ->sum(DB::raw('breakfast + lunch + dinner'));
            $mealCost = $mealCount * $mealRate;
            $balance = $marketTotal - $mealCost;

            $userBalances[$managedUser->id] = [
                'market_total' => $marketTotal,
                'meal_count' => $mealCount,
                'meal_cost' => $mealCost,
                'balance' => $balance,
                'bazaars' => Market::where('user_id', $managedUser->id)
                    ->whereMonth('bazaar_date', Carbon::now()->month)
                    ->whereYear('bazaar_date', Carbon::now()->year)
                    ->select('id', 'bazaar_date', 'item_details', 'total_price')
                    ->get(),
            ];
        }
    }

    // Historical data (last 8 months)
    $historicalData = [];
    for ($i = 0; $i <= 8; $i++) {
        $month = Carbon::now()->subMonths($i);
        $historicalData[$month->format('Y-m')] = [
            'expenses' => Market::whereMonth('bazaar_date', $month->month)
                ->whereYear('bazaar_date', $month->year)
                ->sum('total_price'),
            'meals' => Meal::whereMonth('date', $month->month)
                ->whereYear('date', $month->year)
                ->sum(DB::raw('breakfast + lunch + dinner')),
        ];
    }

    return view('backend.layout.dashboard', compact(
        'totalMarkets',
        'totalExpenses',
        'currentMonthExpenses',
        'mealRate',
        'userMarkets',
        'userMealCost',
        'userBalance',
        'historicalData',
        'isManager',
        'managedUsers',
        'userBalances'
    ));
}
}
