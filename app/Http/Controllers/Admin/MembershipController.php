<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Membership;
use Inertia\Inertia;

class MembershipController extends Controller
{
    public function index()
    {
        $memberships = Membership::query()
            ->orderByRaw('ISNULL(confirmed_at) DESC, confirmed_at DESC, created_at DESC')
            ->with('member')
            ->paginate(10);

        return Inertia::render('Admin/Memberships/Index', ['memberships' => $memberships]);
    }
}
