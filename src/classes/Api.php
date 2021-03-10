<?php

namespace Deko96\AuthGG\Classes;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Response;
use Exception;

class Api {

  protected $apiUrl;

  /**
   * @param array $parameters Query Parameters
   * @param array $parameters Validation Rules
   * 
   * @throws Exception
   * @return null
   */
  protected function validate($parameters, $rules)
  {
    $validator = Validator::make($parameters, $rules);

    if ($validator->fails()) {
      $error = $validator->errors()->first();
      throw new Exception($error);
    }
  }

  /**
   * @param string $endpoint Auth.gg Admin Endpoint
   * @param array $parameters Query Parameters
   * 
   * @return \Illuminate\Http\Client\Response
   */
  protected function request($endpoint, $parameters): Response
  {
    $builder = Http::acceptJson();
    $url = $this->buildApiUrl($endpoint);
    $defaults = $this->defaults();
    $parameters = array_merge($parameters, $defaults);
    $method = $this->method();

    if ($method === "post") {
      $builder = $builder->asForm();
    }
    
    return $builder->{$method}($url, $parameters);
  }

  /**
   * @return array
   */
  protected function defaults()
  {
    return [];
  }

  /**
   * @return string
   */
  protected function method()
  {
    return "get";
  }

  private function buildApiUrl($endpoint)
  {
    $apiUrl = $this->apiUrl;
    
    if ($endpoint) {
      $apiUrl .= $endpoint;
    }

    return $apiUrl;
  }

}