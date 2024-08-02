<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Event extends Model
{
    /**
     * The "booted" method of the model.
     *
     * @return void
     */


    use HasFactory;
    public $incrementing = false;
    protected $keyType = 'string';

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

    public function medias()
    {
        return $this->hasMany(Media::class,'data_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
