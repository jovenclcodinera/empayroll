<?php

namespace App\Models;

use App\Http\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Role extends Model
{
    use HasFactory, SoftDeletes, UsesUuid;

    protected $guarded = [];
    protected $primaryKey = 'id';

    public function users() {
        return $this->hasMany(User::class, 'role', 'title');
    }

    public function setTitleAttribute($value) {
        $this->attributes['title'] = Str::upper($value);
    }

    public function getTitleAttribute($value) {
        return Str::ucfirst(Str::lower($value));
    }
}
