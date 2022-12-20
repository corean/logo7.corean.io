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

    public function getDownloadPoint()
    {
        if ($this->level < 0 || $this->level > 9) {
            return false;
        }
        switch ($this->level) {
            case '1':
                $download_point = '200';
                break;
            case '2':
                $download_point = '250';
                break;
            case '3':
                $download_point = '300';
                break;
            case '4':
                $download_point = '400';
                break;
            case '5':
                $download_point = '500';
                break;
            case '6':
            case '7':
            case '8':
            case '9':
                $download_point = '999';
                break;
            default:
                $download_point = '-2';
        }
        return $download_point;
    }

    public function membership_grade() : string
    {
        switch($this->membership) { //유료회원 관련
            case "11":
                $membership = "무료회원(신규)";
                break;
            case "12":
                $membership = "무료회원(기존)";
                break;
            case "21":
                $membership = "유료회원(미확인)";
                break;
            case "31":
                $membership = "마일리지회원 ";
                // if($log[special] == "s_admin") $membership .= "(승인: ".date("c",$user_data['membership_reg_date']).")";
                break;
            case "32":
                $membership = "유료회원(무통장) ";
                // if($log[special] == "s_admin") $membership .= "(신청: ".date("c",$user_data['membership_reg_date']).")";
                break;
            case "33":
                $membership = "유료회원(카드) ";
                // if($log[special] == "s_admin") $membership .= "(신청: ".date("c",$user_data['membership_reg_date']).")";
                break;
            case "34":
                $membership = "유료회원(계좌이체) ";
                // if($log[special] == "s_admin") $membership .= "(신청: ".date("c",$user_data['membership_reg_date']).")";
                break;
            case "39":
                $membership = "유료회원(기간이 일주일남음) ";
                // if($log[special] == "s_admin") $membership .= "(신청: ".date("c",$user_data['membership_reg_date']).")";
                break;
            case "41":
                $membership = "명예회원(예전 운영회원) ";
                // if($log[special] == "s_admin") $membership .= "(승인: ".date("c",$user_data['membership_reg_date']).")";
                break;
            case "42":
                $membership = "명예회원(관리자 지정)";
                break;
            case "43":
                $membership = "갤러리";
                break;
            case "45":
                $membership = "운영회원";
                break;
            case "50":
                $membership = "관리자";
                break;
            default:
                $membership = "알수없음 ";
        }
        return $membership;
    }
}
