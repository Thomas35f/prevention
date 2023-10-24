<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Mockery\Exception;

class InheritedModel extends Model
{
    use HasFactory;

    public static function __callStatic($method, $parameters)
    {
        $requestWords = Str::ucsplit($method);
        if (count($requestWords) == 3 &&
            $requestWords[0] == 'where' &&
            self::isModelExists($requestWords[1]) ) {
                $instance = new static;
                $motherModel = Str::lower(Str::plural($requestWords[1]));
                try {
                    return $instance->newQuery()->join($motherModel, $motherModel.'.id', '=', $instance->getTable().'.'.Str::lower($requestWords[1]).'_id')->where($requestWords[2], $parameters[0]);
                } catch (Exception $e) {
                    Log::debug($e->getMessage());
                    return parent::__callStatic($method, $parameters);
                }
        }

        return parent::__callStatic($method, $parameters);
    }

    /**
     * Permet de vérifier que le second paramètre de $requestWords est bien une classe
     *
     * @param string $modelName
     * @return bool
     */
    protected static function isModelExists(string $modelName): bool
    {
        $modelNamespace = 'App\\Models\\'; // L'espace de noms des modèles

        // Forme le nom complet de la classe du modèle
        $fullClassName = $modelNamespace . $modelName;

        // Vérifie si la classe existe dans l'espace de noms donné
        return class_exists($fullClassName);
    }

}
