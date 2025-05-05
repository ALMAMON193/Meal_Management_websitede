<?php

namespace App\Http\Controllers\Web\Backend;

use Carbon\Carbon;
use App\Models\Market;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MarketController extends Controller
{

    // সব বাজারের তথ্য দেখাবে
    public function index()
    {
        // Get today's date
        $today = Carbon::today()->toDateString();

        // Get current month start and end dates
        $currentMonthStart = Carbon::now()->startOfMonth()->toDateString();
        $currentMonthEnd = Carbon::now()->endOfMonth()->toDateString();

        // Query for different data sets
        $markets = Market::where('user_id', Auth::id())
            ->latest()
            ->paginate(10); // Add pagination

        $today_markets = Market::where('user_id', Auth::id())
            ->whereDate('bazaar_date', $today)
            ->get();

        $current_month_markets = Market::where('user_id', Auth::id())
            ->whereBetween('bazaar_date', [$currentMonthStart, $currentMonthEnd])
            ->get();

        $total_amount = $markets->sum('total_price');

        return view('backend.layout.pages.market', compact(
            'markets',
            'today_markets',
            'current_month_markets',
            'total_amount'
        ));
    }

    public function store(Request $request) {
        $market = Market::create($request->validate([
            'bazaar_date' => 'required|date',
            'item_details' => 'required|string',
            'total_price' => 'required|numeric|min:0',
            'user_id' => 'required|exists:users,id'
        ]));
        return response()->json(['data' => $market], 201);
    }
    public function edit($id)
    {
        try {
            $market = Market::findOrFail($id);
            return response()->json($market);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Market not found'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'bazaar_date' => 'required|date',
                'item_details' => 'required|string',
                'total_price' => 'required|numeric|min:0',
                'user_id' => 'required|exists:users,id'
            ]);

            $market = Market::findOrFail($id);
            $market->update($validated);

            return response()->json(['data' => $market]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while updating market'], 500);
        }
    }

    public function destroy($id) {
        Market::findOrFail($id)->delete();
        return response()->json([], 204);
    }

    public function stats() {
        return response()->json([
            'total_count' => Market::count(),
            'current_month_total' => Market::whereMonth('bazaar_date', now()->month)
                                         ->whereYear('bazaar_date', now()->year)
                                         ->sum('total_price')
        ]);
    }
}
