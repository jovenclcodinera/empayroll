<?php

namespace App\Models;

use App\Http\Traits\UsesUuid;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use HasFactory, SoftDeletes, UsesUuid;

    protected $guarded = [];
    protected $primaryKey = 'id';

    public function department() {
        return $this->belongsTo(Department::class, 'department', 'name');
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function payrolls() {
        return $this->hasMany(Payroll::class, 'employee_id', 'id');
    }

    public function getCreatedAtAttribute($value) {
        return Carbon::parse($value)->toFormattedDateString();
    }
}
