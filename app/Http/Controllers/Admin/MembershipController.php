<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\MembershipResource;
use App\Models\Membership;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MembershipController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $memberships = Membership::query();
        if ($request->input('search')) {
            $memberships = $memberships->where(
                'chargename',
                'like',
                '%'.$search.'%'
            );
        }

        $memberships = $memberships
            ->with('member')
            ->orderByRaw('ISNULL(confirmed_at) DESC, confirmed_at DESC, created_at DESC')
            ->paginate(10);

        return Inertia::render('Admin/Memberships/Index',
            [
                'title'      => '연간회원'.($search ? " ?{$search}" : ''),
                'memberships' => MembershipResource::collection($memberships),
                'search'      => $search,
            ]);
    }
}
