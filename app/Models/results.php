<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class results extends Model
{
    use HasFactory;

    protected $fillable = [
        'candidate_id',
        'total_votes',
    ];
    protected $primaryKey = 'results_id';

    public function candidate()
    {
        return $this->belongsTo(Candidate::class, 'candidate_id', 'candidate_id');
    }
}
