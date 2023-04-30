<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'add:permission';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add Permission';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $permissions = [
            ['name' => 'Manage Users'],
            ['name' => 'Create Site'],
            ['name' => 'Update Site'],
            ['name' => 'View Site'],
            ['name' => 'Delete Site'],
            ['name' => 'Manage Site'],
            ['name' => 'Create User Site'],
            ['name' => 'Update User Site'],
            ['name' => 'View User Site'],
            ['name' => 'Delete User Site'],
            ['name' => 'Manage User Site'],
            ['name' => 'Manage Task'],
            ['name' => 'Manage Entity'],
            ['name' => 'Create Entity'],
            ['name' => 'Update Entity'],
            ['name' => 'View Entity'],
            ['name' => 'Delete Entity'],
            ['name' => 'Manage Contact'],
            ['name' => 'Create Contact'],
            ['name' => 'Update Contact'],
            ['name' => 'View Contact'],
            ['name' => 'Delete Contact'],
            ['name' => 'Manage Chat'],
            ['name' => 'Manage Notification'],
            ['name' => 'Create Notification'],
        ];
        foreach ($permissions as $permission) {
            Permission::updateOrCreate(['name' => $permission['name']], $permission);
        }
        $role = Role::where('name', 'Admin')->first();
        $role->givePermissionTo(Permission::all());
        $this->info('Permissions successfully created!');
    }
}
