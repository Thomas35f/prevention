<?php

namespace App\Models;

use Database\Factories\CriterionFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Carbon;

/**
 * App\Models\Criterion
 *
 * @property int $criterion_id
 * @property string $text
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection|Grid[] $grids
 * @property-read int|null $grids_count
 * @property-read Collection|Theme[] $themes
 * @property-read int|null $themes_count
 * @method static CriterionFactory factory(...$parameters)
 * @method static Builder|Criterion newModelQuery()
 * @method static Builder|Criterion newQuery()
 * @method static Builder|Criterion query()
 * @method static Builder|Criterion whereCriterionId($value)
 * @method static Builder|Criterion whereText($value)
 * @method static Builder|Criterion whereCreatedAt($value)
 * @method static Builder|Criterion whereUpdatedAt($value)
 */
class Criterion extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'label',
    ];

    /**
     * The grids that belong to the criterion.
     *
     * @return BelongsToMany
     */
    public function grids(): BelongsToMany
    {
        return $this->belongsToMany(Grid::class, 'grid_criterion', 'criterion_id', 'grid_id');
    }

    /**
     * The themes that belong to the criterion.
     *
     * @return BelongsToMany
     */
    public function themes(): BelongsToMany
    {
        return $this->belongsToMany(Theme::class, 'criterion_theme', 'criterion_id', 'theme_id');
    }
}
