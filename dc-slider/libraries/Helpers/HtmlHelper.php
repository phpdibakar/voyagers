<?php
class HtmlHelper{
	
	const DEFAULT_IMAGE_WIDTH = 16;
	const DEFAULT_IMAGE_HEIGHT = 16;
	
	public static function image($source, $alt = null, $width = self::DEFAULT_IMAGE_WIDTH, $height = self::DEFAULT_IMAGE_HEIGHT){
		return "<img src=\"{$source}\" alt=\"{$alt}\" width=\"{$width}\" height=\"{$height}\"/>";
	}
	
	public static function link($content, $link, $title = null, $confirm = false){
		$link = "<a href=\"{$link}\" title=\"{$title}\" ";
		$confirm ? $link .= "onclick=\"return confirm('Are you sure?')\" " : $link;
		$link .= "> {$content} </a>";
		return $link;
	}
}