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
    public function index(Request $request)
    {
        $user = Auth::user();

        // Check if the user is a manager
        if (!$user->isManager()) {
            return redirect()->back()->with('error', 'You are not authorized to view this page');
        }

        // Get all messes owned by this manager
        $messes = $user->ownedMesses;

        // Get all user IDs associated with these messes (including the manager)
        $memberIds = $messes->flatMap(function ($mess) {
            return $mess->users->pluck('id');
        })->unique()->push($user->id);

        // Get the members (users) including the manager
        $members = User::whereIn('id', $memberIds)->get();

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
    DB::beginTransaction();
    
    try {
        // Validate request data
        $validated = $request->validate([
            'date' => 'required|date|before_or_equal:today',
            'meals' => 'required|array',
            'meals.*' => 'array:0,1,2', // Ensures structure: [breakfast, lunch, dinner]
            'meals.*.*' => 'nullable|numeric|min:0|max:9',
        ]);

        $date = $validated['date'];
        $savedMeals = [];

        foreach ($validated['meals'] as $userId => $meals) {
            // Get the user with their mess relationship
            $user = User::with('mess')->findOrFail($userId);
            
            // Verify user belongs to a mess
            if (!$user->mess_id) {
                throw new Exception("User {$userId} is not assigned to any mess");
            }

            $meal = Meal::updateOrCreate(
                ['user_id' => $userId, 'date' => $date],
                [
                    'mess_id' => $user->mess_id, // Critical - provide mess_id
                    'breakfast' => $meals[0] ?? 0,
                    'lunch' => $meals[1] ?? 0,
                    'dinner' => $meals[2] ?? 0
                ]
            );

            $savedMeals[] = $meal;
        }

        DB::commit();

        return response()->json([
            'success' => true,
            'message' => 'ডাটা সফলভাবে সংরক্ষিত হয়েছে!',
            'meals' => $savedMeals
        ]);

    } catch (Exception $e) {
        DB::rollBack();
        Log::error('Meal save error: ' . $e->getMessage());
        
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

        $meals = Meal::where('date', $date)->get();

        return response()->json([
            'success' => true,
            'meals' => $meals
        ]);
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
