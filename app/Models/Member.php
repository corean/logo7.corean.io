<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Member extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'mini_member';
    protected $primaryKey = 'no';
    protected $dates = [
        'membership_reg_date',
        'membership_until_date',
    ];
    protected $fillable = [
        'membership',
        'admit',
        'free_point',
        'down_point2',
        'membership_reg_date',
        'membership_until_date',
    ];

    public function isAdmin(): bool
    {
        return $this->id === 'logo';
    }

    public function getDownloadPoint(): ?string
    {
        if ($this->level < 0 || $this->level > 9) {
            return null;
        }
        return match ($this->level) {
            1 => '200',
            2 => '250',
            3 => '300',
            4 => '400',
            5 => '500',
            6, 7, 8, 9 => '999',
            default => '-2',
        };
    }

    public function membership_grade(): string
    {
        return match ($this->membership) {
            11 => "무료회원(신규)",
            12 => "무료회원(기존)",
            21 => "유료회원(미확인)",
            31 => "마일리지회원 ",
            32 => "유료회원(무통장) ",
            33 => "유료회원(카드) ",
            34 => "유료회원(계좌이체) ",
            39 => "유료회원(기간이 일주일남음) ",
            41 => "명예회원(예전 운영회원) ",
            42 => "명예회원(관리자 지정)",
            43 => "갤러리",
            45 => "운영회원",
            50 => "관리자",
            // default => $this->membership,
            default => '알수없음',
        };
    }
}
