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
			$obj->description = utf8_decode($item->nodeValue);
			
			$atts = $item->attributes;
			$obj->url = $atts->getNamedItem("href")->nodeValue;
			$obj->icon = ( $atts->getNamedItem("icon") === null) ? "" : $atts->getNamedItem("icon")->nodeValue;
										
			array_push($a, $obj);
		}
		
		return $a;
	}
}
?>