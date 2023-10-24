<?php

namespace App\Models;

use Database\Factories\LessonFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

/**
 * App\Models\Lesson
 *
 * @property int $id
 * @property string|null $observation
 * @property string $name
 * @property int|null $seance_code
 * @property int $offer_id
 * @property int $center_id
 * @property int $trainer_id
 * @property int $user_id_trainer
 * @property int $user_id_learner
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Center|null $center
 * @property-read Collection|Criterion[] $criteria
 * @property-read int|null $criteria_count
 * @property-read User|null $learners
 * @property-read Offer|null $offers
 * @property-read User|null $trainers
 * @property-read Vehicle|null $vehicles
 * @method static LessonFactory factory(...$parameters)
 * @method static Builder|Lesson newModelQuery()
 * @method static Builder|Lesson newQuery()
 * @method static Builder|Lesson query()
 * @method static Builder|Lesson whereCenterId($value)
 * @method static Builder|Lesson whereCreatedAt($value)
 * @method static Builder|Lesson whereId($value)
 * @method static Builder|Lesson whereObservation($value)
 * @method static Builder|Lesson whereOfferId($value)
 * @method static Builder|Lesson whereSeanceCode($value)
 * @method static Builder|Lesson whereUpdatedAt($value)
 * @method static Builder|Lesson whereUserIdLearner($value)
 * @method static Builder|Lesson whereUserIdTrainer($value)
 * @method static Builder|Lesson whereVehicleId($value)
 * @property string $date
 * @property-read Collection|Lesson[] $courses
 * @property-read int|null $courses_count
 * @method static Builder|Training whereDate($value)
 */
class Training extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'center_id',
        'date',
        'seance_code'
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
     * The offer that the course has.
     *
     * @return BelongsTo
     */
    public function offer(): BelongsTo
    {
        return $this->belongsTo(Offer::class);
    }

    /**
     * The center that the training belongs to.
     *
     * @return BelongsTo
     */
    public function center(): BelongsTo
    {
        return $this->belongsTo(Center::class);
    }

    /**
     * The trainer that the training has.
     *
     * @return BelongsTo
     */
    public function trainer(): BelongsTo
    {
        return $this->belongsTo(Trainer::class);
    }

    /**
     * The lessons that belong to the training.
     *
     * @return HasMany
     */
    public function lessons(): HasMany
    {
        return $this->hasMany(Lesson::class);
    }

    /**
     * Get the subclients of learners associated with the training.
     *
     * @return Collection
     */
    public function subclients(): Collection
    {
        return $this->learners->map(function($learner) {
            return $learner->subclient;
        });
    }

    /**
     * Get the learners in training via the lessons.
     *
     * @return HasManyThrough
     */
    public function learners(): HasManyThrough
    {
        return $this->hasManyThrough(
            Learner::class,
            Lesson::class,
            'training_id', // Clé étrangère sur la table lessons
            'id', // Clé étrangère sur la table learners
            'id', // Clé principale pour la table trainings
            'learner_id' // Clé principale pour la table lessons
        );
    }

}
