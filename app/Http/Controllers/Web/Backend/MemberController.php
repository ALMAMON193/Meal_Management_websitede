<?php

namespace App\Http\Controllers\Web\Backend;

use App\Models\User;
use App\Models\Member;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class MemberController extends Controller
{

    public function index()
    {
        // Get the authenticated user (manager)
        $manager = Auth::user();
        //check if the ser is na manager and create an messe if the mess not create than create a messe
        if ($manager->role !== 'manager') {
            return view('backend.layout.pages.messe');
        }
        $members = User::all();
        // Pass members (including manager) to the view
        return view('backend.layout.pages.add-member', compact('members', 'manager'));
    
    }
    public function addMember(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);
        $manager = User::where('role', 'manager')->first();

        if (!$manager) {
            return redirect()->back()->with('error', 'No manager found');
        }
        $manager = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'member',
            'manager_id' => $manager->id
        ]);
        return redirect()->back()->with('success', 'Member added successfully');
    }
}
