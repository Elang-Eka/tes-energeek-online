<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Skill extends Model
{

    use HasFactory;
    use SoftDeletes;
    
    protected $primaryKey = "id";
    protected $fillable = [
        'name','created_by', 'updated_by', 'deleted_by'
    ];
    protected $dates = ['deleted_at'];
    public function candidate()
    {
        return $this->belongsToMany(Candidate::class, 'set_skills','skill_id','candidate_id');
    }
}
