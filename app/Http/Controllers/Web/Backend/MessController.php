<?php

namespace App\Http\Controllers\web\Backend;


use App\Models\Mess;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MessController extends Controller
{
    public function index()
    {
       $mess = Mess::where('user_id', Auth::id())->first();
        return view('backend.layout.pages.create-mess', compact('mess'));
    }

    public function storeMess(Request $request)
    {
        // যাচাই করুন ব্যবহারকারীর ইতিমধ্যে একটি মেস আছে কিনা
        if (Auth::user()->mess_id) {
            return redirect()->back()->with('error', 'আপনি শুধুমাত্র একটি মেস তৈরি করতে পারবেন!');
        }

        // অনুরোধ যাচাই করুন
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'address' => ['nullable', 'string'],
        ]);

        // মেস তৈরি করুন
        $mess = Mess::create([
            'name' => $request->name,
            'address' => $request->address,
            'user_id' => Auth::id(),
        ]);

        // ব্যবহারকারীর mess_id আপডেট করুন
        Auth::user()->update(['mess_id' => $mess->id]);

        return redirect()->route('mess.index')->with('success', 'মেস সফলভাবে তৈরি হয়েছে!');
    }

    public function update(Request $request, $id)
    {
        // Find the mess by ID and ensure it belongs to the authenticated user
        $mess = Mess::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        // Validate the request
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'address' => ['nullable', 'string'],
        ]);

        // Update the mess
        $mess->update([
            'name' => $request->name,
            'address' => $request->address,
        ]);

        return redirect()->route('mess.index')->with('success', 'মেস সফলভাবে আপডেট হয়েছে!');
    }
}
