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
                        <a href="{{route('base.admin.roles.index')}}"
                           class="mx-1 text-sm font-medium text-gray-700 hover:text-black md:mx-2 dark:text-gray-400 dark:hover:text-white">@lang('mhgolijBase::admin.breadcrumb.roles')</a>
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
                            class="mx-1 text-sm font-medium text-gray-500 md:mx-2 dark:text-gray-400">@lang('mhgolijBase::admin.button.create_new_role')</span>
                    </div>
                </li>
            </ol>
        </nav>
        <div class="rounded shadow-2xl bg-gray-800 p-5 m-5 text-white">
            <h2>@lang('mhgolijBase::admin.button.create_new_role')</h2>
        </div>
        <form action="{{route('base.admin.roles.store')}}" method="POST">
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
                    <label for="fa_name"
                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">@lang('mhgolijBase::admin.form.fa_name')</label>
                    <input type="text" id="fa_name" name="fa_name" value="{{old('fa_name')}}"
                        @class([
                             "bg-gray-50 border text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"=>true,
                             "border-red-600"=> $errors->has('name'),
                             "border-gray-300 dark:border-gray-600"=> !$errors->has('name'),
                         ])/>
                    @error('name')
                    <span class="text-red-600 pr-2 text-sm">{{$message}}</span>
                    @enderror
                </div>
            </div>
            <div class="grid gap-4 overflow-y-auto grid-cols-1 md:grid-cols-4 m-5 rounded shadow-2xl bg-gray-800 p-5">
                @foreach($permissions as $permission)
                    <div class="flex items-center gap-2">
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" value="{{$permission->name}}" name="permission[]" @checked(in_array($permission->name,old('permission')??[])) class="sr-only peer">
                            <div
                                class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                        </label>
                            <span class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300">{{$permission->fa_name}}</span>
                    </div>
                @endforeach
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
