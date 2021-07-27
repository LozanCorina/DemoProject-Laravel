<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Milestone extends Model
{
    use HasFactory;
    protected $table="demo_milestones";
    protected $fillable =['name', 'description', 'project_id','due_date'];
}
