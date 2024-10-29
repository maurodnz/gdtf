<?php

namespace Gdtf\Type;

class LogicalChannel extends BaseNode
{
    protected string $attribute;
    protected string $master;
    protected string $snap;
    protected array $channel_functions;

    public function __construct($xml_node)
    {        
        $this->attribute = (int) $xml_node['Attribute'];
        $this->master = (string) $xml_node['Master'];
        $this->snap = (string) $xml_node['Snap'];

        $this->read_xml($xml_node);
    }

    protected function read_xml($xml_node)
    {
        $this->channel_functions = [];

        foreach ($xml_node->ChannelFunction as $node) {
            $this->channel_functions[] = new ChannelFunction($node);
        }
    }

    public function getAttribute(): string { return $this->attribute; }
    public function getMaster(): string { return $this->master; }
    public function getSnap(): string { return $this->snap; }
    public function getChannelFunctions(): array { return $this->channel_functions; }
}