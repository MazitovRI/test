<?php

namespace Database\Seeders;

use App\Models\Setting\UserSetting;
use App\Models\User\User;
use Illuminate\Database\Seeder;


/**
 * Class UserTableSeeder
 *
 * @package Database\Seeders
 */
class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();

        $userData = [
            [
                'name' => 'Михаил Администратор',
                'password' => bcrypt('MQ3?=Ng#'),
                'email' => 'admin@example.com',
                'email_verified_at' => '22.12.2020 00:00:00'
            ],
            [
                'name' => 'Елена',
                'password' => bcrypt('MQ3?=Ng#'),
                'email' => 'admin2@example.com',
                'email_verified_at' => '22.12.2020 00:00:00'
            ],
        ];

        foreach ($userData as $data) {
            $user = User::create($data);
        }
    }
}