<?php

use Illuminate\Database\Seeder;
use App\Users;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Users::create([
            'name'      => 'Jônathas Ribeiro',
            'email'     => 'jonathasribeiro@gmail.com',
            'password'  => Hash::make('1234'),
            'address'   => 'Mogi das Cruzes, SP',
            'phone'     => '1140028922'
        ]);
    }
}
