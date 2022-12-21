<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Membership extends Model
{
    use SoftDeletes;

    protected $table = 'membership';
    protected $primaryKey = 'no';
    protected $dates = [
        'regdate',
        'confirmed_at'
    ];
    protected $fillable = [
        'chargename',
        'mobile',
    ];

    public function confirm(): bool
    {
        $this->confirmed_at = now();
        $this->Amount = 30000;

        // 회원 정보 업데이트
        $this->member()
            ->update(
                [
                    'membership' => 32,
                    'admit' => 0,
                    'free_point' => 0,
                    'down_point1' => $this->member->getDownloadPoint(),
                    'membership_reg_date' => time(),
                    'membership_until_date' => time() + (60 * 60 * 24 * 372),
                ]
            );

        // 쪽지 보내기
        Memo::create(
            [
                'target_no' => $this->member->no,
                'from_no' => 1,
                'from_name' => 'logo',
                'ment' => '입금확인되셨습니다. <br>연간회원으로 전환해주셔서 다시한번 감사합니다. <br><br>더좋은 사이트를 만들도록 노력하겠습니다.',
                'time' => time(),
            ]
        );

        return $this->save();
    }

    public function member()
    {
        return $this->belongsTo(Member::class, 'id', 'id');
    }

    public function confirmCancel(): void
    {
        // 입금확인 내역 업데이트
        $this->confirmed_at = null;
        $this->Amount = 0;

        // 회원 정보 업데이트
        $this->member()
            ->update(
                [
                    'membership' => 12,
                    'free_point' => 100,
                    'down_point2' => 0,
                    'membership_reg_date' => 0,
                    'membership_until_date' => 0,
                ]
            );
        $this->save();

        // 쪽지 발송
        $memo = Memo::where('target_no', $this->member->no)
            ->where('from_no', 1)
            ->where('from_name', 'logo')
            ->where('isread', 0)
            ->first();

        if ($memo) {
            // 안본 쪽지이라면 삭제
            $memo->delete();
        } else {
            // 이미 읽은 쪽지면 사과쪽지 발송
            Memo::create(
                [
                    'target_no' => $this->member->no,
                    'from_no' => 1,
                    'from_name' => 'logo',
                    'ment' => '착오로 인한 입금확인이 취소되었습니다.',
                    'time' => time(),
                    //'isread'    => 0,
                    //'special'   => 0,
                ]
            );
        }
    }

    public function completed()
    {
        return $this->where('id', $this->id)
            ->whereNotNull('confirmed_at');
    }

    public function getCompletedCountAttribute(): int
    {
        return $this->where('id', $this->id)
            ->whereNotNull('confirmed_at')
            ->count();
    }

}
