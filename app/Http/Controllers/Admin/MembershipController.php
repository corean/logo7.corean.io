<?php

namespace App\Http\Controllers\Admin;

use App\Filters\MembershipFilters;
use App\Http\Controllers\Controller;
use App\Http\Resources\MembershipResource;
use App\Models\Membership;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MembershipController extends Controller
{
    public function index(MembershipFilters $filters, Membership $membership = null)
    {
        $memberships = Membership::filter($filters)
            ->with('member')
            ->orderByRaw('ISNULL(confirmed_at) DESC, confirmed_at DESC, created_at DESC')
            ->paginate(10)->withQueryString();

        return Inertia::render('Admin/Memberships/Index',
            [
                'title'       => '연간회원'.(request('keyword') ? ' ?'.request('keyword') : ''),
                'form'     => ['keyword' => request('keyword', ''),],
                'memberships' => MembershipResource::collection($memberships),
                'membership'  => $membership ? new MembershipResource($membership) : null,
            ]);
    }

    /**
     * 연간회원 신청 처리
     *
     * @param  Request  $request
     * @param           $id
     * @return RedirectResponse
     */
    public function confirm(Request $request, $id)
    {
        $membership = Membership::findOrFail($id);
        $membership_result = $membership->confirm();

        $category = 'danger';
        $message = '오류가 발생했습니다';
        if ($membership_result) {
            $category = 'success';
            $message = '입금처리되었습니다.';
        }
        return redirect()->route('admin.memberships.index')
            ->with($category, $message);
    }

    /**
     * 연간회원 신청 취소처리
     *
     * @param  Membership  $membership
     * @return RedirectResponse
     */
    public function confirmCancel(Membership $membership)
    {
        $membership_result = $membership->confirmCancel(); // 거래취소

        $category = 'danger';
        $message = '오류가 발생했습니다';
        if ($membership_result) {
            $category = 'success';
            $message = '취소되었습니다.';
        }
        return redirect()->route('admin.memberships.index')
            ->with($category, $message);
    }

    /**
     * 연간회원 신청내역 삭제 처리
     *
     * @param  Membership  $membership
     * @return RedirectResponse
     */
    public function destroy(Membership $membership)
    {
        $membership_result = $membership->cancel();

        $category = 'danger';
        $message = '오류가 발생했습니다';
        if ($membership_result) {
            $category = 'success';
            $message = '삭제되었습니다.';
        }
        return redirect()->route('admin.memberships.index')
            ->with($category, $message);

    }
}
