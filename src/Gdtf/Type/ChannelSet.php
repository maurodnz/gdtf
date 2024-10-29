<?php

namespace Gdtf\Type;

class ChannelSet extends BaseNode
{
    protected string $name;
    protected string $dmx_from;
    protected float $physical_from;
    protected float $physical_to;
    protected int $wheel_slot_index;

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

    public function getName(): string { return $this->name; }
    public function getDmxFrom(): string { return $this->dmx_from; }
    public function getPhysicalFrom(): float { return $this->physical_from; }
    public function getPhysicalTo(): float { return $this->physical_to; }
    public function getWheelSlotIndex(): int { return $this->wheel_slot_index; }

}