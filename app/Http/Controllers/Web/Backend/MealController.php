<?php

namespace App\Http\Controllers\Web\Backend;

use Exception;
use Carbon\Carbon;
use App\Models\Meal;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MealController extends Controller
{


    public function index(Request $request)
    {
        $user = Auth::user();

        // Check if the user is a manager
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

        // Calculate total meals
        $totalMeals = $meals->sum(function ($meal) {
            return $meal->breakfast + $meal->lunch + $meal->dinner;
        });

        // Calculate attended members
        $attendedMembers = $meals->filter(function ($meal) {
            return $meal->breakfast > 0 || $meal->lunch > 0 || $meal->dinner > 0;
        })->count();

        // Calculate average meal rate
        $totalMembers = $members->count();
        $averageMealRate = $totalMembers > 0 ? ($attendedMembers / $totalMembers) * 100 : 0;

        return view('backend.layout.pages.meal', compact(
            'members',
            'meals',
            'totalMeals',
            'averageMealRate',
            'selectedDate',
            'attendedMembers',
            'totalMembers'
        ));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'date' => 'required|date|before_or_equal:today',
                'meals' => 'required|array',
                'meals.*.*' => 'nullable|numeric|min:0|max:9',
            ]);

            $date = $request->input('date');
            $savedMeals = [];

            foreach ($request->input('meals') as $userId => $meals) {
                $breakfast = isset($meals[0]) ? (float)$meals[0] : 0;
                $lunch = isset($meals[1]) ? (float)$meals[1] : 0;
                $dinner = isset($meals[2]) ? (float)$meals[2] : 0;

                $meal = Meal::updateOrCreate(
                    ['user_id' => $userId, 'date' => $date],
                    ['breakfast' => $breakfast, 'lunch' => $lunch, 'dinner' => $dinner]
                );

                $savedMeals[] = $meal;
            }

            return response()->json([
                'success' => true,
                'message' => 'ডাটা সফলভাবে সংরক্ষিত হয়েছে!',
                'meals' => $savedMeals
            ]);
        } catch (Exception $e) {
            Log::error('Error saving meal data: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'error' => 'ডাটা সংরক্ষণ করতে সমস্যা হয়েছে: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getMealData(Request $request)
    {
        try {
            $date = $request->query('date', now()->toDateString());
            $user = Auth::user();

            if ($user->role !== 'manager') {
                return response()->json(['error' => 'Unauthorized'], 403);
            }

            $members = $user->managedMembers()->get()->prepend($user);
            $meals = Meal::where('date', $date)
                ->whereIn('user_id', $members->pluck('id'))
                ->get()
                ->keyBy('user_id');

            $totalMeals = $meals->sum(function ($meal) {
                return $meal->breakfast + $meal->lunch + $meal->dinner;
            });

            $presentCount = $meals->filter(function ($meal) {
                return $meal->breakfast > 0 || $meal->lunch > 0 || $meal->dinner > 0;
            })->count();

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
                        'meal_count' => $meal->breakfast + $meal->lunch + $meal->dinner,
                        'breakfast' => $meal->breakfast,
                        'lunch' => $meal->lunch,
                        'dinner' => $meal->dinner
                    ]];
                })->toArray()
            ], 200);
        } catch (Exception $e) {
            Log::error('Error in meals.data: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to load meal data'], 500);
        }
    }
    // Updated methods for monthly/yearly data
   public function monthlyIndex(Request $request)
    {
        $selectedMonth = $request->input('month', now()->month);
        $year = now()->year;
        $members = User::all();

        $daysInMonth = Carbon::create($year, $selectedMonth)->daysInMonth;
        $days = [];
        $totalMeals = 0;
        $perUserMeals = [];

        foreach ($members as $member) {
            $perUserMeals[$member->id] = 0;
        }

        for ($day = 1; $day <= $daysInMonth; $day++) {
            $date = Carbon::create($year, $selectedMonth, $day)->toDateString();
            $meals = Meal::where('date', $date)->get()->keyBy('user_id');

            $days[$day] = $meals->map(function ($meal) use (&$totalMeals, &$perUserMeals) {
                $mealTotal = $meal->breakfast + $meal->lunch + $meal->dinner;
                $totalMeals += $mealTotal;
                $perUserMeals[$meal->user_id] = ($perUserMeals[$meal->user_id] ?? 0) + $mealTotal;
                return [
                    'breakfast' => $meal->breakfast,
                    'lunch' => $meal->lunch,
                    'dinner' => $meal->dinner,
                ];
            })->toArray();
        }

        $monthlyData = [
            'year' => $year,
            'days' => $days,
        ];

        return view('backend.layout.pages.all-meal', compact('members', 'monthlyData', 'selectedMonth', 'totalMeals', 'perUserMeals'));
    }

    public function getMonthlyData(Request $request)
    {
        $month = $request->input('month', now()->month);
        $year = now()->year;
        $members = User::all();

        $daysInMonth = Carbon::create($year, $month)->daysInMonth;
        $days = [];
        $totalMeals = 0;
        $perUserMeals = [];

        foreach ($members as $member) {
            $perUserMeals[$member->id] = 0;
        }

        for ($day = 1; $day <= $daysInMonth; $day++) {
            $date = Carbon::create($year, $month, $day)->toDateString();
            $meals = Meal::where('date', $date)->get()->keyBy('user_id');

            $days[$day] = $meals->map(function ($meal) use (&$totalMeals, &$perUserMeals) {
                $mealTotal = $meal->breakfast + $meal->lunch + $meal->dinner;
                $totalMeals += $mealTotal;
                $perUserMeals[$meal->user_id] = ($perUserMeals[$meal->user_id] ?? 0) + $mealTotal;
                return [
                    'breakfast' => $meal->breakfast,
                    'lunch' => $meal->lunch,
                    'dinner' => $meal->dinner,
                ];
            })->toArray();
        }

        return response()->json([
            'members' => $members->map(function ($member) {
                return [
                    'id' => $member->id,
                    'name' => $member->name,
                ];
            }),
            'days' => $days,
            'totalMeals' => $totalMeals,
            'perUserMeals' => $perUserMeals,
     ]);
    }

}
