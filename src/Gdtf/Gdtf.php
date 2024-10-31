<?php

namespace Gdtf;

use Gdtf\Exception\InvalidFile;
use Gdtf\Exception\NotFound;

class Gdtf
{
    private string $filepath;
    private string $xml;

    public function __construct(string $path)
    {
        $this->filepath = $path;

        if (!file_exists($path)) {
            throw new NotFound("GDTF file not found in provided path.");
        }

        if (pathinfo($path, PATHINFO_EXTENSION) !== 'gdtf') {
            throw new InvalidFile("GDTF file is invalid.");
        }

        $zip = new \ZipArchive();

        if ($zip->open($this->filepath) === true) {
            $xml_index = $zip->locateName("description.xml");

            if ($xml_index === false) {
                throw new NotFound("description.xml file missing.");
            }

            $this->xml = $zip->getFromIndex($xml_index);
            $zip->close();
        } else {
            throw new InvalidFile("Unable to open GDTF archive.");
        }
    }

    public function get_content() : string
    {
        return $this->xml;
    }
}