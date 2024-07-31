<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Media extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $keyType = 'string';
    protected $table = 'medias';

    protected $guarded = [
        'created_at',
        'updated_at',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id = Str::uuid();
        });
    }

    public function getIconAttribute()
    {
        switch ($this->type) {
            case 'pdf':
                return 'fas fa-file-pdf';
            case 'video':
                return 'fas fa-file-video';
            case 'docx':
                return 'fas fa-file-word';
            default:
                return 'fas fa-file';
        }
    }

}