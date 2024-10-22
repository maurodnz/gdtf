<?php

namespace Maurodnz\Gdtf;

use Exception;
use ZipArchive;

class Gdtf
{
    /**
     *
     * @var string
     */
    private $filepath;

    /**
     *
     * @var string
     */
    private $xml;

    public function __construct(string $path)
    {
        $this->filepath = $path;

        if (!file_exists($path) || pathinfo($path, PATHINFO_EXTENSION) !== 'gdtf') {
            throw new Exception("GDTF file is invalid or not found.");
        }

        $this->xml = $this->extract_definition_xml();
    }

    public function get_content()
    {
        return $this->xml;
    }

    private function extract_definition_xml()
    {
        $zip = new ZipArchive();

        if ($zip->open($this->filepath) === true) {
            $xml_index = $zip->locateName("description.xml");

            if ($xml_index === false) {
                throw new Exception("description.xml file missing.");
            }

            $content = $zip->getFromIndex($xml_index);
            $zip->close();

            return $content;
        } else {
            throw new Exception("Unable to open GDTF archive.");
        }
    }
}