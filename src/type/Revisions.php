<?php

namespace Gdtf\Type;

class Revisions extends BaseNode
{
    /**
     * Revision sorted descending from latest to earliest
     *
     * @var array
     */
    protected array $revisions = [];

    public function __construct($xml_node)
    {
        $this->read_xml($xml_node);
    }

    protected function read_xml($xml_node)
    {
        if ($xml_node->count() > 0) {
            foreach ($xml_node->children() as $revision)
                $this->revisions[] = (string) $revision['Date'];

            usort($this->revisions, function($a, $b) {
                return strtotime($b) - strtotime($a);
            });     
        }
    }

    public function get() : array
    {
        return $this->revisions;
    }
}