<?php
require_once("yacht.php");

class Yachts
{
    const yachtsPath = "data/yachts.xml";

    private static $instance;

    private $xml;

    public static function get()
    {
        if (!isset(self::$instance)) {
            self::$instance = new Yachts();
        }
        return self::$instance;
    }

    private static function getYachts()
    {
        $yachts = simplexml_load_file(Yachts::yachtsPath) or die("Error: didn't find file with yachts.");
        return $yachts;
    }

    private function __construct()
    {
        $this->xml = Yachts::getYachts();
    }

    function findYacht($id)
    {
        foreach ($this->xml->yacht as $yacht) {
            if ($yacht["id"] == $id) {
                $foundYacht = $yacht;
                break;
            }
        }
        if (!isset($foundYacht)) {
            http_response_code(404);
            include("not_found.html");
            die();
        }
        return Yacht::parseFromXml($foundYacht);
    }

    function addYacht(Yacht $yacht)
    {
        $xmlYacht = $this->xml->addChild("yacht", "");
        $xmlYacht->addChild("title", $yacht->title);
        $xmlYacht->addChild("description", $yacht->description);
        $xmlYacht->addChild("price", $yacht->price);
        $featuresElement = $xmlYacht->addChild("features");
        foreach ($yacht->features as $feature) {
            $featuresElement->addChild("feature", $feature);
        }
        $xmlYacht->addAttribute("id", self::nextId());

        $this->saveYachts();
    }

    function updateYacht(Yacht $updatingYacht)
    {
        foreach ($this->xml->yacht as $yacht) {
            if ($yacht["id"] == $updatingYacht->id) {
                $yacht->title = $updatingYacht->title;
                $yacht->description = $updatingYacht->description;
                $yacht->price = $updatingYacht->price;
                $yacht->features = new SimpleXMLElement("<features></features>");
                foreach ($updatingYacht->features as $feature) {
                    $yacht->features->addChild("feature", $feature);
                }
                $this->saveYachts();
                break;
            }
        }
    }

    function getAll()
    {
        $yachts = array();
        foreach ($this->xml->yacht as $yacht) {
            $yachts[] = Yacht::parseFromXml($yacht);
        }
        return $yachts;
    }

    function deleteYacht($id)
    {
        $yachts = $this->xml->yacht;
        for ($i = 0; $i < $yachts->count(); $i++) {
            if ($yachts[$i]["id"] == $id) {
                unset($yachts[$i]);
                $this->saveYachts();
                break;
            }
        }
    }

    public function nextId()
    {
        $curId = (integer) $this->xml->next_id;
        $this->xml->next_id = $curId + 1;
        return $curId;
    }

    private function saveYachts()
    {
        $this->xml->saveXML(Yachts::yachtsPath);
    }
}
