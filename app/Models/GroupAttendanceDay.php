<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupAttendanceDay extends Model
{
    use HasFactory;

    protected $table = 'group_attendance_days';
    protected $primaryKey = 'group_id';
    public $timestamps = false;
    protected $fillable = [
        'group_id',
        'dates',
    ];


    public function group()
    {
        return $this->belongsTo(Group::class);
    }
}
