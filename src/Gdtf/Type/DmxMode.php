<?php

namespace Gdtf\Type;

class DmxMode extends BaseNode
{
    protected string $name;
    protected array $channels;
    protected array $relations;

    public function __construct($xml_node)
    {
        $this->name = (string) $xml_node['Name'];

        $this->read_xml($xml_node);
    }

    protected function read_xml($xml_node)
    {
        if ($xml_node->DMXChannels) {
            $this->channels = [];
    
            foreach ($xml_node->DMXChannels[0] as $node) {
                $this->channels[] = new DmxChannel($node);
            }
        } else {
            $this->channels = [];
        }
    }

    public function getName() : string { return $this->name; }
    public function getChannels() : array { return $this->channels; }
    public function getRelations() : array { return $this->relations; }
    public function channels(bool $include_virtual = false) : int {
        $_counter = 0;

        foreach ($this->getChannels() as $c) {
            if ($c->isVirtual() && !$include_virtual) { continue; }
            $_counter++;
        }

        return $_counter;
    }
}