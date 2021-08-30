<?php

  namespace CymaticApi;

  use CymaticApi\Config;
  use GuzzleHttp\Client;
  
  class Idp {

    private $endpoint;
    private $authHeader;
    private $accessToken = false;
    private $payload;

    public function __construct() {
      $tenant = Config::getInstance()->getTenant(); 
      $idpUrl = Config::getInstance()->getApiIdp(); 

      $this->endpoint   = $idpUrl."/auth/realms/".$tenant["name"]."/protocol/openid-connect/token";
      $this->authHeader = "Basic ". base64_encode($tenant["clientId"]. ":" .$tenant["secret"]);
    }

    // TODO: check expiration date
    public function auth () {
      try {
        $token = $this->fetchToken();
        $this->parseToken($token);
        return $this->accessToken;
      } catch (\Throwable $th) {
        return ["error" => $th];
      }
    }

    public function parseToken ($token) {
        $data = explode(".", $token["access_token"])[1];
        $data = base64_decode($data);
        $this->payload = ["data" => $data];
        $this->accessToken = $token["access_token"];
    }

    public function fetchToken () {
      try {
        $config = Config::getInstance();  
        // TODO: add validations
        $client = new Client();

        $response = $client->post(
          $this->endpoint,
          [
            "form_params" => ["grant_type" => "client_credentials"],
             "headers"    => ["Authorization" => $this->authHeader]
          ]
      );

        $body = $response->getBody();
        $body = json_decode($body, true);

        $this->parseToken($body);
        return $body;
      } catch (\Throwable $th) {
        echo $th;
        return [
          "error" => $th,
          "code" => 400
        ];
      }

    }

  }
