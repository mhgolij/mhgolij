@extends('mhgolijBase::admin.layouts.app')
@section('content')
    <div class="max-w-full h-full relative content-around md:px-2 lg:px-5 overflow-y-auto mt-5">

        <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center">
                <li class="inline-flex items-center">
                    <a href="#"
                       class="inline-flex items-start mx-1 text-sm font-medium text-gray-700 hover:text-grey-800 dark:text-gray-400 dark:hover:text-white">
                        <svg aria-hidden="true" class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20"
                             xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                        </svg>
                        @lang('mhgolijBase::admin.breadcrumb.home')
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                             class="bi bi-arrow-left-short" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                  d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z"/>
                        </svg>
                        <span
                           class="mx-1 text-sm font-medium text-gray-700 hover:text-black md:mx-2 dark:text-gray-400 dark:hover:text-white">@lang('mhgolijBase::admin.breadcrumb.users_group')</span>
                    </div>
                </li>
            </ol>
        </nav>

        <div class="overflow-x-auto mt-5 overflow-y-auto shadow-2xl">
            <div class="flex items-center justify-between ms-3 pb-4">
                <a href="{{route('base.admin.user-group.create')}}" class="bg-blue-600 px-4 py-2 text-white rounded">+ @lang('mhgolijBase::admin.button.create_new_user_group')</a>
            </div>
            <table class="w-full min-w-[680px] text-sm text-right text-gray-800 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="p-4">
                        #
                    </th>
                    <th scope="col" class="px-6 py-3">
                        @lang('mhgolijBase::admin.form.name')
                    </th>
                    <th scope="col" class="px-6 py-3">
                        @lang('mhgolijBase::admin.form.usergroup_count')
                    </th>
                    <th scope="col" class="px-6 py-3">
                        @lang('mhgolijBase::admin.form.is_admin')
                    </th>
                    <th scope="col" class="px-6 py-3">
                        @lang('mhgolijBase::admin.form.subscribe_limit')
                    </th>
                    <th scope="col" class="px-6 py-3">
                        /
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($userGroups as $userGroup)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td class="w-4 p-4">
                            <div class="flex items-center">
                             {{$userGroup->id}}
                            </div>
                        </td>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{$userGroup->name}}
                        </th>
                        <td class="px-6 py-4">
                            {{count($userGroup->users)}}
                        </td>
                        <td class="px-6 py-4">
                            {{$userGroup->is_admin == 0 ? trans('mhgolijBase::admin.message.no') : trans('mhgolijBase::admin.message.yes')}}
                        </td>
                        <td class="px-6 py-4">
                            {{$userGroup->limitation_count}}
                        </td>
                        <td class="py-4">
                            <button type="button" onclick="del(this)" data-text="@lang('mhgolijBase::admin.message.all_users_will_be_deleted_too')" data-title="@lang('mhgolijBase::admin.message.user_group_delete_sure',['name'=>$userGroup->name])" data-link="{{route('base.admin.user-group.destroy',$userGroup->code)}}" class="font-medium text-red-600 dark:text-red-500 border border-red-600 p-2 hover:text-white hover:bg-red-600 mr-2 transition">@lang('mhgolijBase::admin.button.delete')</button>
                            <a href="{{route('base.admin.user-group.edit',$userGroup->code)}}" class="font-medium text-blue-600 dark:text-blue-500 border border-blue-600 p-2 hover:text-white hover:bg-blue-600 mr-2 transition">@lang('mhgolijBase::admin.button.edit')</a>
                            <a href="{{route('base.admin.user.index',$userGroup->code)}}" class="font-medium text-yellow-600 dark:text-yellow-500 border border-yellow-600 p-2 hover:text-white hover:bg-yellow-600 mr-2 transition">@lang('mhgolijBase::admin.button.show_subscribers')</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

    </div>
@endsection
