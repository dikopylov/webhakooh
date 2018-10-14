<?php

namespace Tests\Unit\Http\Controllers\Auth;

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Models\InvitationKey\InvitationKeyRepository;
use App\Http\Models\User\UserRepository;
use Illuminate\Http\Request;
use Prophecy\Argument;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegisterControllerTest extends TestCase
{
    public function testRegister_hasValideRequestData_callUserRepositoryWithThisData() : void
    {
        $data = [1,2,3];
        $request = $this->prophesize(Request::class);
        $request->all()->willReturn([
            'login' => 'test321',
            'email' => 'test@mail.ru',
            'password' => 'qwerty123',
            'first_name' => 'testovich',
            'patronymic' => 'testovich',
            'second_name' => 'testovich',
            'phone' => '8902276',
        ]);
        $invitationKeyRepository = $this->prophesize(InvitationKeyRepository::class);
        $userRepository = $this->prophesize(UserRepository::class);
        $userRepository->create(Argument::is($data))->shouldBeCalled();


        (new RegisterController($invitationKeyRepository->reveal(), $userRepository->reveal()))->register($request->reveal());
    }
}
