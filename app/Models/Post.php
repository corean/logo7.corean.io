<?php

namespace App\Models;

use Awobaz\Compoships\Compoships;
use Awobaz\Compoships\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use Compoships;

    protected $table = 'corean_board';
    protected $primaryKey = 'id';
    protected $dates = ['reg_date'];

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class, [
            'board',
            'target',
        ], [
            'board',
            'original_no',
        ]);
    }

    public function files(): HasMany
    {
        return $this->hasMany(File::class, [
            'id',
            'target',
        ], [
            'board',
            'original_no',
        ])->orderBy('num');
    }

    /**
     * index(1~4)으로 게시판명 뽑기
     *
     * @return string
     */
    public function getBoardNameAttribute(): string
    {
        $board_id =  config('app.top_menus')[$this->board[0]];
        //clock('getBoardNameAttribute', 'app.sub_menus.'.$board_id.'.child.'.substr($this->board, 1).'.title');
        return config('app.sub_menus.'.$board_id.'.child.'.substr($this->board, 1).'.title');
    }

    /**
     * 게시판 코드만 뽑기 ex. 1free -> free
     *
     * @return string
     */
    public function getOnlyBoardAttribute(): string
    {
        return substr($this->board, 1);
    }

    /**
     * 게시판 파트명을 뽑기 ex. 1 -> boards
     *
     * @return string
     */
    public function getBoardPartUrlAttribute(): string
    {
        return config('app.top_menus')[$this->board[0]];
    }

    /**
     * 게시판 파트 url ex. /posts/boards/free
     *
     * @return string
     */
    public function getBoardPartPathAttribute(): string
    {
        return '/posts/'.$this->board_part_url.'/'.$this->only_board;
    }

    /**
     * 게시물 전체 url ex. /posts/boards/free/101
     *
     * @return string
     */
    public function getBoardFullPathAttribute(): string
    {
        return $this->board_part_path.($this->original_no ? '/'.$this->original_no : '');
    }

    public static function getBoardPartId($segment)
    {
        return array_search($segment, config('app.top_menus'), true);
    }

    /**
     * url 로 where 절 만들기
     * ex. /posts -> 1, /posts/free -> 1free
     *
     * @param  array  $params
     * @return string
     */
    public static function getWhereBoard(array $params): string
    {
        $board = '';
        if ($params['segment2']) {
            $board = self::getBoardPartId($params['segment2']);
        }
        if ($params['segment3']) {
            $board .= $params['segment3'];
        }
        //\Clockwork::info("\$params['url1']: {$params['url1']} / \$params['url1']: {$params['url2']}");
        //\Clockwork::info("\$board : {$board}");

        return $board;
    }

    /**
     * 타이블 뽑기
     * @param $params
     * @return string
     */
    public static function getTitle($params): string
    {
        if ($params['segment3']) {
            return config('app.sub_menus')[$params['segment2']]['child'][$params['segment3']] ?? '';
        }
        if ($params['segment2']) {
            return config('app.sub_menus')[$params['segment2']] ?? '';
        }
        return [
            'title' => '모두보기',
            'desc' => '',
        ];
    }
}
