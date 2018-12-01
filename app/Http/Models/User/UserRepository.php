<?php


namespace App\Http\Models\User;


use App\Http\AuthSession;
use App\Http\Models\InvitationKey\InvitationKeyRepository;
use App\Http\Models\Role\RoleRepository;
use App\Http\Models\Role\RoleType;
use Illuminate\Database\Eloquent\Collection;

class UserRepository
{
    const MAX_ITEMS_ON_ACTIVITY_LOG_PAGE = 3;

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
        $this->roleRepository          = $roleRepository;
        $this->invitationKeyRepository = $invitationKeyRepository;
    }

    /**
     * @param int $id
     *
     * @return Collection
     */
    public function getAll(int $id)
    {
        return User::where('id', '<>', $id)->paginate(self::MAX_ITEMS_ON_ACTIVITY_LOG_PAGE);
    }

    /**
     * @param int $id
     *
     * @return mixed
     */
    public function find(int $id)
    {
        return User::find($id);
    }

    /**
     * @param int    $id
     * @param string $password
     */
    public function updatePassword(int $id, string $password)
    {
        $user           = $this->find($id);
        $user->password = \Hash::make($password);;
        $user->save();
    }

    /**
     * @param int   $id
     *
     * @param array $data
     */
    public function updateProfile(int $id, array $data)
    {
        $user = $this->find($id);

        $user->email       = $data['email'];
        $user->first_name  = $data['first_name'];
        $user->patronymic  = $data['patronymic'];
        $user->second_name = $data['second_name'];
        $user->phone       = $data['phone'];

        $user->save();
    }

    /**
     * @param array $data
     *
     * @return User
     */
    public function create(array $data)
    {
        $inviteKeyId = $this->invitationKeyRepository->getIdByCode($data['invitation-key']);

        $user = User::create([
            'login'             => $data['login'],
            'email'             => $data['email'],
            'password'          => \Hash::make($data['password']),
            'first_name'        => $data['first_name'],
            'patronymic'        => $data['patronymic'],
            'second_name'       => $data['second_name'],
            'phone'             => $data['phone'],
            'invitation_key_id' => $inviteKeyId,
        ]);

        $this->invitationKeyRepository->delete($inviteKeyId);
        $this->roleRepository->assignRole($user, RoleType::MANAGER);

        return $user;
    }

    /**
     * @param $id
     *
     * @return int
     */
    public function delete($id)
    {
        return User::destroy($id);
    }
}