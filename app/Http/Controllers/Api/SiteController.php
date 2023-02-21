<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Site;
use App\Models\User;
use App\Traits\HttpResponses;
use Illuminate\Support\Facades\Auth;

class SiteController extends Controller
{
    use HttpResponses;
    public function fetchSites(){
        $sites = User::with('sites')->find(Auth::id());
        return response()->json($sites);
    }
}
