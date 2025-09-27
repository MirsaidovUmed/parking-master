<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        echo "\nStarting Users Seeder";
        $data = [
            ['name'=>'root' , 'email'=>'root@mail.ru', 'password'=> bcrypt("root2025") ],
        ];
        foreach ($data as $row){
            try {
                $model = new User();
                $model->name = $row['name'];
                $model->username = $row['name'];
                $model->email = $row['email'];
                $model->email_verified_at = Carbon::now();
                $model->password =$row['password'];
                $model->created_by = 1;
                $model->assignRole('Administrator');
                $model->save();
                echo "\nSeeded ". $model->name. ' User';

            } catch (\Exception $e){
                echo "Seeding ". $row['name'] . ' Error:' .$e->getMessage();
            }
        }
        echo "\nUsers Seeder Ended\n";
    }
}
