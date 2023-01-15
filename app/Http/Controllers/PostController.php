<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;

class PostController extends Controller
{
    public function index($segment2 = null, $segment3 = null)
    {
        $segments = [
            'segment1' => 'posts',
            'segment2' => $segment2,
            'segment3' => $segment3,
        ];

        Log::debug('PostController@index', $segments);
    }
}
