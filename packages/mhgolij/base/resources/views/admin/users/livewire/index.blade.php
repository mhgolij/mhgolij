<div class="overflow-x-auto mt-5 overflow-y-auto shadow-2xl">
    <div class="flex items-center justify-between ms-3 pb-4">
        @if($canCreateUser)
            <a href="{{route('base.admin.user.create',$userGroupCode)}}"
               class="bg-blue-600 px-4 py-2 text-white rounded">+ @lang('mhgolijBase::admin.button.new_user')</a>
        @endif
        <label for="table-search" class="sr-only">@lang('mhgolijBase::admin.form.search')</label>
        <div class="relative">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="currentColor"
                     viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                          d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                          clip-rule="evenodd"></path>
                </svg>
            </div>
            <input type="text" id="table-search" wire:model.debounce.500ms="searchParam"
                   class="block p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                   placeholder="@lang('mhgolijBase::admin.form.search_user')...">
        </div>
    </div>
    <table class="w-full text-sm text-right text-gray-800 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr>
            <th scope="col" class="p-4">
                <div class="flex items-center">
                    <input onclick="allCheck(this)" id="checkbox-all" type="checkbox"
                           class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="checkbox-all" class="sr-only">checkbox</label>
                </div>
            </th>
            <th scope="col" class="px-6 py-3">
                @lang('mhgolijBase::admin.form.name')
            </th>
            <th scope="col" class="px-6 py-3">
                @lang('mhgolijBase::admin.form.user_name')
            </th>
            <th scope="col" class="px-6 py-3">
                @lang('mhgolijBase::admin.form.mobile_phone')
            </th>
            @if($isAdmin)
                <th scope="col" class="px-6 py-3">
                    @lang('mhgolijBase::admin.breadcrumb.role')
                </th>
            @endif
            <th scope="col" class="px-6 py-3">
                /
            </th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                <td class="w-4 p-4">
                    <div class="flex items-center">
                        <input value="{{$user->id}}" wire:model="selectedIds" id="user{{$user->id}}" type="checkbox"
                               class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500
                        dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2
                        dark:bg-gray-700 dark:border-gray-600">
                        <label for="user{{$user->id}}" class="sr-only">checkbox</label>
                    </div>
                </td>
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{$user->name}}
                </th>
                <td class="px-6 py-4">
                    {{$user->user_name}}
                </td>
                <td class="px-6 py-4">
                    {{$user->mobile}}
                </td>
                @if($isAdmin)
                    <td class="px-6 py-4">
                        {{$user->roles->pluck('name')}}
                    </td>
                @endif
                <td class="px-6 py-4">
                    <a href="{{route('base.admin.user.edit',['user'=>$user->user_name,'userGroup'=>$userGroupCode])}}"
                       class="font-medium text-blue-600 dark:text-blue-500 hover:underline">@lang('mhgolijBase::admin.button.edit')</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    @include('mhgolijBase::partials.livewire-sweet-alert')
    @if(count($selectedIds))
        <div class="bg-amber-200 transition absolute bottom-0 start-0 flex justify-end end-0 p-2 ">
            <button class="bg-red-500 px-2 py-1 text-white flex items-center rounded"
                    onclick="sweetAlertInit('remove','حذف موارد انتخابی؟','موارد انتخابی برای همیشه حذف میشوند.')">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                     class="bi bi-trash-fill" viewBox="0 0 16 16">
                    <path
                        d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                </svg>
                @lang('mhgolijBase::admin.button.delete')
            </button>
        </div>
    @endif
    <script>
        function allCheck(source) {
            const checkboxes = document.querySelectorAll('input[id^="user"]');
            let selected = [];
            checkboxes.forEach(el => {
                el.checked = source.checked
                if (el.checked) {
                    selected.push(el.value);
                }
            });
        @this.selectedIds
            = selected
        }

    </script>
</div>
