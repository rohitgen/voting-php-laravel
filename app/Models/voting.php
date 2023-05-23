<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class voting extends Model
{
    use HasFactory;

    protected $table = 'voting';
    protected $primaryKey = 'voting_id';
    protected $fillable = [
        'voter_id',
        'candidate_id',
    ];

    public function candidate()
    {
        return $this->belongsTo(Candidate::class, 'candidate_id', 'candidate_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'voter_id', 'voter_id');
    }
}
