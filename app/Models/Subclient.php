<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Str;

/**
 * App\Models\Subclient
 *
 */
class Subclient extends Company
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'client_id',
    ];

    public $incrementing = false;
    protected $keyType = 'string';

    protected static function boot(): void
    {
        parent::boot();

        self::creating(function ($model) {
            if (!$model->getKey()) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }

    /**
     * The company that belong to the subclients.
     */
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    /**
     * The client that belong to the subclients.
     */
    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    /**
     * The learners that belong to the subclients.
     */
    public function learners(): HasMany
    {
        return $this->hasMany(Learner::class, 'subclient_id');
    }

    public static function __callStatic($method, $parameters)
    {
        $requestWords = Str::ucsplit($method);
        if ($requestWords == 3) {
            if ($requestWords[0] == 'where' && self::isModelExists($requestWords[1])) {
                $instance = new static;
                return $instance->newQuery()->where($requestWords[2], $parameters);
            }
        }
        return parent::__callStatic($method, $parameters);
    }

    protected static function isModelExists($modelName): bool
    {
        $modelNamespace = 'App\\Models\\'; // L'espace de noms des modèles

        // Forme le nom complet de la classe du modèle
        $fullClassName = $modelNamespace . $modelName;

        // Vérifie si la classe existe dans l'espace de noms donné
        return class_exists($fullClassName);
    }

}
