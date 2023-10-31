<?php

namespace mhgolij\base\http\Controller\Admin\UserGroup;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use mhgolij\base\http\Models\UserGroup;
use mhgolij\base\http\Requests\Admin\UserRequest;
use Morilog\Jalali\Jalalian;
use Spatie\Permission\Models\Role;

class UserController extends \App\Http\Controllers\Controller
{
    public function index(UserGroup $userGroup): View
    {
        return view('mhgolijBase::admin.users.index', compact('userGroup'));
    }

    public function create(UserGroup $userGroup): View
    {
        $roles = Role::all();
        return view('mhgolijBase::admin.users.create', compact('userGroup', 'roles'));
    }

    public function store(UserRequest $request, UserGroup $userGroup): string
    {
        abort_unless($userGroup->limitation_count == 0 || ($userGroup->limitation_count > count($userGroup->users)), 403);
        $birthDay = null;
        if ($request->birth_day) {
            $birthDay = Jalalian::fromFormat('Y-m-d', $request->birth_day)->toCarbon();
        }
        $user = User::create([
            'name' => $request->name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'user_name' => $request->user_name,
            'password' => Hash::make($request->password),
            'is_admin' => $userGroup->is_admin,
            'group_id' => $userGroup->id,
            'birth_date' => $birthDay
        ]);
        if ($userGroup->is_admin)
            $user->syncRoles($request->roles ?? []);
        else
            $user->syncRoles([]);
        return to_route('base.admin.user.index', $userGroup->code)->with('success', trans('mhgolijBase::admin.message.operation_success'));
    }

    public function edit(UserGroup $userGroup, User $user): View
    {
        $userGroups = UserGroup::all();
        $roles = Role::all();
        $userRoles = $user->roles->pluck('name')->toArray();
        return view('mhgolijBase::admin.users.edit', compact('userGroups', 'userRoles', 'userGroup', 'roles', 'user'));
    }

    public function update(Request $request, UserGroup $userGroup, User $user): string
    {
        if ($userGroup->is_admin)
            $user->syncRoles($request->roles ?? []);
        else
            $user->syncRoles([]);

        $birthDay = $user->birth_date;
        if ($request->birth_day)
            $birthDay = Jalalian::fromFormat('Y-m-d', $request->birth_day)->toCarbon();
        if ($request->password)
            $password = Hash::make($request->password);
        else
            $password = $user->password;
        $user->update([
            'name' => $request->name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'user_name' => $request->user_name,
            'password' => $password,
            'is_admin' => $userGroup->is_admin,
            'group_id' => $request->group_id,
            'birth_date' => $birthDay
        ]);
        return to_route('base.admin.user.index', $userGroup->code)->with('success', trans('mhgolijBase::admin.message.operation_success'));
    }
}
