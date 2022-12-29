<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\MembershipResource;
use App\Models\Membership;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
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
            ->paginate(20);

        return Inertia::render('Admin/Memberships/Index',
            [
                'title'       => '연간회원'.($search ? " ?{$search}" : ''),
                'memberships' => MembershipResource::collection($memberships),
                'search'      => $search,
            ]);
    }

    /**
     * 연간회원 신청 처리
     *
     * @param  Request  $request
     * @param           $id
     * @return JsonResponse|RedirectResponse
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
     * @param  Request  $request
     * @param           $id
     * @return JsonResponse|RedirectResponse
     */
    public function confirmCancel(Request $request, $id)
    {
        $membership = Membership::findOrFail($id);
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
     * @param  Request  $request
     * @return JsonResponse|RedirectResponse
     */
    public function destroy(Request $request, $id)
    {
        $membership = Membership::findOrFail($id);
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
