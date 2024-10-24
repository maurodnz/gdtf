<?php

namespace Gdtf\Type;

abstract class BaseNode
{
    abstract public function __construct(\SimpleXMLElement $xml_node);
    abstract protected function read_xml(\SimpleXMLElement $xml_node);
}