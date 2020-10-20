<?php

namespace App\Models;

use GuzzleHttp\Client;
use SimpleXMLElement;

class Data
{

    public static function InstanceSummary()
    {

        $soapRequest = <<<XML
        <soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/">
       <soapenv:Header/>
       <soapenv:Body/>
    </soapenv:Envelope>

    XML;

        $client = new Client([

            'base_uri' => 'http://34.222.20.42:9763/services/InstanceManagementService/getInstanceSummary',
            'headers' => ['Content-Type' => 'application/xml'],
            'auth' => [
                'admin',
                'admin',
            ],
            'body' => $soapRequest,

        ]);

        $response = $client->request('GET');
        $stringBody = (string) $response->getBody()->getContents();
        //var_dump($response);
        //$data = json_encode($response);

        $xml = simplexml_load_string($stringBody);
        $namespacesMeta = $xml->getNamespaces(true);
        $officeXML = $xml->children($namespacesMeta['ns1']);
        $active = (string) $officeXML->{'active'};
        $completed = (string) $officeXML->{'completed'};
        $terminated = (string) $officeXML->{'terminated'};
        $failed = (string) $officeXML->{'failed'};
        $suspended = (string) $officeXML->{'suspended'};

        $array = array($active, $completed, $terminated, $failed, $suspended);

        return $array;
//        print_r($array);

        /*
    echo ("activos: $active<br/>");
    echo ("completos: $completed<br/>");
    echo ("terminados: $terminated<br/>");
    echo ("fallidos: $failed<br/>");
    echo ("suspendidos: $suspended<br/>");
     */

    }

    public static function PaginatedInstanceList()
    {

        $Request = <<<XML
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
        </soapenv:Envelope>

    XML;

        $client = new Client();

        $response = $client->request('POST', 'http://34.222.20.42:9763/services/InstanceManagementService/getPaginatedInstanceList', [
            'auth' => [
                'admin',
                'admin',
            ],
            'body' => $Request,
        ]);

        $stringBody = (string) $response->getBody()->getContents();

        $sxe = new SimpleXMLElement($stringBody);

        //obtener todos los valores de cada failed pid
        $sxe->registerXPathNamespace('ns1', 'http://wso2.org/bps/management/schema');
        $iid = $sxe->xpath('//ns1:iid');
        $pid = $sxe->xpath('//ns1:pid');
        $dateStarted = $sxe->xpath('//ns1:dateStarted');

        $arrayiid = array();
        $arraypid = array();
        $arraydateStarted = array();
        foreach ($iid as $resultado) {

            //echo $resultado . "\n";
            
            $arrayiid['iid'] = (string)$resultado;
            $data[] = $arrayiid;

        }


        foreach ($pid as $resultado) {

            //echo $resultado . "\n";
            $arraypid['pid'] = (string)$resultado;
             $data[] = $arraypid;

        }
        foreach ($dateStarted as $resultado) {

            //echo $resultado . "\n";
            $arraydateStarted['dateStarted'] = (string)$resultado;
            $data[] = $arraydateStarted;


        }
        
        $json = json_encode($data);
        //$json = json_encode(['items' => $data]);

        return $json;

    }

}
