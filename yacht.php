<?php
require_once("yachts.php");

class Yacht
{
    public $title;
    public $id;
    public $description;
    public $price;
    public $features;

    public static function parseFromPost()
    {
        $id = isset($_POST["id"]) ? $_POST["id"] : 0;
        $title = $_POST["title"];
        $description = $_POST["description"];
        $price = $_POST["price"];
        $features = $_POST["features"];
        $features = explode('; ', $features);
        return new Yacht($title, $description, $price, $features, $id);
    }

    public static function parseFromXml(SimpleXMLElement $yachtXml)
    {
        $title = (string)$yachtXml->title;
        $description = (string)$yachtXml->description;
        $price = (integer)$yachtXml->price;
        $id = (integer)$yachtXml["id"];
        $features = (array)$yachtXml->features->feature;
        return new Yacht($title, $description, $price, $features, $id);
    }

    private function __construct($title, $description, $price, $features, $id)
    {
        $this->title = $title;
        $this->description = $description;
        $this->price = $price;
        $this->features = $features;
        $this->id = $id;
    }
}
