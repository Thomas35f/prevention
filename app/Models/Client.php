<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * App\Models\Client
 *
 */
class Client extends Company
{
    use HasFactory;

    protected $fillable = ['company_id'];

    /**
     * The company that belong to the client.
     *
     * @return BelongsTo
     */
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    /**
     * The users that belong to the client.
     *
     * @return HasMany
     */
    public function subclients(): HasMany
    {
        return $this->hasMany(Subclient::class, 'client_id');
    }

    /**
     * The users that belong to the client.
     *
     * @return HasMany
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    /**
     * The centers that belong to the client.
     *
     * @return HasMany
     */
    public function centers(): HasMany
    {
        return $this->hasMany(Center::class);
    }

    /**
     * The grids that belong to the client.
     *
     * @return HasMany
     */
    public function grids(): HasMany
    {
        return $this->hasMany(Grid::class);
    }

}
