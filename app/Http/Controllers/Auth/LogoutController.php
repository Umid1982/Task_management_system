<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    public function __invoke()
    {
        auth()->user()->currentAccessToken()->delete();
        return response()->json([
            'message' => 'User successfully logout'
        ]);
    }
}
