<?php

namespace mhgolij\base\http\Controller\Api\Admin;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use mhgolij\base\http\Models\UserGroup;
use mhgolij\base\http\Resources\UserGroupResources;

class UserGroupApiController extends \App\Http\Controllers\Controller
{
    public function index(): UserGroupResources
    {
        $userGroups = UserGroup::paginate(15);
        return new UserGroupResources($userGroups);
    }

    public function show($userGroup): UserGroupResources|jsonResponse
    {
        $userGroup = UserGroup::whereCode($userGroup)->first();
        if (!$userGroup)
            return response()->json([
                'status' => false,
                'messages' => [
                    'message' => trans('mhgolijBase::admin.message.not_found', ['name' => trans('mhgolijBase::admin.breadcrumb.user_group')]),
                    'type' => 'not found',
                    'code' => 404,
                    'date' => now()
                ]
            ]);
        return new UserGroupResources($userGroup);
    }

    public function update(Request $request, $userGroup): JsonResponse | UserGroupResources
    {
        $userGroup = UserGroup::whereCode($userGroup)->first();
        if (!$userGroup)
            return response()->json([
                'status' => false,
                'messages' => [
                    'message' => trans('mhgolijBase::admin.message.not_found', ['name' => trans('mhgolijBase::admin.breadcrumb.user_group')]),
                    'type' => 'not found',
                    'code' => 404,
                    'date' => now()
                ]
            ]);
        $input = $request->only(['is_admin', 'name', 'limitation_count']);
        try {
            $userGroup->update($input);
            return new UserGroupResources($userGroup);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'messages' => [
                    'type' => 'error',
                    'date' => now(),
                    'code' => 500,
                    'message' => trans('mhgolijBase::admin.message.edit_operation_failure', ['name' => trans('mhgolijBase::admin.breadcrumb.user_group')])
                ]
            ]);
        }

    }

    public function store(Request $request) : JsonResponse | UserGroupResources
    {
        try {
            $input = $request->only(['name' , 'code','limitation_count','is_admin']);
            $userGroup = UserGroup::create($input);
            return new UserGroupResources($userGroup);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => [
                    'type' => 'error',
                    'date' => now(),
                    'code' => 200,
                    'messages' => trans('mhgolijBase::admin.message.create_operation_error', ['name' => trans('mhgolijBase::admin.breadcrumb.user_group')]),
                ]
            ]);
        }
    }

    public function destroy($userGroup) : JsonResponse {
        $userGroup = UserGroup::whereCode($userGroup)->first();
        if (!$userGroup)
            return response()->json([
                'status' => false,
                'messages' => [
                    'message' => trans('mhgolijBase::admin.message.not_found', ['name' => trans('mhgolijBase::admin.breadcrumb.user_group')]),
                    'type' => 'not found',
                    'code' => 404,
                    'date' => now()
                ]
            ]);
        $userGroup->delete();
        return response()->json([
            'status'=>true,
            'messages'=>[
                'date'=>now(),
                'type'=>'success',
                'code'=>200,
                'message'=>trans('mhgolijBase::admin.message.operation_success')
            ]
        ]);
    }
}
