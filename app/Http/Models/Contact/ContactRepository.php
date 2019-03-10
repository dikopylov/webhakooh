<?php

namespace App\Http\Models\Contact;

class ContactRepository
{
    /**
     * @return mixed
     */
    public function get()
    {
        return Contact::all()->first();
    }

    /**
     * @param Contact $contact
     * @return bool
     */
    public function save(Contact $contact)
    {
        return $contact->save();
    }

    /**
     * @return int
     */
    public function deleteOld()
    {
        return Contact::destroy($this->get()->id);
    }
}