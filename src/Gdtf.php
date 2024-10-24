<?php

namespace Gdtf;

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

    public $fixture;

    public function __construct(string $path)
    {
        $this->filepath = $path;

        if (!file_exists($path) || pathinfo($path, PATHINFO_EXTENSION) !== 'gdtf') {
            throw new Exception("GDTF file is invalid or not found.");
        }

        $zip = new ZipArchive();

        if ($zip->open($this->filepath) === true) {
            $xml_index = $zip->locateName("description.xml");

            if ($xml_index === false) {
                throw new Exception("description.xml file missing.");
            }

            $this->xml = $zip->getFromIndex($xml_index);
            $zip->close();
        } else {
            throw new Exception("Unable to open GDTF archive.");
        }
    }

    public function get_content()
    {
        return $this->xml;
    }
}