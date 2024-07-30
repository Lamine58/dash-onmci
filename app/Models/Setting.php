<?php
    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Support\Str;

    class Setting extends Model
    {
        use HasFactory;

        /**
         * The primary key type.
         *
         * @var string
         */
        protected $keyType = 'string';

        /**
         * Indicates if the IDs are auto-incrementing.
         *
         * @var bool
         */
        public $incrementing = false;

        /**
         * The attributes that are mass assignable.
         *
         * @var array
         */
        protected $fillable = [
            'title', 'subtitle', 'image_1', 'image_2', 'image_3', 'image_4', 'image_mission',
            'email', 'phone', 'location', 'facebook', 'twitter', 'instagram',
            'youtube', 'linkedin'
        ];

        /**
         * Boot function from laravel.
         */
        protected static function boot()
        {
            parent::boot();

            static::creating(function ($model) {
                $model->{$model->getKeyName()} = Str::uuid()->toString();
            });
        }
    }
