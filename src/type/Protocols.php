<?php

namespace Gdtf\Type;

class Protocols extends BaseNode
{
    protected array $protocols = [];

    public function __construct($xml_node)
    {
        $this->read_xml($xml_node);
    }

    protected function read_xml($xml_node)
    {
        if ($xml_node->FTRDM) {
            $this->protocols['RDM'] = [
                'ManufacturerID' => (string) $xml_node->FTRDM['ManufacturerID'],
                'DeviceModelID' => (string) $xml_node->FTRDM['DeviceModelID'],
            ];
        }
    }

    public function get() : array
    {
        return $this->protocols;
    }

    public function getRDM() : array
    {
        return array_key_exists('RDM', $this->protocols) ? $this->protocols['RDM'] : [];
    }
}