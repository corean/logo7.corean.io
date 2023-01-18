<?php

namespace App\Http\Controllers\Admin;

use App\Filters\MemberFilters;
use App\Http\Controllers\Controller;
use App\Http\Resources\MemberResource;
use App\Models\Member;
use Inertia\Inertia;

class MemberController extends Controller
{
    public function index(MemberFilters $filters)
    {
        $members = Member::filter($filters)
            // ->with('user')
            ->paginate(10)
            ->withQueryString();

        return MemberResource::collection($members);

        return Inertia::render('Admin/Members/Index',
            [
                'title'   => '회원'.(request('keyword') ? ' ?'.request('keyword') : ''),
                'form'    => ['keyword' => request('keyword', ''),],
                'members' => MemberResource::collection($members),
            ]);
    }
}
