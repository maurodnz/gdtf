<?php

namespace Gdtf\Type;

class ChannelSet extends BaseNode
{
    private string $name;
    private string $dmx_from;
    private float $physical_from;
    private float $physical_to;
    private int $wheel_slot_index;

    public function __construct($xml_node)
    {
        $this->name = $xml_node['Name'] ?? '';
        $this->dmx_from = $xml_node['DMXFrom'] ?? '';
        $this->physical_from = (float) $xml_node['PhysicalFrom'] ?? 0;
        $this->physical_to = (float) $xml_node['PhysicalTo'] ?? 0;
        $this->wheel_slot_index = (int) $xml_node['WheelSlotIndex'] ?? 1;
    }

    protected function read_xml($xml_node)
    {   
    }
}