<?php

namespace App\Http\Controllers\Web\Backend;

use Exception;
use Carbon\Carbon;
use App\Models\Meal;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class MealController extends Controller
{
    public function allIndex(Request $request)
    {
        $allmeals = Meal::whereYear('date', now()->year)
                      ->whereMonth('date', now()->month)
                      ->get();

        //total meal this month
        $totalMeals = $allmeals->sum('meal_count');
        $totalMembers = User::where('role', '!=', 'manager')->count();
        $averageMealRate = $totalMembers > 0 ? ($totalMeals / $totalMembers) * 100 : 0;
        $averageMealRate = round($averageMealRate, 2);

        return view('backend.layout.pages.all-meal', compact('allmeals','totalMeals','averageMealRate'));
    }
    public function index(Request $request)
    {
        $user = Auth::user();

        if ($user->role !== 'manager') {
            return redirect()->back()->with('error', 'You are not authorized to view this page');
        }

        // Fetch members managed by this manager, including the manager
        $users = $user->managedMembers()->get()->prepend($user);

        // Get the selected date from the request, default to today
        $selectedDate = $request->input('date', now()->format('Y-m-d'));

        // Fetch meal data for the selected date
        $meals = Meal::where('date', $selectedDate)
            ->whereIn('user_id', $users->pluck('id'))
            ->get()
            ->keyBy('user_id');

        // Calculate total meals and average meal rate
        $totalMeals = $meals->sum('meal_count');
        $totalMembers = $users->count();
        $averageMealRate = $totalMembers > 0 ? ($totalMeals / $totalMembers) * 100 : 0;
        $averageMealRate = round($averageMealRate, 2);

        return view('backend.layout.pages.meal', compact('users', 'meals', 'totalMeals', 'averageMealRate', 'selectedDate'));
    }
    // In your controller
    public function store(Request $request)
    {
        $date = $request->input('date');
        $meals = $request->input('meals');

        foreach ($meals as $userId => $mealData) {
            $mealCount = array_sum($mealData);

            Meal::updateOrCreate(
                [
                    'user_id' => $userId,
                    'date' => $date,
                ],
                [
                    'meal_count' => $mealCount,
                ]
            );
        }

        return redirect()->back();
    }

    public function getMealData(Request $request)
    {
        $request->validate([
            'date' => 'required|date'
        ]);

        $date = $request->date;

        $meals = Meal::where('date', $date)->get();

        return response()->json([
            'success' => true,
            'meals' => $meals
        ]);
    }
}
