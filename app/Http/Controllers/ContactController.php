<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    //fonction appelé à afficher la page contact
    public function index()
    {
        return view('contact');
    }
}
