<?php

  namespace CymaticApi;

  require 'vendor/autoload.php';

  use CymaticApi\Config;
  use CymaticApi\Api;
  use CymaticApi\Idp;

  class Cymatic {

    private $config;
    private $api;

    public function __construct($options) {
      $this->config = Config::getInstance()->init($options);
      $this->api    = new Api();  
      $this->idp    = new Idp();  
    }

    public function verify ($body) {
      $accessToken = $this->idp->auth();
      $verification = $this->api->verify([
        "body"    => $body,
        "headers" => ["Authorization" => "Bearer ". $accessToken]
      ]);

      return $verification;
    }

  }
