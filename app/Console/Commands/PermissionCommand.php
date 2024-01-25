<?php

namespace App\Console\Commands;

use File;
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
            ['name' => 'Manage Task'],
            ['name' => 'Create Task'],
            ['name' => 'Update Task'],
            ['name' => 'View Task'],
            ['name' => 'Delete Task'],
            ['name' => 'Manage User'],
            ['name' => 'Create User'],
            ['name' => 'Update User'],
            ['name' => 'View User'],
            ['name' => 'Delete User'],
            ['name' => 'Manage Enquiry'],
            ['name' => 'Create Enquiry'],
            ['name' => 'Update Enquiry'],
            ['name' => 'View Enquiry'],
            ['name' => 'Delete Enquiry'],
            ['name' => 'Manage Entities'],
            ['name' => 'Create Entities'],
            ['name' => 'Update Entities'],
            ['name' => 'View Entities'],
            ['name' => 'Delete Entities'],
            ['name' => 'Manage Sites'],
            ['name' => 'Create Sites'],
            ['name' => 'Update Sites'],
            ['name' => 'View Sites'],
            ['name' => 'Delete Sites'],
            ['name' => 'Manage Explorer'],
            ['name' => 'Create Explorer'],
            ['name' => 'Update Explorer'],
            ['name' => 'View Explorer'],
            ['name' => 'Delete Explorer'],
            ['name' => 'Manage Jobs'],
            ['name' => 'Create Jobs'],
            ['name' => 'Update Jobs'],
            ['name' => 'View Jobs'],
            ['name' => 'Delete Jobs'],
            ['name' => 'Manage Budget'],
            ['name' => 'Create Budget'],
            ['name' => 'Update Budget'],
            ['name' => 'View Budget'],
            ['name' => 'Delete Budget'],
            ['name' => 'Manage Quote'],
            ['name' => 'Create Quote'],
            ['name' => 'Update Quote'],
            ['name' => 'View Quote'],
            ['name' => 'Delete Quote'],
            ['name' => 'Manage Invoice'],
            ['name' => 'Create Invoice'],
            ['name' => 'Update Invoice'],
            ['name' => 'View Invoice'],
            ['name' => 'Delete Invoice'],
            ['name' => 'Manage Purchase Order'],
            ['name' => 'Create Purchase Order'],
            ['name' => 'Update Purchase Order'],
            ['name' => 'View Purchase Order'],
            ['name' => 'Delete Purchase Order'],
            ['name' => 'Manage Settings'],
        ];
        foreach ($permissions as $permission) {
            Permission::updateOrCreate(['name' => $permission['name']], $permission);
        }
        $manager = Role::where('name', 'Manager')->first();
        $manager->givePermissionTo(Permission::all());

        $admin = Role::where('name', 'Admin')->first();
        $admin->givePermissionTo(Permission::where('name', '!=', 'Manage Settings')->get());

        $accounts = Role::where('name', 'Accounts')->first();
        $accounts->givePermissionTo(Permission::where('name', '!=', 'Manage Settings')->get());

        if(File::exists(storage_path("app/explorer")))
            File::deleteDirectory(storage_path("app/explorer"));

        File::makeDirectory(storage_path("app/explorer"), 0777, true, true);

        $this->info('Permissions successfully created!');
    }
}
