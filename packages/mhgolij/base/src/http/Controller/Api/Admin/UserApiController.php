<?php

namespace mhgolij\base\http\Controller\Api\Admin;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use mhgolij\base\http\Resources\UserResources;

class UserApiController extends \App\Http\Controllers\Controller
{
    public function index(): UserResources
    {
        $userGroups = User::paginate(15);
        return new UserResources($userGroups);
    }

    public function show($user): UserResources|jsonResponse
    {
        $user = User::whereUserName($user)->first();
        if (!$user)
            return response()->json([
                'status' => false,
                'messages' => [
                    'message' => trans('mhgolijBase::admin.message.not_found', ['name' => trans('mhgolijBase::admin.breadcrumb.user_group')]),
                    'type' => 'not found',
                    'code' => 404,
                    'date' => now()
                ]
            ]);
        return new UserResources($user);
    }

    public function update(Request $request, User $user): JsonResponse|UserResources
    {
        $input = $request->only([
            'name',
            'last_name',
            'email',
            'mobile',
            'user_name',
            'password'
        ]);
        try {
            $user = User::whereUserName($user)->first();
            if (!$user)
                return response()->json([
                    'status' => false,
                    'messages' => [
                        'message' => trans('mhgolijBase::admin.message.not_found', ['name' => trans('mhgolijBase::admin.breadcrumb.user_group')]),
                        'type' => 'not found',
                        'code' => 404,
                        'date' => now()
                    ]
                ]);
            $user->update($input);
            return new UserResources($user);
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

    public function store(Request $request): JsonResponse|UserResources
    {
        try {
            $input = $request->only([
                'name',
                'last_name',
                'email',
                'mobile',
                'user_name',
                'password'
            ]);
            $user = User::create($input);
            return new UserResources($user);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => [
                    'type' => 'error',
                    'date' => now(),
                    'code' => 500,
                    'messages' => trans('mhgolijBase::admin.message.create_operation_error', ['name' => trans('mhgolijBase::admin.breadcrumb.user_group')]),
                ]
            ]);
        }
    }

    public function destroy($user): JsonResponse
    {
        $user = User::whereUserName($user)->first();
        if (!$user)
            return response()->json([
                'status' => false,
                'messages' => [
                    'message' => trans('mhgolijBase::admin.message.not_found', ['name' => trans('mhgolijBase::admin.breadcrumb.user_group')]),
                    'type' => 'not found',
                    'code' => 404,
                    'date' => now()
                ]
            ]);
        $user->delete();
        return response()->json([
            'status' => true,
            'messages' => [
                'date' => now(),
                'type' => 'success',
                'code' => 200,
                'message' => trans('mhgolijBase::admin.message.operation_success')
            ]
        ]);
    }


}
