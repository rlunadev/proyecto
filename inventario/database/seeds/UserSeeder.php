<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\User;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class,10)->create();
    }
}

// DB::table('users')->insert([
        //  'name'=>str_random(10),
        //  'email'=>str_random(10).'@luna.com',
        //  'password'=>bcrypt('secret')
        //  ]);