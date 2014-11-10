<?php

class ScrapeBookmarkFile {
	private $filename;
	private $dom;
	
	function __construct($filename) {
		$this->filename = $filename;
		$this->dom = new DomDocument();
		@$this->dom->loadHTMLFile($filename);
	}
	
	public function getLinks() {
		$a = array();
		
		$nodeList = $this->dom->getElementsByTagName("a");
		foreach($nodeList as $item) {
			$obj = new stdClass();
			$obj->description = $item->nodeValue;
			
			$atts = $item->attributes;
			$obj->url = $atts->getNamedItem("href")->nodeValue;
			if (substr($obj->url, 0, 6) === "place:") { continue; }
			
			$obj->icon = ( $atts->getNamedItem("icon") === null) ? "" : $atts->getNamedItem("icon")->nodeValue;
			
			array_push($a, $obj);
		}
		
		return $a;
	}
}
?>