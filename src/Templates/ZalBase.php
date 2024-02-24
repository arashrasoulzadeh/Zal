<?php

namespace arashrasoulzadeh\Zal\Templates;

use Illuminate\Http\Request;
use Laravel\Sanctum\PersonalAccessToken;

define('GET', 'GET');
define('POST', 'POST');
define('PUT', 'PUT');
define('DELETE', 'DELETE');

abstract class ZalBase
{
    public function __construct(private Request $request, private $id)
    {
    }

    public function getRequest()
    {
        return $this->request;
    }

    public function id()
    {
        return $this->id;
    }

    public function method()
    {
        return $this->getRequest()->getMethod();
    }

    protected final function actionProxy($res)
    {
        /** @var Response $res */
        $res->header('Access-Control-Max-Age', $this->cacheTimeout());
        $res->headers->set('Cache-Control', 'max-age');
        $res->header('X-Routed-By', 'Zal');
        return $res;
    }



    public function cacheTimeout(): int
    {
        return 0;
    }

    public function cacheKey(): string
    {
        return $this::class;
    }

    public function param($key, $default = null)
    {
        if ($key == 'id') {
            if (!is_null($this->id())) {
                return $this->id();
            }
        }
        return $this->getRequest()->$key ?? $default;
    }

    public function user()
    {
        $request = $this->getRequest();
        $token = $request->bearerToken();
        if ($token && $user = PersonalAccessToken::findToken($token)) {
            return $user;
        }

        return null;
    }
}
