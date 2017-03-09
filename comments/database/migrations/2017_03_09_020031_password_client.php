<?php

use Illuminate\Database\Migrations\Migration;
use App\User;

class PasswordClient extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        DB::table('oauth_clients')->insert([
            'id' => 1,
            'password_client' => 1,
            'personal_access_client' => 0,
            'redirect' => '/',
            'secret' => '',
            'name' => "Password Grant Client",
            'revoked' => 0,
        ]);

        $user = new User();
        $user->email = 'rickshawhobo@gmail.com';
        $user->name = 'Guy Huynh';
        $user->password = bcrypt('secret');

        $user->save();

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        DB::table('users')->where('email', 'rickshawhobo@gmail.com')->delete();
        DB::table('oauth_clients')->where('id', 1)->delete();

    }
}
