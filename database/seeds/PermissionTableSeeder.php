<?php
use Illuminate\Database\Seeder;
use App\Permission;

class PermissionTableSeeder  extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            [
                'name' => 'role-list',
                'display_name' => 'Xem DS role',
                'description' => ''
            ],
            [
                'name' => 'role-create',
                'display_name' => 'Tạo mới role',
                'description' => ''
            ],
            [
                'name' => 'role-edit',
                'display_name' => 'Chỉnh sửa role',
                'description' => ''
            ],
            [
                'name' => 'role-delete',
                'display_name' => 'Xóa role',
                'description' => ''
            ],
            [
                'name' => 'user-list',
                'display_name' => 'Xem DS user',
                'description' => ''
            ],
            [
                'name' => 'user-create',
                'display_name' => 'Tạo mới user',
                'description' => ''
            ],
            [
                'name' => 'user-edit',
                'display_name' => 'Chỉnh sửa user',
                'description' => ''
            ],
            [
                'name' => 'user-delete',
                'display_name' => 'Xóa user',
                'description' => ''
            ],
            [
                'name' => 'organization-list',
                'display_name' => 'Xem DS doanh nghiệp',
                'description' => ''
            ],
            [
                'name' => 'organization-create',
                'display_name' => 'Tạo mới doanh nghiệp',
                'description' => ''
            ],
            [
                'name' => 'organization-edit',
                'display_name' => 'Chỉnh sửa doanh nghiệp',
                'description' => ''
            ],
            [
                'name' => 'organization-delete',
                'display_name' => 'Xóa doanh nghiệp',
                'description' => ''
            ],
            [
                'name' => 'employee-list',
                'display_name' => 'Xem DS nhân viên',
                'description' => ''
            ],
            [
                'name' => 'employee-create',
                'display_name' => 'Tạo mới nhân viên',
                'description' => ''
            ],
            [
                'name' => 'employee-edit',
                'display_name' => 'Chỉnh sửa nhân viên',
                'description' => ''
            ],
            [
                'name' => 'employee-delete',
                'display_name' => 'Xóa nhân viên',
                'description' => ''
            ],
            [
                'name' => 'table-list',
                'display_name' => 'Xem DS bàn',
                'description' => ''
            ],
            [
                'name' => 'table-create',
                'display_name' => 'Tạo mới bàn',
                'description' => ''
            ],
            [
                'name' => 'table-edit',
                'display_name' => 'Chỉnh sửa bàn',
                'description' => ''
            ],
            [
                'name' => 'table-delete',
                'display_name' => 'Xóa bàn',
                'description' => ''
            ],
            [
                'name' => 'button-list',
                'display_name' => 'Xem DS nút bấm',
                'description' => ''
            ],
            [
                'name' => 'button-create',
                'display_name' => 'Tạo mới nút bấm',
                'description' => ''
            ],
            [
                'name' => 'button-edit',
                'display_name' => 'Chỉnh sửa nút bấm',
                'description' => ''
            ],
            [
                'name' => 'button-delete',
                'display_name' => 'Xóa nút bấm',
                'description' => ''
            ],
        ];
        foreach ($permissions as $key => $value) {
            Permission::create($value);
        }
    }
}
