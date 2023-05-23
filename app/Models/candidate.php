<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use mysql_xdevapi\Result;

class candidate extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'place',
    ];

    protected $primaryKey = 'candidate_id';

    public function electionDetail()
    {
        return $this->hasOne(ElectionDetail::class, 'candidate_id', 'candidate_id');
    }

    public function votes()
    {
        return $this->hasMany(Voting::class, 'candidate_id', 'candidate_id');
    }

    public function results()
    {
        return $this->hasOne(Results::class, 'candidate_id', 'candidate_id');
    }
}
