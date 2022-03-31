<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'region',
        'province',
        'location'
    ];

    public $timestamps = false;

    public function candidates()
    {
        return $this->hasMany(Candidate::class);
    }

    public function presidents()
    {
        return $this->candidates()
            ->selectRaw('candidates.*, count(*) as count')
            ->where('position_id', Candidate::PRESIDENT)
            ->select(['position_id', 'location_id', 'entry_number', 'ballot_name', 'partylist_code']);
    }

    public function vice_presidents()
    {
        return $this->candidates()
            ->selectRaw('candidates.*, count(*) as count')
            ->where('position_id', Candidate::VICE_PRESIDENT)
            ->select(['position_id', 'location_id', 'entry_number', 'ballot_name', 'partylist_code']);
    }

    public function senators()
    {
        return $this->candidates()
            ->selectRaw('candidates.*, count(*) as count')
            ->where('position_id', Candidate::SENATOR)
            ->select(['position_id', 'location_id', 'entry_number', 'ballot_name', 'partylist_code']);
    }

    public function partylists()
    {
        return $this->candidates()
            ->selectRaw('candidates.*, count(*) as count')
            ->where('position_id', Candidate::PARTYLIST)
            ->select(['position_id', 'location_id', 'entry_number', 'ballot_name', 'partylist_code']);
    }

    public function representatives()
    {
        return $this->candidates()
            ->selectRaw('candidates.*, count(*) as count')
            ->where([
                'position_id', Candidate::REPRESENTATIVE,
                'location_id', $this->id
            ])
            ->select(['position_id', 'location_id', 'entry_number', 'ballot_name', 'partylist_code']);
    }

    public function mayors()
    {
        return $this->candidates()
            ->selectRaw('candidates.*, count(*) as count')
            ->where([
                'position_id', Candidate::MAYOR,
                'location_id', $this->id
            ])
            ->select(['position_id', 'location_id', 'entry_number', 'ballot_name', 'partylist_code']);
    }

    public function vice_mayors()
    {
        return $this->candidates()
            ->selectRaw('candidates.*, count(*) as count')
            ->where([
                'position_id', Candidate::VICE_MAYOR,
                'location_id', $this->id
            ])
            ->select(['position_id', 'location_id', 'entry_number', 'ballot_name', 'partylist_code']);
    }

    public function sanggunians()
    {
        return $this->candidates()
            ->selectRaw('candidates.*, count(*) as count')
            ->where([
                'position_id', Candidate::SANGGUNIAN,
                'location_id', $this->id
            ])
            ->select(['position_id', 'location_id', 'entry_number', 'ballot_name', 'partylist_code']);
    }
}
