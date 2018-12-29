<?php

namespace App\Http\Controllers;

use App\Http\Models\Contact\Contact;
use App\Http\Models\Contact\ContactRepository;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    private $contactRepository;

    public function __construct(ContactRepository $contactRepository)
    {
        $this->contactRepository = $contactRepository;
    }

    /**
     * Display the specified resource.
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('contacts.show',
            [
                'contact' => $this->contactRepository->get(),
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        return view('contacts.edit',
            [
                'contact' => $this->contactRepository->get(),
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Http\Models\Contact\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contact $contact)
    {
        $this->contactRepository->deleteOld();
        $contact->address = $request['address'];
        $contact->phone   = $request['phone'];
        $this->contactRepository->save($contact);
        return $this->show();
    }
}
