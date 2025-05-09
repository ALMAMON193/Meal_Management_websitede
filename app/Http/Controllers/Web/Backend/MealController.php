<?php

namespace App\Http\Controllers\Web\Backend;

use Carbon\Carbon;
use App\Models\Meal;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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
        try {
            $date = $request->query('date', now()->toDateString());
            $user = Auth::user();

            if ($user->role !== 'manager') {
                return response()->json(['error' => 'Unauthorized'], 403);
            }

            $members = User::where('role', '!=', 'manager')->get();
            $meals = Meal::where('date', $date)->get()->keyBy('user_id');

            $totalMeals = $meals->sum('meal_count');
            $presentCount = $meals->count();
            $totalMembers = $members->count();
            $absentCount = $totalMembers - $presentCount;
            $averageMealRate = $totalMembers > 0 ? ($presentCount / $totalMembers) * 100 : 0;

            return response()->json([
                'totalMeals' => $totalMeals,
                'averageMealRate' => round($averageMealRate, 2),
                'totalMembers' => $totalMembers,
                'presentCount' => $presentCount,
                'absentCount' => $absentCount,
                'members' => $members->map(function ($member) {
                    return ['id' => $member->id, 'name' => $member->name];
                })->toArray(),
                'meals' => $meals->mapWithKeys(function ($meal, $userId) {
                    return [$userId => [
                        'meal_count' => $meal->meal_count,
                        'breakfast' => $meal->breakfast,
                        'lunch' => $meal->lunch,
                        'dinner' => $meal->dinner
                    ]];
                })->toArray()
            ], 200);
        } catch (\Exception $e) {
            Log::error('Error in meals.data: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to load meal data'], 500);
        }
    }
}
