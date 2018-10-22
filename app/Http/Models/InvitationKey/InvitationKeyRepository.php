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
        return InvitationKey::where('key', $key)->where('is_used', false)->first()['id'];
    }

    public function getInvitationById(int $id)
    {
        return InvitationKey::find($id)->where('is_used', false)->first();
    }

    public function getFirst(string $key)
    {
        return InvitationKey::where('key', $key)->first();
    }

    public function getUnusedKey()
    {
        return InvitationKey::where('is_used', false)->first();
    }

    public function setKeyIsUsed($key)
    {
        if($invitationKey = $this->getFirst($key))
        {
            $invitationKey->is_used = 1;
            $invitationKey->save();

            return true;
        }
        else
        {
            return false;
        }

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
            'is_delete' => false,
            'is_used' => false
        ]);

    }
}