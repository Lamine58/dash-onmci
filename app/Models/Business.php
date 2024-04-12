<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Business extends Model
{
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

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function departement()
    {
        return $this->belongsTo(Region::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function quizzes()
    {
        return $this->belongsToMany(Quizze::class);
    }

    public function business_category()
    {
        return $this->belongsToMany(Category::class);
    }

    public function business_quizze()
    {
        return $this->belongsToMany(Quizze::class);
    }

    public function value_chain()
    {
        return $this->belongsToMany(Quizze::class);
    }
    
}
