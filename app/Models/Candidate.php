<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    use HasFactory;

    public const PRESIDENT = 1;
    public const VICE_PRESIDENT = 2;
    public const SENATOR = 3;
    public const PARTYLIST = 4;
    public const REPRESENTATIVE = 5;
    public const MAYOR = 6;
    public const VICE_MAYOR = 7;
    public const SANGGUNIAN = 8;

    protected $fillable = [
        'position_id',
        'entry_number',
        'ballot_name',
        'location_id',
        'partylist_code'
    ];

    public $timestamps = false;

    public function position()
    {
        return $this->belongsTo(Position::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function presidents()
    {
        return $this->selectRaw('candidates.*, locations.name as location_name')
            ->join('locations', 'locations.id', '=', 'candidates.location_id')
            ->where('candidates.position_id', self::PRESIDENT)
            ->orderBy('locations.name', 'asc');
    }
}
