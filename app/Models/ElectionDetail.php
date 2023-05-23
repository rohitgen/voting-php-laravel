<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ElectionDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'candidate_id',
        'election_day_id',
    ];
    protected $primaryKey = 'election_details_id';

    public function electionDay()
    {
        return $this->belongsTo(ElectionDay::class, 'election_day_id', 'election_day_id');
    }

    public function candidate()
    {
        return $this->belongsTo(Candidate::class, 'candidate_id', 'candidate_id');
    }
}
