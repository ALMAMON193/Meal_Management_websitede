<?php

namespace App\Http\Controllers\Web\frontend;

use Carbon\Carbon;
use App\Models\User;
use App\Models\MarketItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MarketItemController extends Controller
{

    public function index()
    {
        return view('frontend.layout.index');
    }
}
