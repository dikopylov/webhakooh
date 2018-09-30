<?php


namespace App\Http\Models\User;


use App\Http\Models\Role\RoleRepository;
use App\Http\Models\Role\RoleType;
use Illuminate\Database\Eloquent\Collection;

class UserRepository
{

    private $roleRepository;

    public function __construct(RoleRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;
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
        $user = User::create([
            'login' => $data['login'],
            'email' => $data['email'],
            'password' => \Hash::make($data['password']),
            'first_name' => $data['first_name'],
            'patronymic' => $data['patronymic'],
            'second_name' => $data['second_name'],
            'phone' => $data['phone'],
            'invitation_key' => session('invitation-key'),
        ]);

        $this->roleRepository->assignRole($user, RoleType::MANAGER);

        return $user;
    }
}