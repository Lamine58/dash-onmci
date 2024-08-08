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
        protected $guarded = [
            'created_at',
            'updated_at',
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

        public static function pages(){
            return [
                "qui-sommes-nous"=>["Qui sommes-nous?","about"],
                "missions"=>["Missions","mission"],
                "membres"=>["Membres","team"],
                "organigramme"=>["Organigramme","organigram"],
                "inscription"=>["Inscription","register"],
                "radiation"=>["Radiation","radiation"],
                "bonne-conduite"=>["Bonne conduite","good_behavior"],
                "consentement-eclaire"=>["Consentement éclairé","informed_consent"],
            ];
        }
        
    }
