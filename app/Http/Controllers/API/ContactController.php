<?php

namespace App\Http\Controllers\API;

use App\Http\Models\Contact\ContactRepository;
use App\Http\Resources\Contact as ContactResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContactController extends Controller
{
    private $contactRepository;

    public function __construct(ContactRepository $contactRepository)
    {
        $this->contactRepository = $contactRepository;
    }

    /**
     * @return ContactResource
     */
    public function show()
    {
        return new ContactResource($this->contactRepository->get());
    }
}
