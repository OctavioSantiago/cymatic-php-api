<?php

  namespace CymaticApi;
  
  use Cymatic\Config\index;
  use GuzzleHttp\Client;
  
  class Api {

    public function __construct() {}

    public function register ($options) {
      try {
        $config = Config::getInstance();  
        // TODO: add validations
        $client = new Client([
          'base_uri' => $config->getApiUrl()
        ]);

        $response = $client->request("POST", "/profiles", $options);
        $body     = $response->getBody();
        return    $body;
      } catch (\Throwable $th) {
        echo $th;
        return [
          "error" => $th,
          "code" => 400
        ];
      }

    }

    public function verify ($data) {
      try {
        $config = Config::getInstance();  
        // TODO: add validations
        $client = new Client([
          'base_uri' => $config->getApiUrl()
        ]);

        $response = $client->request("POST", "/verify", [
          "form_params" => $data["body"],
          "headers"     => $data["headers"]
          ]);
        $body     = $response->getBody();
        $body     = json_decode($body, true);
        return    $body;
      } catch (\Throwable $th) {
        echo $th;
        return [
          "error" => $th,
          "code" => 400
        ];
      }

    }

  }
