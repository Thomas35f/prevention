<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

/**
 * App\Models\Center
 *
 * @property int $id
 * @property string $name
 * @property string|null $address
 * @property-read Collection|Lesson[] $courses
 * @property-read int|null $courses_count
 * @method static \Database\Factories\CenterFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Center newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Center newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Center query()
 * @method static \Illuminate\Database\Eloquent\Builder|Center whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Center whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Center whereName($value)
 */
class Center extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'address',
        'client_id'
    ];

    public $timestamps = false;
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
     * The trainings that belong to the center.
     *
     * @return HasMany
     */
    public function trainings(): HasMany
    {

        return $this->hasMany(Training::class);
    }

    /**
     * The client that belong to the center.
     *
     * @return BelongsTo
     */
    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }
}
