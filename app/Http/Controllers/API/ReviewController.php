<?php

namespace App\Http\Controllers\API;

use App\Http\Models\Client\ClientRepository;
use App\Http\Models\Clients\Client;
use App\Http\Models\Review\Review;
use App\Http\Models\Review\ReviewRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReviewController extends Controller
{
    /**
     * @var ReviewRepository
     */
    private $reviewRepository;

    /**
     * @var ClientRepository
     */
    private $clientRepository;

    public function __construct(ReviewRepository $reviewRepository, ClientRepository $clientRepository)
    {
        $this->reviewRepository = $reviewRepository;
        $this->clientRepository = $clientRepository;
    }

    /**
     * @param Request $request
     * @param Review $review
     * @return array
     */
    public function store(Request $request, Review $review): array
    {
        $chatId = (int) $request['chatId'];
        $client = $this->clientRepository->findByChatId($chatId) ?: new Client(['chat_id' => $chatId]);
        $client->name    = $request['clientName'];
        $client->phone   = $request['phone'];
        $this->clientRepository->save($client);
        $review->client_id = $client->id;
        $review->content = $request['content'];

        return ['success' => $this->reviewRepository->save($review)];
    }
}
