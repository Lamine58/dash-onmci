<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Media extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'type',
        'file_path',
        'file_name',
        'mime_type',
        'size',
    ];

    protected $keyType = 'string';
    public $incrementing = false;
}