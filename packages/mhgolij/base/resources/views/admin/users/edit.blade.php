@extends('mhgolijBase::admin.layouts.app')
@section('styles')
    <style>
        .select2-selection {
            background-color: rgb(55 65 81 / var(--tw-bg-opacity)) !important;
            height: 43px;
            border-color: rgb(75 85 99 / var(--tw-border-opacity)) !important;
            border-radius: 0.5rem;
        }
    </style>
@endsection
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
                        <a href="{{route('base.admin.user-group.index')}}"
                           class="mx-1 text-sm font-medium text-gray-700 hover:text-black md:mx-2 dark:text-gray-400 dark:hover:text-white">@lang('mhgolijBase::admin.breadcrumb.users_group')</a>
                    </div>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                             class="bi bi-arrow-left-short" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                  d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z"/>
                        </svg>
                        <a href="{{route('base.admin.user.index',$userGroup->code)}}"
                           class="mx-1 text-sm font-medium text-gray-700 hover:text-black md:mx-2 dark:text-gray-400 dark:hover:text-white">{{ $userGroup->name }}</a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                             class="bi bi-arrow-left-short" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                  d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z"/>
                        </svg>
                        <span
                            class="mx-1 text-sm font-medium text-gray-500 md:mx-2 dark:text-gray-400">@lang('mhgolijBase::admin.breadcrumb.edit_user',['name'=>$user->name])</span>
                    </div>
                </li>
            </ol>
        </nav>


        <div class="rounded shadow-2xl bg-gray-800 p-5 m-5 text-white">
            <h2>@lang('mhgolijBase::admin.breadcrumb.edit_user',['name'=>$user->name])</h2>
        </div>
        <form action="{{route('base.admin.user.update' , ['userGroup'=>$userGroup->code,'user'=>$user->user_name])}}"
              method="POST">
            @csrf
            @method('PUT')
            <div x-data="userGroups" class="grid gap-4 overflow-y-auto grid-cols-1 md:grid-cols-4 m-5 rounded shadow-2xl bg-gray-800 p-5">
                <div>
                    <label for="group_id"
                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">@lang('mhgolijBase::admin.breadcrumb.user_group')</label>
                    <select :on="rolesShowToggle" x-model="selectedGroup" id="group_id" name="group_id"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:brder-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            required>
                        @foreach($userGroups as $userG)
                            <option
                                value="{{$userG->id}}" @selected(old('group_id',$user->group_id) == $userG->id)>{{$userG->name}}</option>
                        @endforeach

                    </select>
                </div>
                <div>
                    <label for="name"
                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">@lang('mhgolijBase::admin.form.name')</label>
                    <input type="text" id="name" name="name" value="{{old('name',$user->name)}}"
                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:brder-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                           required/>
                </div>
                <div>
                    <label for="last_name"
                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">@lang('mhgolijBase::admin.form.last_name')</label>
                    <input type="text" id="last_name" name="last_name" value="{{old('last_name',$user->last_name)}}"
                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:brder-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"/>
                </div>
                <div>
                    <label for="email"
                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">@lang('mhgolijBase::admin.form.email')</label>
                    <input type="email" id="email" name="email" value="{{old('email',$user->email)}}"
                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:brder-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"/>
                </div>
                <div>
                    <label for="mobile"
                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">@lang('mhgolijBase::admin.form.mobile_phone')</label>
                    <input type="text" id="mobile" name="mobile" value="{{old('mobile',$user->mobile)}}"
                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:brder-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"/>
                </div>
                <div>
                    <label for="birth_day"
                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">@lang('mhgolijBase::admin.form.birth_day')</label>
                    <input data-jdp type="text" id="birth_day" dir="ltr" name="birth_day"
                           value="{{old('birth_date',$user->birth_date ? jdate($user->birth_date)->format('Y-m-d') : '')}}"
                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:brder-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"/>
                </div>
                @if($userGroup->is_admin)
                    <div x-show="rolesShow === '1'">
                        <label for="roles"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">@lang('mhgolijBase::admin.breadcrumb.roles')</label>
                        <select id="roles" multiple name="roles[]"
                            @class([
                             "bg-gray-50 border text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"=>true,
                             "border-red-600"=> $errors->has('roles'),
                             "border-gray-300 dark:border-gray-600"=> !$errors->has('roles'),
                           ])
                        >
                            @foreach($roles as $role)
                                <option
                                    value="{{$role->name}}" @selected(in_array($role->name,old('roles',$userRoles)??[])) >{{$role->fa_name}}</option>
                            @endforeach
                        </select>
                        @error('roles')
                        <span class="text-red-600 pr-2 text-sm">{{$message}}</span>
                        @enderror
                    </div>
                @endif
                <div class="col-span-full">
                </div>
                <div>
                    <label for="user_name"
                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">@lang('mhgolijBase::admin.form.user_name')</label>
                    <input type="text" id="user_name" name="user_name" value="{{old('user_name',$user->user_name)}}"
                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:brder-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"/>
                </div>
                <div>
                    <label for="password"
                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">@lang('mhgolijBase::admin.form.password')</label>
                    <input type="password" id="password" name="password"
                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:brder-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"/>
                </div>
                <div>
                    <label for="password_confirmation"
                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">@lang('mhgolijBase::admin.form.password_confirm')</label>
                    <input type="password" id="password_confirmation" name="password_confirmation"
                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:brder-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"/>
                </div>
                <div class="col-span-full">
                    <button type="submit"
                            class="bg-blue-500 hover:bg-blue-400 text-white font-bold py-2 px-4 border-b-4 border-blue-700 hover:border-blue-500 rounded">
                        @lang('mhgolijBase::admin.button.submit')
                    </button>

                </div>
            </div>
        </form>

    </div>
@endsection
@section('scripts')
    @include('mhgolijBase::partials.majidHDatepicker')
    <script type="text/javascript">
        $(document).ready(function () {
            try {
                const role = $('#roles');
                role.select2();
                role.val({!!json_encode(old('roles',$userRoles)??[])!!});
                role.trigger('change');
            } catch (e) {

            }
        });

        document.addEventListener('alpine:init', () => {
            Alpine.data('userGroups', () => ({
                data: {!! json_encode($userGroups->pluck('is_admin','id')) !!},
                rolesShow: '{{ $userGroup->is_admin}}',
                selectedGroup : '{{ $userGroup->id}}',
                rolesShowToggle (){
                    if (this.data[this.selectedGroup] === 1){
                        this.rolesShow= '1'
                    }else{
                        this.rolesShow= '0'
                    }
                }
            }))
        })
    </script>
@endsection
