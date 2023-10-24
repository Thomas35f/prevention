<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class ContactController extends Controller
{

    /**
     * Display the contact view.
     *
     * @return View
     */
    public function create()
    {

        return view('contact');
    }
}
