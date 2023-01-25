<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;
use Tightenco\Ziggy\Ziggy;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function version(Request $request)
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed[]
     */
    public function share(Request $request)
    {
        return array_merge(parent::share($request), [
            'auth'     => [
                'user'        => fn() => $request->user(),
                'roles'       => fn() => $request->user() ? $request->user()->roles->pluck('name') : [],
                // 'permissions' => fn() => $request->user() ? $request->user()->getPermissionsViaRoles()->pluck('name') : [],
            ],
            'ziggy'    => fn() => array_merge((new Ziggy)->toArray(), [
                'location' => $request->url(),
            ]),
            'locale'   => fn() => app()->getLocale(),
            'language' => fn() => translations(
                resource_path('lang/'.app()->getLocale().'.json')
            ),
            'flash'    => [
                'message' => session('message'),
                'success' => session('success'),
                'info'    => session('info'),
                'warning' => session('warning'),
                'danger'  => session('danger'),
            ],
        ]);
    }
}
