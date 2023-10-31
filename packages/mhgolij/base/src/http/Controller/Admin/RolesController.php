<?php

namespace mhgolij\base\http\Controller\Admin;

use Illuminate\View\View;
use mhgolij\base\http\Requests\Admin\RoleRequest;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesController extends \App\Http\Controllers\Controller
{
    public function index(): View
    {
        $roles = Role::all();
        return view('mhgolijBase::admin.roles.index', compact('roles'));
    }

    public function edit(Role $role): View
    {
        $permissions = Permission::all();
        $rolePermission = $role->permissions->pluck('name')->toArray();
        return view('mhgolijBase::admin.roles.edit', compact('role','permissions','rolePermission'));
    }

    public function create(): View
    {
        $permissions = Permission::all();
        return view('mhgolijBase::admin.roles.create', compact('permissions'));
    }

    public function store(RoleRequest $request): string
    {
        $role = Role::create([
            'name' => $request->name,
            'fa_name' => $request->fa_name,
        ]);
        $role->syncPermissions($request->permission??[]);
        return to_route('base.admin.roles.index')->with('success', trans('mhgolijBase::admin.message.operation_success'));
    }
    public function update(RoleRequest $request, Role $role): string
    {
        $role->update([
            'fa_name' => $request->fa_name,
        ]);
        $role->syncPermissions($request->permission??[]);
        return to_route('base.admin.roles.index')->with('success', trans('mhgolijBase::admin.message.operation_success'));
    }
}
