<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Vehicle
 *
 * @property int $id
 * @property string $name
 * @property string|null $brand
 * @property string|null $license_plate
 * @property string|null $type
 * @property int $user_id_Learner
 * @property-read Collection|Lesson[] $courses
 * @property-read int|null $courses_count
 * @method static \Database\Factories\VehicleFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle query()
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereBrand($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereLicensePlate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereType($value)
 * @property-read User|null $users
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereLearnerId($value)
 */
class Vehicle extends Model
{
    use HasFactory;
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'brand',
        'license_plate',
        'type',
        'learner_id'
    ];

    /**
     * Get the learner that the vehicle belongs to
     *
     * @return BelongsTo
     */
    public function learner(): BelongsTo
    {
        return $this->belongsTo(Learner::class);
    }
}
