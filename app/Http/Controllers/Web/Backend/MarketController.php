<?php

namespace App\Http\Controllers\Web\Backend;

use Carbon\Carbon;
use App\Models\Market;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MarketController extends Controller
{
  
    public function index()
{
    $user = Auth::user();

    // All markets for the user (with pagination)
    $markets = Market::where('user_id', $user->id)
        ->latest()
        ->paginate(10);

    // Today's markets for the user
    $today_markets = Market::where('user_id', $user->id)
        ->whereDate('bazaar_date', Carbon::today()->toDateString())
        ->get();

    // Current month's markets total amount for the user
    $current_month_total = Market::where('user_id', $user->id)
        ->whereBetween('bazaar_date', [
            Carbon::now()->startOfMonth()->toDateString(), 
            Carbon::now()->endOfMonth()->toDateString()
        ])
        ->sum('total_price');

    // Total amount for the user
    $total_amount = Market::where('user_id', $user->id)
        ->sum('total_price');

    return view('backend.layout.pages.market', compact(
        'markets',
        'today_markets',
        'current_month_total', // Changed from current_month_markets to current_month_total
        'total_amount'
    ));
}

    // Store new market with mess_id
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'bazaar_date' => 'required|date',
            'item_details' => 'required|string',
            'total_price' => 'required|numeric|min:0',
            'user_id' => 'required|exists:users,id'
        ]);
        
        // Add mess_id from authenticated user
        $validatedData['mess_id'] = Auth::user()->mess_id;
        
        $market = Market::create($validatedData);
        return response()->json(['data' => $market], 201);
    }

    // Edit market (with mess_id check)
    public function edit($id)
    {
        try {
            $market = Market::where('mess_id', Auth::user()->mess_id)
                          ->findOrFail($id);
            return response()->json($market);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Market not found'], 404);
        }
    }

    // Update market (with mess_id check)
    public function update(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'bazaar_date' => 'required|date',
                'item_details' => 'required|string',
                'total_price' => 'required|numeric|min:0',
                'user_id' => 'required|exists:users,id'
            ]);

            $market = Market::where('mess_id', Auth::user()->mess_id)
                          ->findOrFail($id);
            
            $market->update($validated);

            return response()->json(['data' => $market]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while updating market'], 500);
        }
    }

    // Delete market (with mess_id check)
    public function destroy($id)
    {
        $market = Market::where('mess_id', Auth::user()->mess_id)
                      ->findOrFail($id);
        $market->delete();
        return response()->json([], 204);
    }

    // Statistics for the mess
    public function stats()
    {
        $mess_id = Auth::user()->mess_id;
        
        return response()->json([
            'total_count' => Market::where('mess_id', $mess_id)->count(),
            'current_month_total' => Market::where('mess_id', $mess_id)
                                         ->whereMonth('bazaar_date', now()->month)
                                         ->whereYear('bazaar_date', now()->year)
                                         ->sum('total_price')
        ]);
    }
}
