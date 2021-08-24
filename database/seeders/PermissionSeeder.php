<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'user-list',
            'user-create',
            'user-edit',
            'user-delete',
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'tingkat-list',
            'tingkat-create',
            'tingkat-edit',
            'tingkat-delete',
            'kelas-list',
            'kelas-create',
            'kelas-edit',
            'kelas-delete',
            'mata_pelajaran-list',
            'mata_pelajaran-create',
            'mata_pelajaran-edit',
            'mata_pelajaran-delete',
            'simulasi-list',
            'simulasi-create',
            'simulasi-edit',
            'simulasi-delete',

            // 'brand-list',
            // 'brand-create',
            // 'brand-edit',
            // 'brand-delete',
            // 'unit-list',
            // 'unit-create',
            // 'unit-edit',
            // 'unit-delete',
            // 'product-list',
            // 'product-create',
            // 'product-edit',
            // 'product-delete',
            // 'article-list',
            // 'article-create',
            // 'article-edit',
            // 'article-delete',
            // 'external-user-list',
            // 'external-user-create',
            // 'external-user-edit',
            // 'external-user-delete',
            // 'subcategory-list',
            // 'subcategory-create',
            // 'subcategory-edit',
            // 'subcategory-delete',
            // 'upload-product',
            // 'request-pengambilan-dana',
            // 'history-saldo-list',
            // 'history-saldo-create',
            // 'history-saldo-edit',
            // 'history-saldo-delete',
            // 'service-list',
            // 'service-create',
            // 'service-edit',
            // 'service-delete',
            // 'subservice-list',
            // 'subservice-create',
            // 'subservice-edit',
            // 'subservice-delete',
            // 'banner-list',
            // 'banner-create',
            // 'banner-edit',
            // 'banner-delete',
            // 'transaction-product-list',
            // 'transaction-product-create',
            // 'transaction-product-edit',
            // 'transaction-product-delete',
            // 'promo-list',
            // 'promo-create',
            // 'promo-edit',
            // 'promo-delete',
        ];

        foreach ($permissions as $permission) {
            Permission::updateOrCreate(
                ['name' => $permission],
                ['guard_name' => 'backoffice', 'name' => $permission]
            );
        }
    }
}
