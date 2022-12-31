<?php
/**
 * Created by PhpStorm.
 * User: corean
 * Date: 2019-07-4
 * Time: 21:27
 */

namespace App\Filters;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use JsonException;

class MembershipFilters extends Filters
{
    protected array $filters = ['keyword',];

    /**
     * 검색어로 필터링
     *
     * @return mixed
     */
    protected function keyword(): Builder
    {
        if (! request('keyword')) {
            return $this->builder;
        }
        // 검색어로 검색
        return $this->builder
            ->where('chargename', 'like', '%'.request('keyword').'%');
    }

    /**
     * 정렬 필터링
     *
     * @return Builder|JsonException
     */
    protected function sort(): Builder|JsonException
    {
        $sort = request('sort');
        try {
            $sort = json_decode($sort, false, 512, JSON_THROW_ON_ERROR);
        } catch (JsonException $e) {
            return $e;
        }
        if (! $sort->field) {
            return $this->builder;
        }
        if ($sort->field === 'channel_name') {
            $sort->field = 'channel_id';
        } elseif ($sort->field === 'mb_name') {
            $sort->field = 'mb_no';
        }

        return $this->builder->orderBy($sort->field, $sort->type);
    }

    /**
     * 날짜 검색
     * @return Builder
     */
    public function dates(): Builder
    {
        $dates = request('dates');

        if (! is_array($dates) || count($dates) !== 2) {
            return $this->builder;
        }
        $start_time = new Carbon($dates[0]);
        $start_time->setTimezone('Asia/Seoul');
        $end_time = new Carbon($dates[1]);
        $end_time->setTimezone('Asia/Seoul');

        return $this->builder->whereBetween('created_at', [$start_time, $end_time]);
    }

    /**
     * 사용자 필터
     * @return Builder|JsonException
     */
    public function columnFilters(): Builder|JsonException
    {
        $columnFilters = request('columnFilters');
        try {
            $columnFilters = json_decode($columnFilters, true, 512, JSON_THROW_ON_ERROR);
        } catch (JsonException $e) {
            return $e;
        }
        if (! $columnFilters) {
            return $this->builder;
        }
    }
}
