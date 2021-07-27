<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;
    protected $table="demo_team_members";
    protected $fillable=['username', 'full_name','email','profile','photo_filename','photo_blob'];
}
