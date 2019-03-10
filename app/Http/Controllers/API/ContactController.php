<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Models\Contact\ContactRepository;
use App\Http\Resources\ContactResource;

class ContactController extends Controller
{
    private $contactRepository;

    public function __construct(ContactRepository $contactRepository)
    {
        $this->contactRepository = $contactRepository;
    }

    /**
     * @return array
     */
    public function show()
    {
        return ['contact' => new ContactResource($this->contactRepository->get())];
    }
}
