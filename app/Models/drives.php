<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class drives extends Model
{
    use HasFactory;
    protected $table ="drives";
    protected $fillable =["tittle","description","file","status","userid"];
}
