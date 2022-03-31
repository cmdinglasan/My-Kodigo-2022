<?php

namespace App\Http\Controllers\Api;

use App\Models\Location;
use App\Models\Candidate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class CandidateController extends Controller
{
    public function show (Request $request)
    {
        if($request->has('location')) {
            $location = Location::where('slug', $request->location)->first();

            $presidents = DB::table('candidates')
                ->select('position_id', 'entry_number', 'ballot_name', 'location_id', 'partylist_code')
                ->groupBy('position_id', 'entry_number', 'ballot_name', 'location_id', 'partylist_code')
                ->where('position_id', Candidate::PRESIDENT)
                ->get();

            $vicePresidents = DB::table('candidates')
                ->select('position_id', 'entry_number', 'ballot_name', 'location_id', 'partylist_code')
                ->groupBy('position_id', 'entry_number', 'ballot_name', 'location_id', 'partylist_code')
                ->where('position_id', Candidate::VICE_PRESIDENT)
                ->get();

            $senators = DB::table('candidates')
                ->select('position_id', 'entry_number', 'ballot_name', 'location_id', 'partylist_code')
                ->groupBy('position_id', 'entry_number', 'ballot_name', 'location_id', 'partylist_code')
                ->where('position_id', Candidate::SENATOR)
                ->get();

            $partylists = DB::table('candidates')
                ->select('position_id', 'entry_number', 'ballot_name', 'location_id', 'partylist_code')
                ->groupBy('position_id', 'entry_number', 'ballot_name', 'location_id', 'partylist_code')
                ->where('position_id', Candidate::PARTYLIST)
                ->get();

            $representatives = DB::table('candidates')
                ->select('position_id', 'entry_number', 'ballot_name', 'location_id', 'partylist_code')
                ->groupBy('position_id', 'entry_number', 'ballot_name', 'location_id', 'partylist_code')
                ->where('position_id', Candidate::REPRESENTATIVE)
                ->where('location_id', $location->id)
                ->get();

            $mayors = DB::table('candidates')
                ->select('position_id', 'entry_number', 'ballot_name', 'location_id', 'partylist_code')
                ->groupBy('position_id', 'entry_number', 'ballot_name', 'location_id', 'partylist_code')
                ->where('position_id', Candidate::MAYOR)
                ->where('location_id', $location->id)
                ->get();

            $viceMayors = DB::table('candidates')
                ->select('position_id', 'entry_number', 'ballot_name', 'location_id', 'partylist_code')
                ->groupBy('position_id', 'entry_number', 'ballot_name', 'location_id', 'partylist_code')
                ->where('position_id', Candidate::VICE_MAYOR)
                ->where('location_id', $location->id)
                ->get();

            $sanggunians = DB::table('candidates')
                ->select('position_id', 'entry_number', 'ballot_name', 'location_id', 'partylist_code')
                ->groupBy('position_id', 'entry_number', 'ballot_name', 'location_id', 'partylist_code')
                ->where('position_id', Candidate::SANGGUNIAN)
                ->where('location_id', $location->id)
                ->get();

            $candidates = collect([
                'presidents' => [
                    'slug' => 'president',
                    'title' => 'Presidents',
                    'description' => 'Vote for one (1) only',
                    'type' => 'radio',
                    'max_length' => '1',
                    'data' => $presidents,
                    'num_rows' => 3
                ],
                'vicePresidents' =>[
                    'slug' => 'vicePresident',
                    'title' => 'Vice Presidents',
                    'description' => 'Vote for one (1) only',
                    'type' => 'radio',
                    'max_length' => '1',
                    'data' => $vicePresidents,
                    'num_rows' => 3
                ],
                'senators' => [
                    'slug' => 'senators',
                    'title' => 'Senators',
                    'description' => 'Vote for twelve (12) only',
                    'type' => 'checkbox',
                    'max_length' => '12',
                    'data' => $senators,
                    'num_rows' => 16
                ],
                'representatives' => [
                    'slug' => 'representative',
                    'title' => 'Member, House of Representatives',
                    'description' => 'Vote for one (1) only',
                    'type' => 'radio',
                    'max_length' => '1',
                    'data' => $representatives,
                    'num_rows' => $representatives->count() > 4 ? round($representatives->count() / 4, 0) : 1
                ],
                'mayors' => [
                    'slug' => 'mayor',
                    'title' => 'Mayor',
                    'description' => 'Vote for one (1) only',
                    'type' => 'radio',
                    'max_length' => '1',
                    'data' => $mayors,
                    'num_rows' => $mayors->count() > 4 ? round($mayors->count() / 4, 0) : 1
                ],
                'viceMayors' => [
                    'slug' => 'viceMayor',
                    'title' => 'Vice Mayor',
                    'description' => 'Vote for one (1) only',
                    'type' => 'radio',
                    'max_length' => '1',
                    'data' => $viceMayors,
                    'num_rows' => $viceMayors->count() > 4 ? round($viceMayors->count() / 4, 0) : 1
                ],
                'sanggunians' => [
                    'slug' => 'sanggunians',
                    'title' => 'Member, Sangguniang Panlungsod',
                    'description' => 'Vote for six (6) only',
                    'type' => 'checkbox',
                    'max_length' => '6',
                    'data' => $sanggunians,
                    'num_rows' => $sanggunians->count() > 4 ? round($sanggunians->count() / 4, 0) : 1
                ],
                'partylists' => [
                    'slug' => 'partylist',
                    'title' => 'Party List',
                    'description' => 'Vote for one (1) only',
                    'type' => 'radio',
                    'max_length' => '1',
                    'data' => $partylists,
                    'num_rows' => 45
                ]
            ]);

            // $candidates = $candidates->mapWithKeys(function ($item) {
            //     return [$item['position_id'] => $item];
            // });

            // dd($candidates['presidents']->first()->entry_number);

            return view('voting.kodigo', [
                'candidates' => $candidates,
                'location' => $location,
            ]);
        } else {
            return Redirect::to('/');
        }
    }
}
