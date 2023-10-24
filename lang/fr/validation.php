<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Lignes de validation de la langue
    |--------------------------------------------------------------------------
    |
    | Les lignes de langue suivantes contiennent les messages d'erreur par défaut utilisés par
    | la classe de validateur. Certaines de ces règles ont plusieurs versions telles que
    | les règles de taille. N'hésitez pas à ajuster chacun de ces messages ici.
    |
    */

    'lastname' => 'Nom',
    'firstname' => 'Prénom',
    'phone' => 'Téléphone',
    'address' => 'Adresse',
    'zip_code' => 'Code postal',
    'town' => 'Ville',
    'confirm_password' => 'Confirmation du mot de passe',
    'already_registered' => 'Déjà enregistré ?',
    'register' => 'Enregistrer',


    'accepted' => ':attribut doit être accepté.',
    'accepted_if' => ':attribut doit être accepté lorsque :other est :value.',
    'active_url' => ':attribut n\'est pas une URL valide.',
    'after' => ':attribut doit être une date postérieure à :date.',
    'after_or_equal' => ':attribut doit être une date postérieure ou égale à :date.',
    'alpha' => ':attribut ne doit contenir que des lettres.',
    'alpha_dash' => ':attribut ne doit contenir que des lettres, des chiffres, des tirets et des underscores.',
    'alpha_num' => ':attribut ne doit contenir que des lettres et des chiffres.',
    'array' => ':attribut doit être un tableau.',
    'ascii' => ':attribut ne doit contenir que des caractères alphanumériques et des symboles à octet unique.',
    'before' => ':attribut doit être une date antérieure à :date.',
    'before_or_equal' => ':attribut doit être une date antérieure ou égale à :date.',
    'between' => [
        'array' => ':attribut doit avoir entre :min et :max éléments.',
        'file' => ':attribut doit être entre :min et :max kilo-octets.',
        'numeric' => ':attribut doit être compris entre :min et :max.',
        'string' => ':attribut doit avoir entre :min et :max caractères.',
    ],
    'boolean' => 'Le champ :attribute doit être vrai ou faux.',
    'confirmed' => 'La confirmation de :attribute ne correspond pas.',
    'current_password' => 'Le mot de passe est incorrect.',
    'date' => ':attribute n\'est pas une date valide.',
    'date_equals' => ':attribute doit être une date égale à :date.',
    'date_format' => ':attribute ne correspond pas au format :format.',
    'decimal' => ':attribute doit avoir :decimal décimales.',
    'declined' => ':attribute doit être refusé.',
    'declined_if' => ':attribute doit être refusé lorsque :other est :value.',
    'different' => ':attribute et :other doivent être différents.',
    'digits' => ':attribute doit être de :digits chiffres.',
    'digits_between' => ':attribute doit avoir entre :min et :max chiffres.',
    'dimensions' => 'Les dimensions de l\'image :attribute sont invalides.',
    'distinct' => 'Le champ :attribute a une valeur en double.',
    'doesnt_end_with' => ':attribute ne peut pas se terminer par l\'un des éléments suivants : :values.',
    'doesnt_start_with' => ':attribute ne peut pas commencer par l\'un des éléments suivants : :values.',
    'email' => 'L\'adresse email doit être une adresse email valide.',
    'ends_with' => ':attribute doit se terminer par l\'un des éléments suivants : :values.',
    'enum' => ':attribute sélectionné n\'est pas valide.',
    'exists' => ':attribute sélectionné n\'est pas valide.',
    'file' => ':attribute doit être un fichier.',
    'filled' => 'Le champ :attribute doit avoir une valeur.',
    'gt' => [
        'array' => ':attribute doit avoir plus de :value éléments.',
        'file' => ':attribute doit être supérieur à :value kilo-octets.',
        'numeric' => ':attribute doit être supérieur à :value.',
        'string' => ':attribute doit être supérieur à :value caractères.',
    ],
    'gte' => [
        'array' => ':attribute doit avoir au moins :value éléments.',
        'file' => ':attribute doit être supérieur ou égal à :value kilo-octets.',
        'numeric' => ':attribute doit être supérieur ou égal à :value.',
        'string' => ':attribute doit être supérieur ou égal à :value caractères.',
    ],
    'image' => ':attribute doit être une image.',
    'in' => ':attribute sélectionné n\'est pas valide.',
    'in_array' => 'Le champ :attribute n\'existe pas dans :other.',
    'integer' => ':attribute doit être un entier.',
    'ip' => ':attribute doit être une adresse IP valide.',
    'ipv4' => ':attribute doit être une adresse IPv4 valide.',
    'ipv6' => ':attribute doit être une adresse IPv6 valide.',
    'json' => ':attribute doit être une chaîne JSON valide.',
    'lowercase' => ':attribute doit être en minuscules.',
    'lt' => [
        'array' => ':attribute doit avoir moins de :value éléments.',
        'file' => ':attribute doit être inférieur à :value kilo-octets.',
        'numeric' => ':attribute doit être inférieur à :value.',
        'string' => ':attribute doit être inférieur à :value caractères.',
    ],
    'lte' => [
        'array' => ':attribute ne doit pas avoir plus de :value éléments.',
        'file' => ':attribute doit être inférieur ou égal à :value kilo-octets.',
        'numeric' => ':attribute doit être inférieur ou égal à :value.',
        'string' => ':attribute doit être inférieur ou égal à :value caractères.',
    ],
    'mac_address' => ':attribute doit être une adresse MAC valide.',
    'max' => [
        'array' => ':attribute ne doit pas avoir plus de :max éléments.',
        'file' => ':attribute ne doit pas être supérieur à :max kilo-octets.',
        'numeric' => ':attribute ne doit pas être supérieur à :max.',
        'string' => ':attribute ne doit pas être supérieur à :max caractères.',
    ],
    'max_digits' => ':attribute ne doit pas avoir plus de :max chiffres.',
    'mimes' => ':attribute doit être un fichier de type :values.',
    'mimetypes' => ':attribute doit être un fichier de type :values.',
    'min' => [
        'array' => ':attribute doit avoir au moins :min éléments.',
        'file' => ':attribute doit avoir au moins :min kilo-octets.',
        'numeric' => ':attribute doit avoir au moins :min.',
        'string' => ':attribute doit avoir au moins :min caractères.',
    ],
    'min_digits' => ':attribute doit avoir au moins :min chiffres.',
    'multiple_of' => ':attribute doit être un multiple de :value.',
    'not_in' => ':attribute sélectionné n\'est pas valide.',
    'not_regex' => 'Le format du :attribute est invalide.',
    'numeric' => ':attribute doit être un nombre.',
    'password' => [
        'letters' => 'Le mot de passe doit contenir au moins une lettre.',
        'mixed' => 'Le mot de passe doit contenir au moins une lettre majuscule et une lettre minuscule.',
        'numbers' => 'Le mot de passe doit contenir au moins un nombre.',
        'symbols' => 'Le mot de passe doit contenir au moins un symbole.',
        'uncompromised' => 'Le mot de passe fourni a été présent dans une fuite de données. Veuillez choisir un :attribute différent.',
    ],
    'present' => 'Le champ :attribute doit être présent.',
    'prohibited' => 'Le champ :attribute est interdit.',
    'prohibited_if' => 'Le champ :attribute est interdit lorsque :other est :value.',
    'prohibited_unless' => 'Le champ :attribute est interdit sauf si :other est présent dans :values.',
    'prohibits' => 'Le champ :attribute interdit la présence de :other.',
    'regex' => 'Le format du :attribute est invalide.',
    'required' => 'Le champ :attribute est requis.',
    'required_array_keys' => 'Le champ :attribute doit contenir des entrées pour :values.',
    'required_if' => 'Le champ :attribute est requis lorsque :other est :value.',
    'required_if_accepted' => 'Le champ :attribute est requis lorsque :other est accepté.',
    'required_unless' => 'Le champ :attribute est requis sauf si :other est présent dans :values.',
    'required_with' => 'Le champ :attribute est requis lorsque :values est présent.',
    'required_with_all' => 'Le champ :attribute est requis lorsque :values sont présents.',
    'required_without' => 'Le champ :attribute est requis lorsque :values n\'est pas présent.',
    'required_without_all' => 'Le champ :attribute est requis lorsque aucun de :values n\'est présent.',
    'same' => 'Le :attribute et :other doivent être identiques.',
    'size' => [
        'array' => ':attribute doit contenir :size éléments.',
        'file' => ':attribute doit être de :size kilobytes.',
        'numeric' => ':attribute doit être de :size.',
        'string' => ':attribute doit être de :size caractères.',
    ],
    'starts_with' => ':attribute doit commencer par l\'un des éléments suivants : :values.',
    'string' => ':attribute doit être une chaîne de caractères.',
    'timezone' => ':attribute doit être un fuseau horaire valide.',
    'unique' => ':attribute n\'est pas disponible',
    'uploaded' => ':attribute n\'a pas pu être téléchargé.',
    'uppercase' => ':attribute doit être en majuscules.',
    'url' => ':attribute doit être une URL valide.',
    'ulid' => ':attribute doit être un ULID valide.',
    'uuid' => ':attribute doit être un UUID valide.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [
        'lastname' => 'le nom',
        'firstname' => 'le prénom',
        'email' => 'l\'adresse email',
        'phone' => 'le téléphone',
        'address' => 'l\'adresse',
        'zip_code' => 'le code postal',
        'town' => 'la ville',
        'password' => 'le mot de passe',
        'confirm_password' => 'la confirmation du mot de passe',
        'already_registered' => 'déjà enregistré ?',
        'register' => 'enregistrer',
        'company_name' => 'le nom de la société',
        'training_name' => 'nom de la formation',
        'training_date' => 'date de formation',
        'subclient_id' => 'client',
        'grid_id' => 'grille',
        'center_id' => 'centre',
    ],

];
