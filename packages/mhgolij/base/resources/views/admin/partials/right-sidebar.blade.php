@can('userGroupsManage')
    <ul class="second-nav">
        <li>
            <a href="{{route('base.admin.user-group.index')}}">@lang('mhgolijBase::admin.breadcrumb.users_group')</a>
        </li>
    </ul>
@endcan
@can('usersManage')
    <ul class="second-nav">
        <li>
            <span>@lang('mhgolijBase::admin.breadcrumb.users')</span>
            <ul>
                @foreach(\mhgolij\base\http\Models\UserGroup::all() as $userGroup)
                    <li>
                        <a href="{{route('base.admin.user.index',['userGroup'=>$userGroup->code])}}">{{$userGroup->name}}</a>
                    </li>
                @endforeach
            </ul>
        </li>
    </ul>
@endcan
@can('rolesManage')
    <ul class="second-nav">
        <li>
            <span>@lang('mhgolijBase::admin.breadcrumb.permissions')</span>
            <ul>
                <li>
                    <a href="{{route('base.admin.roles.index')}}">@lang('mhgolijBase::admin.breadcrumb.roles')</a>
                </li>
            </ul>
        </li>
    </ul>
@endcan
