<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $table="demo_projects";
    protected $fillable =['name', 'description', 'project_lead', 'completed_date', 'status'];
    public function tasks(){
       return  $this->hasMany(Task::class, 'project_id');
    }
}
