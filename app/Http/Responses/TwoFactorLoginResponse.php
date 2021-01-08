<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\TwoFactorLoginResponse as TwoFactorLoginResponseContract;

class TwoFactorLoginResponse implements TwoFactorLoginResponseContract
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

        $role='admin';

        if ($request->wantsJson()) {
            return response('', 204);
        }

        switch ($role) {
            case 'admin':
                return redirect('/page/side-menu/light/seguimiento');
            case 'host':
                return redirect()->intended('/host/dashboard');
            default:
                return redirect('/');
        }
    }
}