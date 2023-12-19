<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactRenewalLetter;
use Auth;
class ContactRenewalLetterController extends Controller
{
    public function index(){
     $contact_renewal = ContactRenewalLetter::where('contact_renewal_letter_com_id',Auth::user()->com_id)->get();
     return view('back-end.premium.core-hr.contact-renewal.index', get_defined_vars());
    }
}