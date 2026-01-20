<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\View as ViewAlias;
use Laravel\Sanctum\PersonalAccessToken;

class TokenController extends Controller
{
    public function saveToken(Request $request){

    }

    public function deleteToken()
    {

    }

    public function listTokens(): View
    {
        $tokens = auth()->user()->tokens()->paginate(5);

        return view('tokens.list', [
            'tokens' => $tokens,
        ]);
    }
}
