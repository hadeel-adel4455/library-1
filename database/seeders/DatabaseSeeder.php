<?php
namespace Database\Seeders;
use App\Models\User;
use App\Models\Book;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
         // User::factory(10)->create([
         //   'name' => 'Test User',
         //   'email' => 'test@example.com',
        //]);

        Staff::create ([ 
          'name'=>'ali',
          'email'=>'ali2@gmail.com',
          'password'=>'12345678'
          ]);
    }
}
