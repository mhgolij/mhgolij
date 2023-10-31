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
                        <a href="{{route('base.admin.user-group.index')}}"
                           class="mx-1 text-sm font-medium text-gray-700 hover:text-black md:mx-2 dark:text-gray-400 dark:hover:text-white">@lang('mhgolijBase::admin.breadcrumb.users_group')</a>
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
                            class="mx-1 text-sm font-medium text-gray-500 md:mx-2 dark:text-gray-400">@lang('mhgolijBase::admin.button.create_new_user_group')</span>
                    </div>
                </li>
            </ol>
        </nav>
        <div class="rounded shadow-2xl bg-gray-800 p-5 m-5 text-white">
            <h2>@lang('mhgolijBase::admin.button.create_new_user_group')</h2>
        </div>
        <form action="{{route('base.admin.user-group.store')}}" method="POST">
            @csrf
            <div class="grid gap-4 overflow-y-auto grid-cols-1 md:grid-cols-4 m-5 rounded shadow-2xl bg-gray-800 p-5">
                <div>
                    <label for="name"
                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">@lang('mhgolijBase::admin.form.name')</label>
                    <input type="text" id="name" name="name" value="{{old('name')}}"
                        @class([
                             "bg-gray-50 border text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"=>true,
                             "border-red-600"=> $errors->has('name'),
                             "border-gray-300 dark:border-gray-600"=> !$errors->has('name'),
                         ])/>
                    @error('name')
                    <span class="text-red-600 pr-2 text-sm">{{$message}}</span>
                    @enderror
                </div>
                <div>
                    <label for="is_admin"
                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">@lang('mhgolijBase::admin.form.is_admin')</label>
                    <select type="text" id="is_admin" name="is_admin"
                        @class([
                         "bg-gray-50 border text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"=>true,
                         "border-red-600"=> $errors->has('is_admin'),
                          "border-gray-300 dark:border-gray-600"=> !$errors->has('is_admin'),
                      ])>
                        <option @selected(old('is_admin') == 0) value="0">@lang('mhgolijBase::admin.message.no')</option>
                        <option @selected(old('is_admin') == 1) value="1">@lang('mhgolijBase::admin.message.yes')</option>
                    </select>
                    @error('is_admin')
                    <span class="text-red-600 pr-2 text-sm">{{$message}}</span>
                    @enderror
                </div>
                <div>
                    <div id="zero_is_unlimited" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                        @lang('mhgolijBase::admin.message.zero_is_unlimited')
                        <div class="tooltip-arrow" data-popper-arrow></div>
                    </div>

                    <label for="limitation_count"
                           class="block mb-2 flex gap-2 text-sm font-medium text-gray-900 dark:text-white">@lang('mhgolijBase::admin.form.subscribe_limit')
                        <i data-tooltip-target="zero_is_unlimited" class="text-gray-400 hover:text-white text-sm text-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                            </svg>
                        </i>
                    </label>
                    <input type="number" id="limitation_count" name="limitation_count" value="{{old('limitation_count',0)}}"
                        @class([
                        "bg-gray-50 border text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"=>true,
                        "border-red-600"=> $errors->has('limitation_count'),
                        "border-gray-300 dark:border-gray-600"=> !$errors->has('limitation_count'),
                         ])/>
                    @error('limitation_count')
                    <span class="text-red-600 pr-2 text-sm">{{$message}}</span>
                    @enderror
                </div>
                <div>
                    <label for="code"
                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">@lang('mhgolijBase::admin.form.code')</label>
                    <input type="text" dir="ltr" id="code" name="code" value="{{old('code')}}"
                        @class([
                             "bg-gray-50 border text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"=>true,
                             "border-red-600"=> $errors->has('code'),
                             "border-gray-300 dark:border-gray-600"=> !$errors->has('code'),
                        ])
                    />
                    @error('code')
                    <span class="text-red-600 pr-2 text-sm">{{$message}}</span>
                    @enderror
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
    @include('mhgolijBase::partials.majidHDatepicker')
@endsection
