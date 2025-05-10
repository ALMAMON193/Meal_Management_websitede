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

    // MealController.php

   public function store(Request $request)
{
    $validated = $request->validate([
        'date' => 'required|date',
        'meals' => 'required|array',
        'meals.*.user_id' => 'required|exists:users,id',
        'meals.*.breakfast' => 'required|numeric|min:0',
        'meals.*.lunch' => 'required|numeric|min:0',
        'meals.*.dinner' => 'required|numeric|min:0',
    ]);

    foreach ($validated['meals'] as $mealData) {
        Meal::updateOrCreate(
            [
                'user_id' => $mealData['user_id'],
                'date' => $validated['date'],
            ],
            [
                'breakfast' => $mealData['breakfast'],
                'lunch' => $mealData['lunch'],
                'dinner' => $mealData['dinner'],
                'total' => $mealData['breakfast'] + $mealData['lunch'] + $mealData['dinner'],
            ]
        );
    }

    return back()->with('success', 'Meals saved successfully!');
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
