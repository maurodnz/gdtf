<?php

namespace Gdtf\Type;

class DmxChannel extends BaseNode
{
    protected int $dmx_break;
    protected string $geometry;
    protected string $highlight;
    protected string $initial_function;
    protected int $offset;
    protected array $logical_channels;
    
    private bool $_virtual;

    public function __construct($xml_node)
    {
        $this->dmx_break = (int) $xml_node['DMXBreak'];
        $this->geometry = (string) $xml_node['Geometry'];
        $this->highlight = (string) $xml_node['Highlight'];
        $this->initial_function = (string) $xml_node['InitialFunction'];
        $this->offset = (int) $xml_node['Offset'];

        $this->_virtual = ($this->offset == 0);

        $this->read_xml($xml_node);
    }

    protected function read_xml($xml_node)
    {
        $this->logical_channels = [];

        foreach ($xml_node->LogicalChannel as $node) {
            $this->logical_channels[] = new LogicalChannel($node);
        }
    }

    public function getDmxBreak(): int { return $this->dmx_break; }
    public function getGeometry(): string { return $this->geometry; }
    public function getHighlight(): string { return $this->highlight; }
    public function getInitialFunction(): string { return $this->initial_function; }
    public function getOffset(): int { return $this->offset; }
    public function getLogicalChannels(): array { return $this->logical_channels; }
    public function isVirtual() : bool { return $this->_virtual; }
}