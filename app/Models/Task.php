<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $table="demo_tasks";
    protected $fillable=['assignee', 'name','description','project_id','milestone_id','is_complete_yn',
    'start_date','end_date'];
    public function project(){
        return $this->belongsTo(Project::class);
    }
}
