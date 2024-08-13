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
                "conditions-remplacement"=>["Conditions de remplacement","conditions_remplacement"],
                "conditions-exercice"=>["Conditions d'exercice","conditions_exercice"],
                "histoire"=>["Historique",'histoire'],
                "nos-textes"=>["Nos textes",'textes'],
                "conseil-national"=>["Conseil national",'conseil_national'],
                "observatoire-medical"=>["Observatoire médical",'observatoire_medical'],
                "formulaire-validation"=>["Formulaire de pré validation",'formulaire_validation'],
                "bonne-conduite"=>["Bonne conduite",'bonne_conduite'],
                "consentement-eclaire"=>["Consentement éclaire",'consentement_eclaire'],
                "cycle-doctoral"=>["Le cycle doctoral & post doctoral","cycle_doctoral"],
                "conditions-remplacement-etudiant"=>["Les conditions pour effectuer un remplacement","conditions_remplacement_etudiant"],
                "associations-organisations"=>["Les associations & organisations d'étudiants","associations_organisations"],
            ];
        }
        
    }
