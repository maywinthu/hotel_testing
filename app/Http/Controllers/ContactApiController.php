<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "full_name"=>"required",
            "email"=>"required",
            "subject"=>"required",
            "message"=>"required"
        ]);

        $contact = Contact::create([
            "full_name"=>$request->full_name,
            "email"=>$request->email,
            "subject"=>$request->subject,
            "message"=>$request->message
           
        ]);
      
        Mail::to('marchmay@gmail.com')->send(new ContactMail($contact));
        return "Thanks for reaching out!";


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
