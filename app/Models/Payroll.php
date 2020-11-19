<?php

namespace App\Models;

use App\Http\Traits\UsesUuid;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payroll extends Model
{
    use HasFactory, SoftDeletes, UsesUuid;

    protected $guarded = [];
    protected $primaryKey = 'id';

    public function employee() {
        return $this->belongsTo(Employee::class, 'employee_id', 'id');
    }

    public function getCreatedAtAttribute($value) {
        return Carbon::parse($value)->toFormattedDateString();
    }
}
