@extends('mhgolijBase::admin.layouts.app')
@section('styles')
    @livewireStyles
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
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                             class="bi bi-arrow-left-short" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                  d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z"/>
                        </svg>
                        <span
                            class="mx-1 text-sm font-medium text-gray-500 md:mx-2 dark:text-gray-400">{{ $userGroup->name }}</span>
                    </div>
                </li>
            </ol>
        </nav>


        @livewire('users',['userGroupId'=>$userGroup->id])
    </div>
@endsection
@section('scripts')
    @livewireScripts

@endsection
