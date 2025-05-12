<?php

namespace App\Http\Controllers\Web\Backend;


use App\Models\Mess;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class MemberController extends Controller
{
    public function index()
    {
        $manager = Auth::user();

        // শুধুমাত্র ম্যানেজার এক্সেস পাবে
        if ($manager->role !== 'manager') {
            return view('backend.layout.pages.messe');
        }

        // ম্যানেজারের মেস ডাটা লোড করা
        $mess = Mess::where('user_id', $manager->id)->first();

        if (!$mess) {
            return redirect()->route('mess.create')->with('info', 'অনুগ্রহ করে প্রথমে আপনার মেস তৈরি করুন');
        }

        // এই মেসের সকল মেম্বার লোড করা (ম্যানেজার সহ)
        $members = User::where('mess_id', $mess->id)
            ->where(function ($query) {
                $query->where('role', 'member')
                    ->orWhere('id', Auth::id()); // অথেন্টিকেটেড ইউজারকেও দেখাবে
            })
            ->get();

        // যে সকল ইউজার কোনো মেসে নেই তাদের লোড করা
        $availableUsers = User::whereNull('mess_id')
            ->where('role', '!=', 'manager')
            ->where('id', '!=', $manager->id)
            ->get();

        return view('backend.layout.pages.add-member', compact('members', 'manager', 'mess', 'availableUsers'));
    }

    public function addMember(Request $request)
    {
        $request->validate([
            'name' => ['required_without:user_id', 'string', 'max:255'],
            'email' => ['required_without:user_id', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required_without:user_id', 'confirmed', 'min:8'],
            'user_id' => ['nullable', 'exists:users,id']
        ]);

        $manager = Auth::user();
        $mess = Mess::where('user_id', $manager->id)->first();

        if ($request->has('user_id')) {
            // বিদ্যমান ইউজারকে মেসে যুক্ত করা
            $user = User::findOrFail($request->user_id);
            $user->update(['mess_id' => $mess->id]);

            return redirect()->back()->with('success', 'ইউজার সফলভাবে মেসে যুক্ত করা হয়েছে');
        } else {
            // নতুন মেম্বার তৈরি করা
            $member = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'member',
                'mess_id' => $mess->id,
            ]);

            return redirect()->back()->with('success', 'নতুন মেম্বার তৈরি করা হয়েছে এবং মেসে যুক্ত করা হয়েছে');
        }
    }
    public function editMember($id)
{
    $member = User::findOrFail($id);
    $manager = Auth::user();
    
    // Verify that the member belongs to the manager's mess
    $mess = Mess::where('user_id', $manager->id)->first();
    if (!$mess || $member->mess_id != $mess->id) {
        return response()->json(['error' => 'Unauthorized action'], 403);
    }

    return response()->json($member);
}

public function updateMember(Request $request, $id)
{
    $member = User::findOrFail($id);
    $manager = Auth::user();
    
    // Verify that the member belongs to the manager's mess
    $mess = Mess::where('user_id', $manager->id)->first();
    if (!$mess || $member->mess_id != $mess->id) {
        return response()->json(['success' => false, 'message' => 'Unauthorized action'], 403);
    }

    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email,'.$id,
        'password' => 'nullable|confirmed|min:8'
    ]);

    $updateData = [
        'name' => $request->name,
        'email' => $request->email,
    ];

    if ($request->password) {
        $updateData['password'] = Hash::make($request->password);
    }

    $member->update($updateData);

    return response()->json([
        'success' => true,
        'message' => 'সদস্য সফলভাবে আপডেট করা হয়েছে!'
    ]);
}
}
