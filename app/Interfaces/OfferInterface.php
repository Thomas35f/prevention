<?php

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Collection;

interface OfferInterface
{
    public function getAllOffers(): Collection;

}
