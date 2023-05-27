<?php
    function callAPI(string $endpoint, string $method, array $data, array $headers = [])
    {
        $token = env('API_TOKEN');
        $baseUrl = 'http://localhost:9000'; //TODO: change to env variable
        $url = $baseUrl . $endpoint;
        $request = \Config\Services::curlrequest();

        $request->setHeader('Token', $token); //ALWAYS NEEDED TO ACCESS API
        if (!empty($headers)){
            foreach ($headers as $key => $value){
                $request->setHeader($key, $value);
            }
        }

        if (!empty($data)){
            $data = json_encode($data);
            $request->setBody($data);
        }

        $res = [];
        var_dump($data);
        try {
            $response = $request->request($method, $url, ['http_errors' => false]); //Disabling native Behaviour to panik when getting http errors
            $body = json_decode($response->getBody());
            if ($response->getStatusCode() != 200){
                $res['message'] = $body->message;
                $res['error'] = $body->error;
                var_dump($res);
            } else {
                foreach ($body as $key => $value){
                    $res[$key] = $value;
                }
            }

        } catch (\Exception $e) {
            $res = "Something went wrong. Please try again later.";
        }
        return $res;

    }

    function test(){
        printf("ok");
    }