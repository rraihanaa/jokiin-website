<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProjectApplicant extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'project_id',
        'penjoki_id',
        'status',
        'message'
    ];

    public function penjoki(){
        return $this->belongsTo(User::class, 'penjoki_id');
    }

    public function project(){
        return $this->belongsTo(Project::class);
    }
}
