<?php
    function callAPI(string $endpoint, string $method, array $data)
    {
        //TODO: add new argument to add headers
        $token = env('API_TOKEN');
        $baseUrl = 'http://localhost:9000';
        $url = $baseUrl . $endpoint;
        $request = \Config\Services::curlrequest();

        $request->setHeader('Token', $token);
        if (!empty($data)){
            $data = json_encode($data);
            $request->setBody($data);
        }

        $res = [];
        try {
            $response = $request->request($method, $url, ['http_errors' => false]); //Disabling native Behaviour to panik when getting http errors
            $body = json_decode($response->getBody());
            if ($response->getStatusCode() != 200){
                $res['message'] = $body->message;
                $res['error'] = $body->error;
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