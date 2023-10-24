<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Offer
 *
 * @property int $id
 * @property string $name
 * @property float $price
 * @property string|null $description
 * @property-read Collection|Lesson[] $courses
 * @property-read int|null $courses_count
 * @property-read Collection|Feature[] $features
 * @property-read int|null $features_count
 * @method static \Database\Factories\OfferFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Offer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Offer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Offer query()
 * @method static \Illuminate\Database\Eloquent\Builder|Offer whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offer whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offer wherePrice($value)
 */
class Offer extends Model
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
        'price',
        'description'

    ];

    /**
     * Get the trainings that belongs to the offer.
     *
     * @return HasMany
     */
    public function trainings(): HasMany
    {

        return $this->hasMany(Training::class);
    }

    /**
     * Get the Features that belongs to the offer.
     *
     * @return HasMany
     */
    public function features(): HasMany
    {
        return $this->hasMany(Feature::class);
    }
}
