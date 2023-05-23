<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ElectionDay extends Model
{
    use HasFactory;

    protected $table = 'election_day';

    protected $fillable = [
        'election_start_time',
        'election_end_time',
        'election_date',
    ];

    protected $primaryKey = 'election_day_id';

    public function electionDetails()
    {
        return $this->hasMany(ElectionDetail::class, 'election_day_id', 'election_day_id');
    }
}
