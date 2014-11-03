<?php
class PageData {
  private $title = "";
  private $content = "";
  private $css = "";
  private $embeddedStyle = "";
  private $scriptTags = "";
  
  public function __construct($title) {
    $this->title = $title;
  }
  
  public function setTitle($title) {
    $this->title = $title;
  }
  
  public function getTitle() {
    return $this->title;
  }
  
  public function addContent($html) {
    $this->content .= $html;
  }
  
  public function getContent() {
    return $this->content;
  }
  
  public function addCss($href) {
    $this->css .= "<link href=\"$href\" rel=\"stylesheet\">";
  }
  
  public function getCss() {
    return $this->css;
  }
  
  public function getEmbeddedStyle() {
    return $this->embeddedStyle;
  }
  
  public function addScript($src) {
    $this->scriptTags .= "<script src=\"$src\"></script>";
  }
  
  public function getScriptTags() {
    return $this->scriptTags;
  }
}
?>