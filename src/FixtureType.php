<?php

namespace Gdtf;

use Gdtf\Type\DmxMode;
use Gdtf\Type\Protocols;
use Gdtf\Type\Revisions;
use SimpleXMLElement;

class FixtureType
{
    private $_root;

    protected string $name;
    protected string $short_name;
    protected string $long_name;
    protected string $manufacturer;
    protected string $description;
    protected string $fixture_type_id;

    protected array $dmx_modes;
    protected array $revisions;
    protected array $protocols;

    public function __construct(string $xml)
    {
        $this->_root = new SimpleXMLElement($xml);

        if ($this->_root->FixtureType)
            $this->read_xml();
    }

    protected function read_xml()
    {
        $this->name = (string) $this->_root->FixtureType['Name'];
        $this->short_name = (string) $this->_root->FixtureType['ShortName'];
        $this->long_name = (string) $this->_root->FixtureType['LongName'];
        $this->manufacturer = (string) $this->_root->FixtureType['Manufacturer'];
        $this->description = (string) $this->_root->FixtureType['Description'];
        $this->fixture_type_id = (string) $this->_root->FixtureType['FixtureTypeID'];

        $dmx_mode_collect = $this->_root->FixtureType->DMXModes;
        
        if ($dmx_mode_collect) {
            $this->dmx_modes = [];
            
            foreach ($dmx_mode_collect[0]->DMXMode as $dmx_mode) {
                $this->dmx_modes[] = new DmxMode($dmx_mode);
            }
        } else {
            $this->dmx_modes = [];
        }

        $this->revisions = (new Revisions($this->_root->FixtureType?->Revisions))->get();
        $this->protocols = (new Protocols($this->_root->FixtureType?->Protocols))->get();
    }

    public function getName(): string { return $this->name; }
    public function getShortName(): string { return $this->short_name; }
    public function getLongName(): string { return $this->long_name; }
    public function getManufacturer(): string { return $this->manufacturer; }
    public function getDescription(): string { return $this->description; }
    public function getFixtureTypeId(): string { return $this->fixture_type_id; }
    public function getDmxModes(): array { return $this->dmx_modes; }
    public function getRevisions(): array { return $this->revisions; }
    public function getProtocols(): array { return $this->protocols; }
}