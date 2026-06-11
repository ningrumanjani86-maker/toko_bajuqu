<?php

namespace Database\Seeders;
use App\Models\User;
use Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //membuat 1 akun admin
        User::create([
            'name'=>'Admin toko_bajuqu',
            'email'=>'surysunshinee521@gmail.com',
            'password'=>Hash::make('beautifulMe20'),
        ]);
    }
}
