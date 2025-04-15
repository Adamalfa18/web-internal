<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Crypt;

class EncryptDecryptMiddleware
{
    public function handle($request, Closure $next)
    {
        // Dekripsi parameter sebelum request diproses
        if ($request->has('client_id')) {
            $request->merge(['client_id' => Crypt::decrypt($request->input('client_id'))]);
        }

        if ($request->has('layanan')) {
            $request->merge(['layanan' => Crypt::decrypt($request->input('layanan'))]);
        }

        $response = $next($request);

        // Enkripsi parameter sebelum response dikirim
        if ($response->isRedirection()) {
            $response->setTargetUrl(
                str_replace(
                    [$request->input('client_id'), $request->input('layanan')],
                    [Crypt::encrypt($request->input('client_id')), Crypt::encrypt($request->input('layanan'))],
                    $response->getTargetUrl()
                )
            );
        }

        return $response;
    }
}
