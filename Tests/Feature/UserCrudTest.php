<?php

namespace Modules\User\Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Hash;
use Modules\User\Entities\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\WithFaker;

class UserCrudTest extends TestCase
{
    use WithoutMiddleware, WithFaker, DatabaseMigrations;

    protected $user;

    protected function setUp() : void {
        parent::setUp();

        $this->user = factory(User::class)->create();
    }

    /**
     * A basic feature test example.
     * @test
     *
     * @return void
     */
    public function user_can_create_user()
    {
        $user = factory(User::class)->make()->toArray();

        $user['password'] = Hash::make('12345678Aa');
        $user['password_confirmation'] = Hash::make('12345678Aa');

        $response = $this->actingAs($this->user)->post(route('user.store'), $user);

        $response->assertRedirect(route('user.index'));
    }

    /**
     * A basic feature test example.
     * @test
     *
     * @return void
     */
    public function user_cant_pass_validation()
    {
        $user = factory(User::class)->make()->toArray();

        $user['password'] = Hash::make('12345678Aa');
        $user['password_confirmation'] = Hash::make('43445');

        $response = $this->actingAs($this->user)->post(route('user.store'), $user);

        $response->assertStatus(302);
    }

    /**
     * A basic feature test example.
     * @test
     *
     * @return void
     */
    public function user_can_update_user()
    {
        $user = factory(User::class)->create()->toArray();

        $user['name'] = 'Testing';
        $user['password'] = Hash::make('12345678Aa');
        $user['password_confirmation'] = Hash::make('12345678Aa');
        $user['_method'] = 'put';

        $response = $this->actingAs($this->user)->post(route('user.update', ['user' => $user['id']]), $user);

        $response->assertRedirect(route('user.index'));
    }


}
