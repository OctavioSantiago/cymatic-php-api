<?php

namespace CymaticApi;

class Config {

  private static $instance;

  private $cymatic = [
    "api" => "https://api.cymaticsecurity.com",
    "idp" => "https://sso.cymaticsecurity.com"
  ];

  private $tenant = [
    "name"     => "",
    "clientId" => "",
    "secret"   => ""
  ];


  /*
    override settings
  */
  public function __construct() {}

  public function init ($options) {
    $this->tenant["name"]     = $options["tenant"]["name"];
    $this->tenant["clientId"] = $options["tenant"]["clientId"];
    $this->tenant["secret"]   = $options["tenant"]["secret"];

    if (isset($options["cymatic"])) {
      $this->cymatic["api"] = $options["cymatic"]["api"];
      $this->cymatic["idp"] = $options["cymatic"]["idp"];
    }
  }

  public static function getInstance() {
      if (!self::$instance instanceof self) {
          self::$instance = new self();
      }
      return self::$instance;
  }

  public function getApiUrl () {
    return $this->cymatic["api"];
  }

  public function getApiIdp () {
    return $this->cymatic["idp"];
  }

  public function getTenant () {
    return $this->tenant;
  }

}
