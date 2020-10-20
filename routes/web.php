<?php

use GuzzleHttp\Client;


/** @var \Laravel\Lumen\Routing\Router $router */


$router->get('/', function () use ($router) {


    $Request = '
    <soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:sch="http://wso2.org/bps/management/schema">
            <soapenv:Header/>
            <soapenv:Body>
                <sch:getPaginatedInstanceListInput>
                <sch:filter>status=FAILED</sch:filter>
                <sch:order>pid</sch:order>
                <sch:limit>10</sch:limit>
                <sch:page>0</sch:page>
            </sch:getPaginatedInstanceListInput>
        </soapenv:Body>
    </soapenv:Envelope>';


    $client = new Client();

    $r = $client->request('POST', 'http://34.222.20.42:9763/services/InstanceManagementService/getPaginatedInstanceList', [
        'auth' => [
            'admin',
            'admin',
        ],
        'body' => $Request
    ]);
    
    
        
    return $r->getBody();




    

    //echo $response->getBody();

    return $router->app->version();
});



$router->get('API', [
    'uses'=>"ReportController@index"
]);


$router->get('API/instancias',"DataController@getInstanceSummary");
$router->get('API/PaginatedInstanceList',"DataController@getPaginatedInstanceList");

