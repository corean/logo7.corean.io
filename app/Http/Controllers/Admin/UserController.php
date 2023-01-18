<?php

namespace App\Http\Controllers\Admin;

use App\Filters\UserFilters;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Inertia\Inertia;

class UserController extends Controller
{
    public function index(UserFilters $filters)
    {
        $users = User::filter($filters)
            // ->with('roles')
            ->paginate(10)
            ->withQueryString();

        return Inertia::render('Admin/Users/Index',
            [
                'title' => '회원'.(request('keyword') ? ' ?'.request('keyword') : ''),
                'form'  => ['keyword' => request('keyword', ''),],
                'users' => UserResource::collection($users),
                // 'roles'       => RoleResource::collection(Role::all()),
                // 'permissions' => PermissionResource::collection(Permission::all()),
            ]);
    }
}
