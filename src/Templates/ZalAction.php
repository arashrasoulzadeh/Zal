<?php

namespace arashrasoulzadeh\Zal\Templates;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;

abstract class ZalAction extends ZalBase implements ZalActionInterface
{
    protected bool $private = false;

    public function render()
    {
        if ($this->method() != $this->method()) {
            abort(405);
        }
        if ($this->private) {
            if (!$this->user()) {
                return response([], 401);
            }
        }
        $data = $this->getRequest()->all();
        if (!is_null($this->id())) {
            $data['id'] = $this->id();
        }
        Validator::validate($data, $this->validation());

        if ($timeout = $this->cacheTimeout()) {
            return Cache::remember($this->cacheKey(), $timeout, function () {
                return $this->actionProxy($this->action());
            });
        }

        return $this->actionProxy($this->action());
    }
}
