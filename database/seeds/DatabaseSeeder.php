<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        Model::unguard();

        $customer = ['ID' => 1,
            'Customer_name' => 'Admin',
            'Identify_number' => '025358154',
            'Phone' => '0932273448',
            'Email' => 'hovuanhkhoa@gmail.com',
            'Address' => 'HOME'
        ];

        $user = ['ID' => 1,
            'ID_CUSTOMER' => 1,
            'Username' => 'admin',
            'Password' => bcrypt('123456789Aa'),
            'ID_ROLE' => 1
        ];


        $roleUser = ['ID' => 2,
            'Role_name' => 'user'
        ];

        $roleAdmin = ['ID' => 1,
            'Role_name' => 'admin'
        ];

        DB::table('ROLES')->insert($roleAdmin);



        DB::table('ROLES')->insert($roleUser);

        DB::table('CUSTOMERS')->insert($customer);

        DB::table('users')->insert($user);

    }
}
