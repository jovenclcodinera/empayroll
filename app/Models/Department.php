<?php

namespace App\Models;

use App\Http\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
    use HasFactory, SoftDeletes, UsesUuid;

    protected $guarded = [];
    protected $primaryKey = 'id';

    public function employees() {
        return $this->hasMany(Employee::class, 'department', 'name');
    }
}
