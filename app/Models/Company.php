<?php

namespace App\Models;

use Database\Factories\CompanyFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Str;

/**
 * App\Models\Company
 *
 * @property int $id
 * @property string $name
 * @property string|null $contact
 * @property-read Collection|User[] $users
 * @property-read int|null $users_count
 * @method static CompanyFactory factory(...$parameters)
 * @method static Builder|Company newModelQuery()
 * @method static Builder|Company newQuery()
 * @method static Builder|Company query()
 * @method static Builder|Company whereContact($value)
 * @method static Builder|Company whereId($value)
 * @method static Builder|Company whereName($value)
 * @property string|null $address
 * @property string|null $zip_code
 * @property string|null $town
 * @method static Builder|Company whereAddress($value)
 * @method static Builder|Company whereTown($value)
 * @method static Builder|Company whereZipCode($value)
 */
class Company extends InheritedModel
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
        'address_line_1',
        'address_line_2',
        'zip_code',
        'town',
        'contact',
    ];
}
