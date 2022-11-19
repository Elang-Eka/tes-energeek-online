<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Candidate extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $primaryKey = "id";
    protected $fillable = [
        'name','job_id' , 'email', 'phone', 'year','created_by', 'updated_by', 'deleted_by'
    ];
    protected $dates = ['deleted_at'];
    public function job()
    {
        return $this->belongsTo(Job::class);
    }
    public function skill()
    {
        return $this->belongsToMany(Skill::class, 'set_skills','candidate_id','skill_id');
    }
}
