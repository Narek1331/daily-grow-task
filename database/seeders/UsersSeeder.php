<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'full_name' => 'Иван Иванов',
                'dob' => '22.02.99',
                'phone_number' => '79000010000',
            ],
            [
                'full_name' => 'Алексей Петров',
                'dob' => '23.02.99',
                'phone_number' => '79000010010',
            ],
            [
                'full_name' => 'Констанин Жаров',
                'dob' => '24.02.99',
                'phone_number' => '79000010020',
            ],
            [
                'full_name' => 'Максим Леонов',
                'dob' => '25.02.99',
                'phone_number' => '79000010030',
            ],
            [
                'full_name' => 'Денис Турушев',
                'dob' => '26.02.99',
                'phone_number' => '79005250538',
            ],
        ];

        // foreach ($users as $user) {
            DB::table('users')->insert($users);
        // }
    }
}
