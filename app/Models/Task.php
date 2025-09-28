<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title', 'description', 'project_id', 'assigned_to', 'status','deadline'
    ];

    public function project(){
        return $this->belongsTo(Project::class);
    }

    public function assignedUser(){
        return $this->belongsTo(User::class, 'assigned_to');
    }

    // Task status is just a string column now
    public function getStatusAttribute($value){
        return $value; // Could also map to labels/colors if needed
    }
}
