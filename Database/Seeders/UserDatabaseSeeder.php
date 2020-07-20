<?php

namespace Modules\User\Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Modules\User\Entities\User;

class UserDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        User::create([
            'email' => 'admin@example.org',
            'name' => 'admin',
            'password' => Hash::make('1234'),
            'email_verified_at' => Carbon::now()
        ]);

        factory(User::class, 200)->create();

        // $this->call("OthersTableSeeder");
    }
}
