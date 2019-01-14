<?php


namespace App\Http\Models\Client;

use App\Http\Models\Clients\Client;

class ClientRepository
{
    /**
     * @param string $chatId
     * @return Client|null
     */
    public function findByChatId(string $chatId) : ?Client
    {
        return Client::where('chat_id', $chatId)->first();
    }

    /**
     * @param Client $client
     * @return bool
     */
    public function save(Client $client): bool
    {
        return $client->save();
    }
}