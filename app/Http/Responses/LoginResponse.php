<?php

namespace App\Http\Responses;
use Illuminate\Support\Facades\Auth;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{
    /**
     * Create an HTTP response that represents the object.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function toResponse($request)
    {
        // $role = \Auth::user()->role;
        $role = 'admin';

        switch ($role) {
            case 'admin':
                return redirect('page/side-menu/light/seguimiento');
            case 'host':
                return redirect()->intended('/host/dashboard');
            default:
                return redirect('/');
        }

        return $request->wantsJson()
                    ? response()->json(['two_factor' => false])
                    : redirect()->intended(config('fortify.home'));
    }
}