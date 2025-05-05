<?php

namespace App\Http\Controllers\Web\Backend;

use App\Models\Meal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MealController extends Controller
{
    public function index(Request $request)
{
    $date = $request->query('date', now()->format('Y-m-d'));

     $meal =  Meal::whereDate('date', $date)
        ->get()
        ->map(fn($meal) => [
            'member_id' => $meal->member_id,
            'meal_count' => $meal->meal_count
        ]);
    return view('backend.layout.pages.meal', compact('meal', 'date'));
}

public function store(Request $request)
{
    $validated = $request->validate([
        'meals' => 'required|array',
        'meals.*.member_id' => 'required|exists:members,id',
        'meals.*.date' => 'required|date',
        'meals.*.meal_count' => 'required|numeric|min:0|max:10'
    ]);

    foreach ($validated['meals'] as $mealData) {
        Meal::updateOrCreate(
            [
                'member_id' => $mealData['member_id'],
                'date' => $mealData['date']
            ],
            ['meal_count' => $mealData['meal_count']]
        );
    }

    return response()->json(['message' => 'Meals saved successfully']);
}
}
