<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'personalId',
        'attendance_state',
        'role',
        'password',
    ];

    protected $columnsForSheets = [
        'name',
        'personalId',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function scopeTeacher(Builder $query){
        $query->where('role', '0');
    }

    public function scopeSearch(Builder $query, $request)
    {
        if ($request['name_personalId'] ?? false) {
            $query->where('name', 'LIKE', "%{$request['name_personalId']}%")->orWhere('personalId', 'LIKE',  "%{$request['name_personalId']}%");
        }
    }


    public function groups(){
        return $this->hasMany(Group::class);
    }
    public function teacherAttendances(){
        return $this->hasMany(TeacherAttendance::class);
    }



    protected function attendanceState(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => $value == 'on' ? 1 : 0,
        );
    }



    public function getColumnsForSheets() {
        return $this->columnsForSheets;
    }
    public function setColumnsForSheets($columns = [])
    {
        $this->columnsForSheets = $columns;
        return $this;
    }


}
