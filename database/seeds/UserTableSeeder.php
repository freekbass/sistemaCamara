<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

// comando para popular a tabela de menus:   php artisan db:seed --class=UserTableSeeder


        DB::table('users')->insert(
                [
                    'name' => 'Administrador',
                    'email' => 'wilson@teste.com',
                    'password' => '$2y$10$lqe5lUiA/Wkx0.1dlzveEu6DBwiMfhUVDWQ.GyaJLlaRHFyeuy4Te',
        ]);
    }

}
