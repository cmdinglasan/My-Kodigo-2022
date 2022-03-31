<?php

namespace App\Http\Controllers\Api;

use App\Models\Position;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\PositionResource;

class PositionController extends Controller
{
    public function index(Request $request)
    {
        $positions = PositionResource::collection(Position::all());

        if($request->input('arrayOnly') == 'true') {
            $positions = $positions->map(function($position) {
                return $position->name;
            });
        }

        return response()->json([
            'positions' => $positions
        ]);
    }
}
