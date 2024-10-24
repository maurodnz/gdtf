<?php

namespace Gdtf\Type;

class LogicalChannel extends BaseNode
{
    private string $attribute;
    private string $master;
    private string $snap;
    private array $channel_functions;

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
}