<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;
use App\Models\Wallet;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $permissions = [
            'manage categories',
            'manage tools',
            'manage projects',
            'manage project tools',
            'manage wallets',
            'manage applicants',

            'apply job', // penjoki
            'topup wallet', // klien
            'withdraw wallet', // penjoki
        ];

        foreach($permissions as $permission){
            Permission::firstOrCreate([
                'name' => $permission
            ]);
        }

        // client
        $clientRole = Role::firstOrCreate([
            'name' => 'project_client'
        ]);
        $clientPermissions = [
            'manage projects',
            'manage project tools',
            'manage applicants',
            'topup wallet',
            'withdraw wallet',
        ];
        $clientRole->syncPermissions($clientPermissions);

        // penjoki
        $penjokiRole = Role::firstOrCreate([
            'name' => 'project_penjoki'
        ]);
        $penjokiPermissions = [
            'apply job',
            'withdraw wallet',
        ];
        $penjokiRole->syncPermissions($penjokiPermissions);

        // superadmin
        $superAdminRole = Role::firstOrCreate([
            'name' => 'super_admin'
        ]);

        // user
        $user = User::create([
            'name' => 'Super Admin',
            'email' => 'super@admin.com',
            'occupation' => 'Owner',
            'connect' => 1000,
            'avatar' => 'images/default-avatar.png',
            'password' => bcrypt('superadmin')
        ]);
        $user->assignRole($superAdminRole);

        $wallet = new Wallet([
            'balance' => 0,
        ]);
        $user->wallet()->save($wallet);
        
    }
}
