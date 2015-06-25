<?php

namespace Juno;

ini_set("display_errors", true);

use Ddeboer\DataImport\Workflow;

class Handler
{
    protected $postData;
    private $workflow;
    private $reader;
    private $writer;

    public function __construct($reader = null, $writer = null)
    {

        $this->reader = $reader;
        $this->workflow = new Workflow($reader);
        $this->workflow->addValueConverter('text', new YoutrackValueConverter());
        $this->writer = $writer;
        $this->workflow->addWriter($writer);

    }

    /**
     * @return array
     */
    public function getPostData()
    {
        return $this->postData;
    }

    /**
     * @param array $postData
     */
    public function setPostData($postData)
    {
        $this->postData = $postData;
    }

    public function run() {

        $this->workflow->process();

    }

}



