<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class AccessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        echo "\nStarting Permissions";

        $data = [
            //Доступы для роли ГОСТЬ главный экран. --- ГОСТЬ
            ['name' => 'Главная страница', 'category' => 'Гость', 'guard_name' => 'web'],

            //Доступы для раздела Пользователи и роли. --- CRUD Пользователей
            ['name' => 'Просмотр пользователей', 'category' => 'Пользователь', 'guard_name' => 'web'],
            ['name' => 'Добавить пользователя', 'category' => 'Пользователь', 'guard_name' => 'web'],
            ['name' => 'Изменить пользователя', 'category' => 'Пользователь', 'guard_name' => 'web'],
            ['name' => 'Удалить пользователя', 'category' => 'Пользователь', 'guard_name' => 'web'],

            //Доступы для раздела История парковок
            ['name' => 'Просмотр истории парковок', 'category' => 'Парковка', 'guard_name' => 'web'],

            //Доступы для раздела Пользователи и роли. --- CRUD Ролы
            ['name' => 'Просмот ролей', 'category' => 'Роль', 'guard_name' => 'web'],
            ['name' => 'Добавить роль', 'category' => 'Роль', 'guard_name' => 'web'],
            ['name' => 'Изменить роль', 'category' => 'Роль', 'guard_name' => 'web'],
            ['name' => 'Удалить роль', 'category' => 'Роль', 'guard_name' => 'web'],

            //Доступы для раздела Пользователи и роли. --- CRUD Доступы
            ['name' => 'Просмотр доступы', 'category' => 'Доступ', 'guard_name' => 'web'],
            ['name' => 'Добавить доступ', 'category' => 'Доступ', 'guard_name' => 'web'],
            ['name' => 'Изменить доступ', 'category' => 'Доступ', 'guard_name' => 'web'],
            ['name' => 'Удалить доступ', 'category' => 'Доступ', 'guard_name' => 'web'],

            //Доступы для раздела Белый список.
            ['name' => 'Просмотр белый список', 'category' => 'Белый список', 'guard_name' => 'web'],
            ['name' => 'Добавить белый список', 'category' => 'Белый список', 'guard_name' => 'web'],
            ['name' => 'Редактировать белый список', 'category' => 'Белый список', 'guard_name' => 'web'],
            ['name' => 'Удалить белый список', 'category' => 'Белый список', 'guard_name' => 'web'],

            //Доступы для раздела Черный список.
            ['name' => 'Просмотр черный список', 'category' => 'Черный список', 'guard_name' => 'web'],
            ['name' => 'Добавить черный список', 'category' => 'Черный список', 'guard_name' => 'web'],
            ['name' => 'Редактировать черный список', 'category' => 'Черный список', 'guard_name' => 'web'],
            ['name' => 'Удалить черный список', 'category' => 'Черный список', 'guard_name' => 'web'],

            //Доступы для раздела Подписка. --- CRUD Доступы
            ['name' => 'Просмотр подписка', 'category' => 'Подписка', 'guard_name' => 'web'],
            ['name' => 'Добавить подписка', 'category' => 'Подписка', 'guard_name' => 'web'],
            ['name' => 'Изменить подписка', 'category' => 'Подписка', 'guard_name' => 'web'],
            ['name' => 'Удалить подписка', 'category' => 'Подписка', 'guard_name' => 'web'],
            //Доступы для под раздела История подписка.
            ['name' => 'История подписка', 'category' => 'Подписка', 'guard_name' => 'web'],

            //Доступы для раздела Тарифы. --- CRUD Доступы
            ['name' => 'Просмотр тариф', 'category' => 'Тариф', 'guard_name' => 'web'],
            ['name' => 'Создание тариф', 'category' => 'Тариф', 'guard_name' => 'web'],
            ['name' => 'Изменить тариф', 'category' => 'Тариф', 'guard_name' => 'web'],
            ['name' => 'Удалить тариф', 'category' => 'Тариф', 'guard_name' => 'web'],

            ['name' => 'Просмотр платежей', 'category' => 'Платежи', 'guard_name' => 'web'],

        ];

        foreach ($data as $row) {
            try {
                $model = new Permission();
                $model->name = $row['name'];
                $model->category = $row['category'];
                $model->guard_name = $row['guard_name'];
                $model->save();
                echo "\nPermissions " . $model['name'] . ' - ' . $model['guard_name'] . ' Seeded!';
            } catch (\Exception $e) {
                echo $e->getMessage();
                echo "\nModule " . $model['name'] . 'Error';
            }
        }
        echo "\nPermissions Ended!\n";
    }
}
