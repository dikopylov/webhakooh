<?php


namespace App\Http\Models\InvitationKey;

class InvitationKeyRepository
{
    /**
     * @param string $key
     * @return mixed
     */
    public function getIdByCode(string $key)
    {
        return InvitationKey::where('key', $key)->first()['id'];
    }

    /**
     * @return mixed
     */
    public function getUnusedKey()
    {
        return InvitationKey::first();
    }

    /**
     * @param $id
     * @return int
     */
    public function delete($id)
    {
        return InvitationKey::destroy($id);
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function create()
    {
        return InvitationKey::create([
            'key' => bin2hex(random_bytes(16)),
            'author_id' => \Auth::id(),
        ]);

    }
}