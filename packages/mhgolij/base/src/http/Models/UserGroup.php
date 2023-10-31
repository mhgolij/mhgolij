<?php

namespace mhgolij\base\http\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserGroup extends \Illuminate\Database\Eloquent\Model
{
    use SoftDeletes;

    protected $table = 'mhgolij_user_groups';
    protected $guarded = ['id'];

    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'group_id', 'id');
    }

    public static function boot(): void
    {
        parent::boot();
        static::deleted(function ($model) {
            $model->users->each(function ($user) {
                $user->delete();
            });
        });
    }
}
