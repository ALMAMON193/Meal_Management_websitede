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
    //create an constructor


    public function index()
    {
        $manager = auth()->user();
        
        // Check if the user is a manager
        if ($manager->role !== 'manager') {
            return redirect()->back()->with('error', 'You are not authorized to view this page');
        }
    
        // Get the authenticated user
        $authUser = User::where('id', Auth::id())->first();
    
        // Get the managed members and merge with the authenticated user
        $members = $manager->managedMembers()->get()->push($authUser);
    
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
        Member::create([
            'user_id' => $manager->id,
            'manager_id' => $manager->id,
            'member_code' => 'MEM-' . Str::upper(Str::random(6))
        ]);
        return redirect()->back()->with('success', 'Member added successfully');
    }
}
