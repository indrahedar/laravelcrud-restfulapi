<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new \App\Models\User;
        $user->nama = "Annisa";
        $user->username = "indra";
        $user->password = Hash::make("indrahedar");
        $user->level = "Admin";
        $user->save();
    }
}
