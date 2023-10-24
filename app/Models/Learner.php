<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Str;
use OpenApi\Annotations as OA;

/**
 *  App\Models\Lesson
 *
 * @OA\Schema (
 *      schema="Learner",
 *      required={"mail", "subclient_id"},
 *
 *      @OA\Property(
 *          property="lastname",
 *          description="trainer's lastname"
 *      ),
 *     @OA\Property(property="subclient_id", type="integer", description="Learner's enterprise", readOnly=true),
 *  ),
 *
 */
class Learner extends User
{
    use HasFactory;

    protected $with = ['user'];
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
     * The users that belong to the learner.
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The vehicle that the learner owns.
     */
    public function vehicle(): HasOne
    {
        return $this->hasOne(Vehicle::class);
    }

    /**
     * The subclient that belongs to the learner .
     */
    public function subclient(): BelongsTo
    {
        return $this->belongsTo(Subclient::class, 'subclient_id');
    }

    /**
     * The lessons that belongs to the learner .
     */
    public function lessons(): HasMany
    {
        return $this->hasMany(Lesson::class);
    }

}

