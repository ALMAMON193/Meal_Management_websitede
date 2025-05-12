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
<<<<<<< HEAD
    public function allIndex(Request $request)
{
    // Get selected month and year from request or use current month/year
    $selectedMonth = $request->input('month', now()->month);
    $selectedYear = $request->input('year', now()->year);

    // Create date object for the selected month
    $selectedDate = Carbon::createFromDate($selectedYear, $selectedMonth, 1);

    // Get all meals for the selected month
    $allmeals = Meal::whereYear('date', $selectedYear)
                  ->whereMonth('date', $selectedMonth)
                  ->orderBy('date', 'asc')
                  ->get();

    // Total meal this month
    $totalMeals = $allmeals->sum('meal_count');

    // Total members excluding managers
    $totalMembers = User::where('role', '!=', 'manager')->count();

    // Calculate average meal rate
    $averageMealRate = $totalMembers > 0 ? ($totalMeals / $totalMembers) * 100 : 0;
    $averageMealRate = round($averageMealRate, 2);

    // Get all users for showing in chart
    $users = User::where('role', '!=', 'manager')->get();

    // Calculate meal counts per user for the selected month
    $userMealCounts = [];
    foreach ($users as $user) {
        $userMeals = Meal::whereYear('date', $selectedYear)
                      ->whereMonth('date', $selectedMonth)
                      ->where('user_id', $user->id)
                      ->sum('meal_count');

        $userMealCounts[] = [
            'name' => $user->name,
            'meals' => $userMeals
        ];
    }

    // For date filtering and limits
    $currentMonth = now()->month;
    $currentYear = now()->year;
    $maxDate = Carbon::now()->format('Y-m-d');

    return view('backend.layout.pages.all-meal', compact(
        'allmeals',
        'totalMeals',
        'averageMealRate',
        'selectedMonth',
        'selectedYear',
        'currentMonth',
        'currentYear',
        'maxDate',
        'userMealCounts'
    ));
}
=======


>>>>>>> 90a3b70c5a23fbe29cd509bded00a588c0f43132
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
        $request->validate([
            'date' => 'required|date'
        ]);

        $date = $request->date;

<<<<<<< HEAD
        $meals = Meal::where('date', $date)->get();

        return response()->json([
            'success' => true,
            'meals' => $meals
        ]);
=======
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
>>>>>>> 90a3b70c5a23fbe29cd509bded00a588c0f43132
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
