<?php

namespace mhgolij\base\http\Livewire\UsersGroup;

use App\Models\User;
use Livewire\Component;
use mhgolij\base\http\Models\UserGroup;

class Users extends Component
{
    public int $userGroupId, $isAdmin=0;
    public bool $canCreateUser = true;
    public string $userGroupCode;
    public string|null $searchParam = null;
    protected $listeners = [
        'sweetAlertRemovedConfirmed' => 'removeSelected'
    ];
    public array $selectedIds = [];

    public function mount(int $userGroupId): void
    {
        $userGroup = UserGroup::with('users')->findOrFail($userGroupId);
        $this->userGroupId = $userGroupId;
        $this->isAdmin = $userGroup->is_admin;
        $this->userGroupCode = $userGroup->code;
        $this->canCreateUser = $userGroup->limitation_count == 0 || ($userGroup->limitation_count > count($userGroup->users));
    }

    public function removeSelected(): void
    {
        User::whereIn('id', $this->selectedIds)->delete();
        $this->dispatchBrowserEvent('sweetAlertDone', [
            'title' => trans('mhgolijBase::admin.operation_success'),
            'text' => trans('mhgolijBase::admin.delete_complete')
        ]);
        $this->reset('selectedIds', 'canCreateUser');
    }

    public function render()
    {
        $users = User::where('group_id', $this->userGroupId);
        if ($this->searchParam)
            $users->where(function ($query) {
                $query->orWhere('name', 'like', '%' . $this->searchParam . '%');
                $query->orWhere('last_name', 'like', '%' . $this->searchParam . '%');
                $query->orWhere('user_name', 'like', '%' . $this->searchParam . '%');
            });
        $users = $users->get();
        return view('mhgolijBase::admin.users.livewire.index', compact('users'))->layout('mhgolijBase::admin.layouts.app')->section('content');
    }
}
