<?php

namespace Deko96\AuthGG;

use Deko96\AuthGG\Classes\AdminApi;
use Deko96\AuthGG\Classes\UniversalApi;
class AuthGG
{

    protected $authorization;
    protected $apiKey;
    protected $aid;
    protected $secret;

    public function __construct()
    {
        $this->authorization = config('auth-gg.authorization');
        $this->apiKey = config('auth-gg.apikey');
        $this->aid = config('auth-gg.aid');
        $this->secret = config('auth-gg.secret');
    }

    public function universal()
    {
        return new UniversalApi($this->apiKey, $this->aid, $this->secret);
    }

    public function admin()
    {
        return new AdminApi($this->authorization);
    }
}
