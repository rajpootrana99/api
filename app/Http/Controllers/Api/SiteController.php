<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Site;
use App\Traits\HttpResponses;
use Illuminate\Support\Facades\Auth;

class SiteController extends Controller
{
    use HttpResponses;
    public function fetchSites(){
        $sites = Site::where('user_id', Auth::id())->get();
        return response()->json($sites);
    }
}
