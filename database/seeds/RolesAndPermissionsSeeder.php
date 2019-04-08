<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'درج و ویرایش تبلیغات']);
        Permission::create(['name' => 'تغییر لوگو']);
        Permission::create(['name' => 'درج و ویرایش اسلاید']);
        Permission::create(['name' => 'درج و ویرایش منو و دسته بندی']);
        Permission::create(['name' => 'ثبت و ویرایش محصول']);
        Permission::create(['name' => 'بررسی نظرات']);
        Permission::create(['name' => 'ویرایش کاربران']);
        Permission::create(['name' => 'گزارش های غیر مالی']);
        Permission::create(['name' => 'گزارش های مالی']);
        Permission::create(['name' => 'امور مالی']);
        Permission::create(['name' => 'احراز هویت کاربران']);

        // create roles and assign created permissions
        $role = Role::create(['name' => 'سوپر ادمین']);
        $role->givePermissionTo(Permission::all());
    }
}
