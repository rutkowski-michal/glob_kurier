<?php
declare(strict_types=1);

namespace AppBundle\Service;


use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class AliPaczkaClient
{

    /**
     * @var Client
     */
    private $guzzleClient;

    /**
     * AliPaczkaClient constructor.
     */
    public function __construct()
    {
        $this->guzzleClient = new Client([
            'base_uri' => 'https://alipaczka.pl/mobileAPI2.php'
        ]);
    }


    /**
     * @param $list
     * @return array
     */
    public function getTrackDelivery($list): array
    {
        $numberList = explode(',', $list);
        $trackingList = [];
        foreach ($numberList as $number) {
            try {
                $request = $this->guzzleClient->get('?number=' . $number, ['content-type' => 'application/json']);
                $response = \GuzzleHttp\json_decode($request->getBody(), true);
                $trackingList[] = $this->buildTrackingList($response['trackingNumber'], $response['DataEntry']);
            } catch (ClientException $clientException) {
                $trackingList[] = [trim($number) => ['Nie udało się połączyć z serwerem przewoźnika.']];

            }
        }

        return $trackingList;

    }

    /**
     * @param $number
     * @param array $tracking
     * @return array[]
     */
    private function buildTrackingList($number, array $tracking): array
    {
        return [
            $number => $this->sortByTime($tracking)
        ];

    }

    /**
     * @param array $list
     * @return array
     */
    private function sortByTime(array $list): array
    {
        foreach ($list as $key => $val) {
            $time[$key] = $val['time'];
        }
        array_multisort($time, SORT_DESC, $list);

        return $list;
    }

}