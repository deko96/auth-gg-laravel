<?php

namespace Deko96\AuthGG\Classes;

use Exception;

class AdminApi extends Api
{
  protected $authorization;

  function __construct($authorization)
  {
    if (!$authorization) {
      throw new Exception('Parameter $authorization is required in order to use the admin API.');
    }

    $this->apiUrl = "https://developers.auth.gg";
    $this->authorization = $authorization;
  }

  /**
   * Users - This endpoint allows you to manage your users information.
   * @param array $parameters Query Parameters
   * 
   * @return \Illuminate\Http\Client\Response
   */
  public function users(array $parameters)
  {
    $this->validate($parameters, [
      'type' => 'required|in:fetch,fetchall,delete,editvar,editrank,changepw,count',
    ]);

    return $this->request("/USERS", $parameters);
  }

  /**
   * Licenses - This endpoint allows you to manage your licenses
   * @param array $parameters Query Parameters
   * 
   * @return \Illuminate\Http\Client\Response
   */
  public function licenses(array $parameters)
  {
    $this->validate($parameters, [
      'type' => 'required|in:fetch,fetchall,delete,use,unuse,generate,count',
    ]);

    return $this->request("/LICENSES", $parameters);
  }

  /**
   * HWID - This endpoint allows you to manage your users HWID.
   * @param array $parameters Query Parameters
   * 
   * @return \Illuminate\Http\Client\Response
   */
  public function hwid(array $parameters)
  {
    $this->validate($parameters, [
      'type' => 'required|in:fetch,reset,set',
      'user' => 'required'
    ]);

    return $this->request("/HWID", $parameters);
  }

  protected function defaults() {
    return [
      'authorization' => $this->authorization
    ];
  }
  
}
