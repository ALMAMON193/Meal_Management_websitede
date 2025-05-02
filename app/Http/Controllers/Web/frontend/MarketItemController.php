<?php

namespace App\Http\Controllers\Web\frontend;

use Carbon\Carbon;
use App\Models\User;
use App\Models\MarketItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MarketItemController extends Controller
{

    public function index()
{
    $user = User::all();
    // Get market items grouped by both date and user_id
    $marketItems = MarketItem::with('user')
        ->orderBy('date', 'desc')
        ->get()
        ->groupBy(['date', 'user_id']);

    // Get monthly user expenses for current month
    $currentMonth = Carbon::now()->month;
    $currentYear = Carbon::now()->year;

    $monthlyUsers = DB::table('market_items')
        ->join('users', 'market_items.user_id', '=', 'users.id')
        ->select(
            'users.name',
            DB::raw('SUM(market_items.price) as total_price')
        )
        ->whereMonth('market_items.date', $currentMonth)
        ->whereYear('market_items.date', $currentYear)
        ->groupBy('users.name')
        ->having('total_price', '>', 0)
        ->orderBy('total_price', 'desc')
        ->get();

    return view('frontend.layout.index', compact('marketItems', 'monthlyUsers','user'));
}

    public function store(Request $request)
    {
        // Check if the user is authenticated
        $user = Auth::user();
        if (!$user) {
            return response()->json([
                'message' => 'Unauthorized',
            ], 401); // Return 401 Unauthorized if user is not authenticated
        }
        // Validate the incoming request
        $validated = $request->validate([
            'items' => 'required|array|min:1', // Ensure at least one item
            'items.*.name' => 'required|string|max:255',
            'items.*.price' => 'required|numeric|min:0',
            'items.*.date' => 'required|date',
        ]);

        // Create and save market items
        $items = collect($validated['items'])->map(function ($item) {
            $marketItem = new MarketItem([
                'name' => $item['name'],
                'price' => $item['price'],
                'date' => $item['date'],
                'user_id' => $item['user_id'] ?? Auth::id(), // Use the authenticated user's ID
            ]);
            $marketItem->save(); // Save each item
            return $marketItem;
        });

        return response()->json([
            'message' => 'Items saved successfully',
            'items' => $items
        ], 201); // Use 201 status code for resource creation
    }

}
