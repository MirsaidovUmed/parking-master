<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        echo "\nStarting Role";
        $data = [
            ['name' => 'Administrator', 'guard_name' => 'web'],
            ['name' => 'Гость', 'guard_name' => 'web']
        ];

        foreach ($data as $row) {
            try {
                $model = new Role();
                $model->name = $row['name'];
                $model->guard_name = $row['guard_name'];
                if ($row['name'] == 'Administrator'){
                    $model->syncPermissions(Permission::all());
                } else {
                    $model->syncPermissions(1);
                }
                $model->save();
                echo "\nRole " . $model['name'] . ' - ' . $model['guard_name'] . ' Seeded!';
            } catch (\Exception $e) {
                echo $e->getMessage();
                echo "\nModule " . $model['name'] . ' Error';
            }
        }
        echo "\nRole Ended!\n";
    }
}
