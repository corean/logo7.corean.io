<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

/**
 * @method static findOrFail($id)
 * @method static filter(\App\Filters\UserFilters $filters)
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'name',
        'email',
        'password',
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

    public function scopeFilter($query, $filter)
    {
        return $filter->apply($query);
    }

    public function member()
    {
        return $this->hasOne(Member::class, 'no', 'member_id');
    }

    public function setPasswordAttribute($value)
    {
        // users 테이블의 password 필드에 변경시 mini_member 테이블도 같이 적용
        $this->member->password = $value;
        $this->member->save();

        return $this->attributes['password'] = $value;
    }
}
