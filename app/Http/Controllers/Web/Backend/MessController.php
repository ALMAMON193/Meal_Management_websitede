<?php

namespace App\Http\Controllers\web\Backend;

use App\Models\User;
use App\Models\Messe;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MessController extends Controller
{
    public function index()
    {
        return view('backend.layout.pages.create-mess');
    }

    public function storeMess(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'address' => ['nullable', 'string'],
        ]);

        $messe = Messe::create([
            'name' => $request->name,
            'address' => $request->address,
            'user_id' => Auth::id(),
            'messe_id' => Auth::id(),
        ]);

        return redirect()->route('mess.index')->with('success', 'Mess created successfully!');
    }
}
