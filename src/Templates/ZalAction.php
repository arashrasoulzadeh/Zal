<?php

namespace arashrasoulzadeh\Zal\Templates;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;
use Laravel\Sanctum\PersonalAccessToken;

abstract class ZalAction extends ZalBase implements ZalActionInterface
{
    protected bool $private = false;

    public function render()
    {
        //TODO : use base class method helpers
        if ($this->method() != strtolower($this->method())) {
            abort(405);
        }
        if ($this->private) {
            if (! $this->user()) {
                return response([], 401);
            }
        }
        $data = $this->getRequest()->all();
        if (! is_null($this->id())) {
            $data['id'] = $this->id();
        }
        Validator::validate($data, $this->validation());

        if ($timeout = $this->cacheTimeout()) {
            return Cache::remember($this->cacheKey(), $timeout, function () {
                return $this->actionProxy();
            });
        }

        return $this->actionProxy();
    }

    final protected function actionProxy()
    {
        /** @var Response $res */
        $res = $this->action();
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
            if (! is_null($this->id())) {
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
