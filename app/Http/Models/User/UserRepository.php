<?php


namespace App\Http\Models\User;


use App\Http\AuthSession;
use App\Http\Models\InvitationKey\InvitationKeyRepository;
use App\Http\Models\Role\RoleRepository;
use App\Http\Models\Role\RoleType;
use Illuminate\Database\Eloquent\Collection;

class UserRepository
{
    /**
     * @var RoleRepository
     */
    private $roleRepository;

    /**
     * @var InvitationKeyRepository
     */
    private $invitationKeyRepository;

    public function __construct(RoleRepository $roleRepository, InvitationKeyRepository $invitationKeyRepository)
    {
        $this->roleRepository = $roleRepository;
        $this->invitationKeyRepository = $invitationKeyRepository;
    }

    /**
     * @param int $id
     * @return Collection
     */
    public function getAllWithoutUser(int $id) : Collection
    {
        return User::where('is_delete', false)->where('id', '<>', $id)->get();
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function findOrFail(int $id)
    {
        return User::findOrFail($id);
    }

    /**
     * @TODO Class 'SplEnum' not found 57 str
     * @param array $data
     * @return User
     */
    public function create(array $data)
    {
        $inviteKeyId = $this->invitationKeyRepository->getIdByCode($data['invitation-key']);

        $user = User::create([
            'login' => $data['login'],
            'email' => $data['email'],
            'password' => \Hash::make($data['password']),
            'first_name' => $data['first_name'],
            'patronymic' => $data['patronymic'],
            'second_name' => $data['second_name'],
            'phone' => $data['phone'],
            'invitation_key_id' => $inviteKeyId,
        ]);

        $this->invitationKeyRepository->setKeyIsUsed($data['invitation-key']);
        $this->roleRepository->assignRole($user, RoleType::MANAGER);

        return $user;
    }
}