<?php

namespace App\Models;

use Database\Factories\LessonFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

/**
 * App\Models\Lesson
 *
 * @property int $id
 * @property string|null $observation
 * @property int|null $seance_code
 * @property int $offer_id
 * @property int $vehicle_id
 * @property int $center_id
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
 * @property int $training_id
 * @property-read Training|null $trainings
 * @method static Builder|Lesson whereTrainingId($value)
 */
class Lesson extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'observation',
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
     * Get the training that the course belongs to.
     *
     * @return BelongsTo
     */
    public function training(): BelongsTo
    {
        return $this->belongsTo(Training::class);
    }

    /**
     * Get the grid that the course belongs to.
     *
     * @return BelongsTo
     */
    public function grid(): BelongsTo
    {
        return $this->belongsTo(Grid::class);
    }

    /**
     * Get the learner that the course belongs to.
     *
     * @return BelongsTo
     */
    public function learner(): BelongsTo
    {
        return $this->belongsTo(Learner::class);
    }
}

