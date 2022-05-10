<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    DB::table('users')->insert([
        [
        'id' => 3
        'name' => 'data3',
        'email' => 'ss@ss.com',
        'password' => '383838',
        'created_at' => new Datetime(),
        'updated_at' => new Datetime()
      ],
      [
        'id' => 4
        'name' => 'data3',
        'email' => 'ss@ss.com',
        'password' => '383838',
        'created_at' => new Datetime(),
        'updated_at' => new Datetime()
      ],
      [
        'id' => 5
        'name' => 'data3',
        'email' => 'ss@ss.com',
        'password' => '383838',
        'created_at' => new Datetime(),
        'updated_at' => new Datetime()
      ],
      [
        'id' => 6
        'name' => 'data3',
        'email' => 'ss@ss.com',
        'password' => '383838',
        'created_at' => new Datetime(),
        'updated_at' => new Datetime()
      ],
      [
        'id' => 7
        'name' => 'data3',
        'email' => 'ss@ss.com',
        'password' => '383838',
        'created_at' => new Datetime(),
        'updated_at' => new Datetime()
      ],

    ]);
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
    }

}
