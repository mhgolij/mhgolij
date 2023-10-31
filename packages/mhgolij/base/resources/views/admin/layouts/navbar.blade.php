<header class="h-16 w-full flex items-center relative justify-end px-5 space-x-10 bg-gray-800">
    <!-- Informação -->
    <div class="flex flex-shrink-0 items-center text-white">
        <!-- Texto -->
        <div class="flex flex-col items-start ">
            <!-- Nome -->
            <div class="text-md font-medium ">{{auth()->user()->fullName}}</div>
            <!-- Título -->
            <div class="text-sm font-regular">{{auth()->user()->roles->pluck('name')}}</div>
        </div>

        <!-- Foto -->
        <div role="button" id="opneProfileList"
             class="h-10 w-10 relative rounded-full mx-3 cursor-pointer bg-gray-200 border-2 border-blue-400">
            <span
                class="-end- -top-2 inline-block whitespace-nowrap rounded-[0.27rem] bg-red-600 px-[0.65em] pb-[0.25em] pt-[0.35em] text-center align-baseline text-[0.75em] font-bold leading-none absolute">1</span>
            <div class="bg-gray-500 invisible opacity-0 p-2 rounded absolute top-[125%] end-2 z-10 min-w-[10rem]">
                <ul class="flex [&>li>*]:flex [&>li>*]:gap-1 [&>li>*]:items-center [&>li>*]:w-100 text-sm flex-col [&>li]:py-2 [&>li]:transition [&>li:hover]:text-gray-900 divide-y divide-slate-700">
                    <li>
                        <a href="/">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house-door-fill" viewBox="0 0 16 16">
                                <path d="M6.5 14.5v-3.505c0-.245.25-.495.5-.495h2c.25 0 .5.25.5.5v3.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5Z"/>
                            </svg>
                        @lang('mhgolijBase::admin.breadcrumb.home')
                        </a>
                    </li>
                    <li>
                        <a href="{{route('profile.show')}}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                                <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3Zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"/>
                            </svg>
                            @lang('mhgolijBase::admin.breadcrumb.profile_page')
                        </a>
                    </li>
                    <li>
                        <span role="button" onclick="logout()">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z"/>
                                <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
                            </svg>
                            @lang('mhgolijBase::admin.breadcrumb.logout')
                        </span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>

