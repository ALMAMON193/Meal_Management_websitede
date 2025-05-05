<?php

namespace App\Http\Controllers\Web\Backend;

use App\Models\Market;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MarketController extends Controller
{

    // সব বাজারের তথ্য দেখাবে
    public function index()
    {
        $markets = Market::with('member')->latest()->get();
        return view('backend.layout.pages.market', compact('markets'));
    }

    // নতুন বাজারের তথ্য সংরক্ষণ
    public function store(Request $request)
    {
        $request->validate([
            'bazaar_date' => 'required|date',
            'item_details' => 'required|string',
            'total_price' => 'required|numeric|min:0',
            'user_id' => 'required|exists:users,id',
        ]);

        try {
            Market::create([
                'bazaar_date' => $request->bazaar_date,
                'item_details' => $request->item_details,
                'total_price' => $request->total_price,
                'user_id' => $request->user_id, // Changed from member_id to user_id
            ]);

            return response()->json([
                'success' => true,
                'message' => 'বাজারের তথ্য সফলভাবে সংরক্ষণ করা হয়েছে',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'তথ্য সংরক্ষণে সমস্যা হয়েছে: ' . $e->getMessage(),
            ], 500);
        }
    }

    // বাজারের তথ্য আপডেট
    public function update(Request $request, Market $market)
    {
        $request->validate([
            'bazaar_date' => 'required|date',
            'item_details' => 'required|string',
            'total_price' => 'required|numeric|min:0',
        ]);

        $market->update($request->all());

        return response()->json(['success' => 'বাজারের তথ্য সফলভাবে আপডেট করা হয়েছে']);
    }

    // বাজারের তথ্য ডিলিট
    public function destroy(Market $market)
    {
        $market->delete();
        return response()->json(['success' => 'বাজারের তথ্য সফলভাবে ডিলিট করা হয়েছে']);
    }
}
