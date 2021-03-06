<?php

namespace Juno\Writer;

use Ddeboer\DataImport\Writer\WriterInterface;
use GuzzleHttp\Client;
use GuzzleHttp\Cookie\FileCookieJar;
use GuzzleHttp\Exception\RequestException;


/**
 * @property  client
 */
class ApiWriter implements WriterInterface {

    protected $client;
    protected $cookieJar;

    /**
     * Prepare the Writer before writing the items
     *
     * @return $this
     */
    public function prepare()
    {
        $this->client = new Client(
            array(
                'base_uri' => 'http://tracker.juno.is',
                'debug' => true,
                'cookies' => true
            )
        );

    }

    /**
     * Write one data item
     *
     * @param array $item The data item with converted values
     *
     * @return $this
     */
    public function writeItem(array $item)
    {
        if ($item['text']["endpoint"] != null) {
            $this->cookieJar = new FileCookieJar("sessions/".$item['user_id']);

            try {
                $response = $this->client->request($item['text']["requestType"], $item['text']["endpoint"], ['cookies' => $this->cookieJar]);
            } catch (RequestException $e) {

                echo $e->getMessage();

            }

        }
    }

    /**
     * Wrap up the Writer after all items have been written
     *
     * @return $this
     */
    public function finish()
    {
        // TODO: Implement finish() method.
    }


}