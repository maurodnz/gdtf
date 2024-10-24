<?php

namespace Gdtf\Type;

class ChannelFunction extends BaseNode
{
    private string $attribute;
    private string $name;
    private string $dmx_from;
    private string $default;
    private string $mode_from;
    private string $mode_to;
    private string $physical_from;
    private string $physical_to;
    private array $channel_sets;

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
}