<?php

use Illuminate\Database\Seeder;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$u = new User;
        $u->name = "John";
        $u->email = "john@email.com";
        $u->password = "Johnspassword";
        $u->save();
        
        factory(User::class, 5)->create();
    }
}
