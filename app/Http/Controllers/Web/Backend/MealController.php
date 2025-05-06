<?php

namespace App\Http\Controllers\Web\Backend;

use Carbon\Carbon;
use App\Models\Meal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MealController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        if ($user->role !== 'manager') {
            return redirect()->back()->with('error', 'You are not authorized to view this page');
        }

        // Fetch members managed by this manager, including the manager
        $members = $user->managedMembers()->get()->prepend($user);

        // Get the selected date from the request, default to today
        $selectedDate = $request->input('date', now()->format('Y-m-d'));

        // Fetch meal data for the selected date
        $meals = Meal::where('date', $selectedDate)
            ->whereIn('user_id', $members->pluck('id'))
            ->get()
            ->keyBy('user_id');

        // Calculate total meals and average meal rate
        $totalMeals = $meals->sum('meal_count');
        $totalMembers = $members->count();
        $averageMealRate = $totalMembers > 0 ? ($totalMeals / $totalMembers) * 100 : 0;
        $averageMealRate = round($averageMealRate, 2);

        return view('backend.layout.pages.meal', compact('members', 'meals', 'totalMeals', 'averageMealRate', 'selectedDate'));
    }
    public function store(Request $request)
    {
        $user = Auth::user();
        if ($user->role !== 'manager') {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $date = $request->input('date');
        $mealData = $request->input('meals');

        foreach ($mealData as $userId => $meals) {
            $totalMeal = array_sum($meals);
            Meal::updateOrCreate(
                ['user_id' => $userId, 'date' => $date],
                ['meal_count' => $totalMeal]
            );
        }

        return response()->json(['message' => 'Meal data saved successfully']);
    }
    public function getMealData(Request $request)
    {
        $user = Auth::user();
        if ($user->role !== 'manager') {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $date = $request->input('date');
        $members = $user->managedMembers()->get()->prepend($user);

        $meals = Meal::where('date', $date)
            ->whereIn('user_id', $members->pluck('id'))
            ->get()
            ->keyBy('user_id');

        $totalMeals = $meals->sum('meal_count');
        $totalMembers = $members->count();
        $averageMealRate = $totalMembers > 0 ? ($totalMeals / $totalMembers) * 100 : 0;

        return response()->json([
            'members' => $members,
            'meals' => $meals,
            'totalMeals' => $totalMeals,
            'averageMealRate' => round($averageMealRate, 2),
            'totalMembers' => $totalMembers,
            'presentCount' => $meals->count(),
            'absentCount' => $totalMembers - $meals->count(),
        ]);
    }
}
