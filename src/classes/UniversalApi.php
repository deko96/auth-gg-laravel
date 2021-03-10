<?php

namespace Deko96\AuthGG\Classes;

use Exception;
class UniversalApi extends Api
{

  protected $apiKey;
  protected $aid;
  protected $secret;

  function __construct($apiKey, $aid, $secret)
  {
    if (!$apiKey) {
      throw new Exception('Parameter $apiKey is required in order to use the universal API.');
    }

    if (!$aid) {
      throw new Exception('Parameter $aid is required in order to use the universal API.');
    }

    if (!$secret) {
      throw new Exception('Parameter $secret is required in order to use the universal API.');
    }

    $this->apiUrl = "https://api.auth.gg/v1/";
    $this->apiKey = $apiKey;
    $this->aid = $aid;
    $this->secret = $secret;
  }

  /**
   * Application Information - Receive information about your application
   * 
   * @return \Illuminate\Http\Client\Response
   */
  public function applicationInfo()
  {
    $parameters['type'] = 'info';

    return $this->request("/", $parameters);
  }

  /**
   * Login - Login and receive variables after a successful login
   * @param array $parameters Query Parameters
   * 
   * @return \Illuminate\Http\Client\Response
   */
  public function login(array $parameters)
  {
    $this->validate($parameters, [
      'hwid' => 'required',
      'password' => 'required',
      'username' => 'required',
    ]);

    $parameters['type'] = 'login';

    return $this->request("/", $parameters);
  }

  /**
   * Register - Register a user using a license key
   * @param array $parameters Query Parameters
   * 
   * @return \Illuminate\Http\Client\Response
   */
  public function register(array $parameters)
  {
    $this->validate($parameters, [
      'hwid' => 'required',
      'email' => 'required|email',
      'license' => 'required',
      'password' => 'required',
      'username' => 'required',
    ]);

    $parameters['type'] = 'register';

    return $this->request("/", $parameters);
  }

  /**
   * Extend Subscription - Extend users' subscription
   * @param array $parameters Query Parameters
   * 
   * @return \Illuminate\Http\Client\Response
   */
  public function extendSubscription(array $parameters)
  {
    $this->validate($parameters, [
      'hwid' => 'required',
      'license' => 'required',
      'password' => 'required',
      'username' => 'required',
    ]);

    $parameters['type'] = 'extend';

    return $this->request("/", $parameters);
  }

  /**
   * Forgot Password - Send user an email regarding a password reset
   * @param array $parameters Query Parameters
   * 
   * @return \Illuminate\Http\Client\Response
   */
  public function forgotPassword(array $parameters)
  {
    $this->validate($parameters, [
      'username' => 'required'
    ]);

    $parameters['type'] = 'forgotpw';

    return $this->request("/", $parameters);
  }

  /**
   * Change Password - Change users' password
   * @param array $parameters Query Parameters
   * 
   * @return \Illuminate\Http\Client\Response
   */
  public function changePassword(array $parameters)
  {
    $this->validate($parameters, [
      'newpassword' => 'required',
      'password' => 'required',
      'username' => 'required'
    ]);

    $parameters['type'] = 'changepw';

    return $this->request("/", $parameters);
  }

  /**
   * Change Password - Change users' password
   * @param string $action Action you want logged ex; (Successful login)
   * @param string $username Username
   * [@param] $pcUser PC Username
   * @return \Illuminate\Http\Client\Response
   */
  public function log(string $action, string $username, $pcUser = null)
  {
    if (!$pcUser) $pcUser = config('app.name');
    
    $parameters['type'] = 'log';
    $parameters['action'] = $action;
    $parameters['username'] = $username;
    $parameters['pcuser'] = $pcUser;

    return $this->request("/", $parameters);
  }

  protected function defaults()
  {
    return [
      'aid' => $this->aid,
      'secret' => $this->secret,
      'apikey' => $this->apiKey
    ];
  }

  protected function method()
  {
    return "post";
  }
  
}
