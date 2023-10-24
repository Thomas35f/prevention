<?php

namespace App\Repositories;

use App\Interfaces\OfferInterface;
use App\Models\Offer;
use Illuminate\Database\Eloquent\Collection;

class OfferRepository implements OfferInterface
{
    protected Offer $offer;

    public function __construct(Offer $offer)
    {
        $this->offer = $offer;
    }

    public function getAllOffers(): Collection
    {
        return $this->offer->all();
    }

}
