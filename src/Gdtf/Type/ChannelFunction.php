<?php

namespace Gdtf\Type;

class ChannelFunction extends BaseNode
{
    protected string $attribute;
    protected string $name;
    protected string $dmx_from;
    protected string $default;
    protected string $mode_from;
    protected string $mode_to;
    protected string $physical_from;
    protected string $physical_to;
    protected array $channel_sets;

    public function __construct($xml_node)
    {
        $this->attribute = (string) $xml_node['Attribute'];
        $this->name = (string) $xml_node['Name'];
        $this->dmx_from = (string) $xml_node['DMXFrom'];
        $this->default = (string) $xml_node['Default'];
        $this->mode_from = (string) $xml_node['Min'];
        $this->mode_to = (string) $xml_node['Max'];
        $this->physical_from = (string) $xml_node['PhysicalFrom'];
        $this->physical_to = (string) $xml_node['PhysicalTo'];

        $this->read_xml($xml_node);
    }

    protected function read_xml($xml_node)
    {
        $this->channel_sets = [];

        foreach ($xml_node->ChannelSet as $node) {
            $this->channel_sets[] = new ChannelSet($node);
        }
    }

    public function getAttribute(): string { return $this->attribute; }
    public function getName(): string { return $this->name; }
    public function getDmxFrom(): string { return $this->dmx_from; }
    public function getDefault(): string { return $this->default; }
    public function getModeFrom(): string { return $this->mode_from; }
    public function getModeTo(): string { return $this->mode_to; }
    public function getPhysicalFrom(): string { return $this->physical_from; }
    public function getPhysicalTo(): string { return $this->physical_to; }
    public function getChannelSets(): array { return $this->channel_sets; }
}