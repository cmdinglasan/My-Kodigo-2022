<?php

namespace App\Http\Controllers\Api;

use App\Models\Location;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\LocationResource;

class LocationController extends Controller
{
    public function index(Request $reqest)
    {
        return LocationResource::collection(Location::all());
    }
}
