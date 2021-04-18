<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::where('email','ahmad@123')->first();
        if(!$user){
            User::create([
               'name'=>'Ahmad Ali',
                'email'=>'ahmad@123',
                'role'=>'admin',
                'password'=>Hash::make('password')
            ]);
        }
    }
}
