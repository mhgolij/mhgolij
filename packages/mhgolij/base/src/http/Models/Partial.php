<?php

namespace mhgolij\base\http\Models;

use Illuminate\Database\Eloquent\Builder;

class Partial extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'mhgolij_partials';
    public static function boot(): void
    {
        parent::boot();
        static::addGlobalScope('order',function(Builder $query){
           $query->orderBy('mhgolij_partials.order');
        });
    }
}
