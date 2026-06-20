<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Silber\Bouncer\BouncerFacade;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::factory(1)->create(
            [
                'first_name' => 'Aruna',
                'last_name' => 'Bhusal',
                'email' => 'aruna@revonnaorganics.com',
                'email_verified_at' => null,
                'password' => bcrypt('adminadmin'),
            ]
        );

        BouncerFacade::assign('admin')->to($users->first());

        $others = User::factory(20)->create();
        foreach ($others as $model) {
            BouncerFacade::assign('regular')->to($model);
        }
    }
}
