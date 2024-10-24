<?php

namespace Gdtf\Type;

class DmxChannel extends BaseNode
{
    private int $dmx_break;
    private string $geometry;
    private string $highlight;
    private string $initial_function;
    private int $offset;
    private array $logical_channels;

    public function __construct($xml_node)
    {
        $this->dmx_break = (int) $xml_node['DMXBreak'];
        $this->geometry = (string) $xml_node['Geometry'];
        $this->highlight = (string) $xml_node['Highlight'];
        $this->initial_function = (string) $xml_node['InitialFunction'];
        $this->offset = (int) $xml_node['Offset'];

        $this->read_xml($xml_node);
    }

    protected function read_xml($xml_node)
    {
        $this->logical_channels = [];

        foreach ($xml_node->LogicalChannel as $node) {
            $this->logical_channels[] = new LogicalChannel($node);
        }
    }
}