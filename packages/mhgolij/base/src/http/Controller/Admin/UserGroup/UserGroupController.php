<?php

namespace mhgolij\base\http\Controller\Admin\UserGroup;

use Illuminate\View\View;
use mhgolij\base\http\Models\UserGroup;
use mhgolij\base\http\Requests\Admin\UserGroupRequest;

class UserGroupController extends \App\Http\Controllers\Controller
{
    public function index() : View {
        $userGroups= UserGroup::with('users')->get();
        return view('mhgolijBase::admin.user-group.index', compact('userGroups'));
    }
    public function  create() : View {
        return view('mhgolijBase::admin.user-group.create');
    }
    public function store(UserGroupRequest $request) : string {
        UserGroup::create([
           'is_admin'=>$request->is_admin,
           'limitation_count'=>$request->limitation_count,
           'code'=>$request->code,
           'name'=>$request->name
        ]);
        return to_route('base.admin.user-group.index');
    }
    public function edit(UserGroup $userGroup) : View {
        return view('mhgolijBase::admin.user-group.edit', compact('userGroup'));
    }
    public function update(UserGroup $userGroup, UserGroupRequest $request) : string {
        $userGroup->update([
           'is_admin'=>$request->is_admin,
           'limitation_count'=>$request->limitation_count,
           'name'=>$request->name
        ]);
        return to_route('base.admin.user-group.index')->with('success',trans('mhgolijBase::admin.message.operation_success'));
    }
    public function destroy(UserGroup $userGroup) : string {
        $userGroup->delete();
        return to_route('base.admin.user-group.index')->with('success',trans('mhgolijBase::admin.message.operation_success'));
    }
}
