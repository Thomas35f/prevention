<?php

namespace App\Http\Controllers;

use App\Interfaces\OfferInterface;
use App\Models\Offer;
use App\Repositories\OfferRepository;
use Illuminate\View\View;

class OfferController extends Controller
{

    private OfferInterface $offerRepository;

    public function __construct(OfferInterface $offerRepository)
    {
        $this->offerRepository = $offerRepository;
    }

    /**
     * Display the listing of the offers.
     *
     * @return View
     */
    public function index(): View
    {
        $offers = $this->offerRepository->getAllOffers();

        return view('offers')->with(
            ['offers' => $offers]);
    }
}
