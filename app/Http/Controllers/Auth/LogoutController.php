<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class LogoutController extends Controller
{
    public function __invoke()
    {
        /** @var Activity  $userAuth */
        $userAuth = auth()->user();
        activity($userAuth->email)->log('user logged out');
        auth()->user()->currentAccessToken()->delete();
        return response()->json([
            'message' => 'User successfully logout'
        ]);
    }
}
