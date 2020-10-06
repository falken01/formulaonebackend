<?php


namespace App\Service\ServiceFetchSupporter;

use Symfony\Component\Serializer\SerializerInterface;

class ServiceFetchSupporter
{
    private $dataObject;
    public function __construct($dataObject)
    {
        $this->dataObject = $dataObject;
    }
    public function deCirculation($serializer)
    {
       return $serializer->serialize($this->dataObject, 'json', [
            'circular_reference_handler' => function ($object) {
                return $object->getId();
            }
       ]);
    }
}