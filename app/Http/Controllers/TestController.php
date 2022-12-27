<?php

namespace App\Http\Controllers;

use App\Traits\AddsToast;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TestController extends Controller
{
    use AddsToast;

    public function toast(Request $request)
    {
        // $this->addToast('Updated', 'Delicious champagne has been updated', 'success', false);
        $request->session()->flash('flash', [
            'success' => 'Delicious champagne has been updated',
        ]);
        return Inertia::render('Test/Toast', [
            'title2' => 'Toast Test',
        ]);
    }
}
