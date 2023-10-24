<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * App\Models\Theme
 *
 * @property int $id
 * @property string $text
 * @property-read Collection|Criterion[] $criteria
 * @property-read int|null $criteria_count
 * @method static \Database\Factories\ThemeFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Theme newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Theme newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Theme query()
 * @method static \Illuminate\Database\Eloquent\Builder|Theme whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Theme whereText($value)
 */
class Theme extends Model
{
    use HasFactory;
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'label',
        'evaluation',
        'progress'
    ];

    /**
     * Get the Criteria that belongs to the Theme.
     *
     * @return BelongsToMany
     */
    public function criteria(): BelongsToMany
    {
        return $this->belongsToMany(Criterion::class, 'criterion_theme', 'theme_id', 'criterion_id');
    }

}
