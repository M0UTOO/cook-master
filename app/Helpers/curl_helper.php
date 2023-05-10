<?php
    function callAPI($endpoint, $method, $data)
    {
        $token = env('API_TOKEN');
        $baseUrl = 'http://localhost:9000';
        $url = $baseUrl . $endpoint;
        $header = 'Token: ' . $token;

        $request = \Config\Services::curlrequest();

        $request->setHeader('Token', $token);
        if ($data != ''){
            $request->setBody($data);
        }

        $response = $request->request($method, $url);
        //echo $response->getBody();
        $body = json_decode($response->getBody());
        $data = [];
        foreach ($body as $key => $value){
            $data[$key] = $value;
        }
        return $data;

    }

    function test(){
        printf("ok");
    }