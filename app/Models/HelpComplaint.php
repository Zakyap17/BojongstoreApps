<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HelpComplaint extends Model
{
    use HasFactory;

    protected $table = 'help_complaints';

    protected $fillable = [
        'name',
        'contact',
        'category',
        'message',
    ];
}
