<?php

use Illuminate\Database\Seeder;
use App\User;
class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->name = "Administrator";
        $user->cpf = "99999999999";
        $user->email = "admin@admin.com";
        $user->password = bcrypt("admin");
        $user->admin = 1;
        $user->branch_id = 1;
        $user->save();
    }
}
