<?php

class Crawler {

	private $url = '';
	private $content = '';
	private $links = [];
	private $linkUrlIndex = 2;

	function __construct(string $url) {
		$this->setUrl($url);
		$this->setPageContent();
	}

	public function getPageContent() {
		$content = file_get_contents($this->url);
		return $content;
	}

	public function getLinks() {
		$regexp = "<a\s[^>]*href=(\"??)([^\" >]*?)\\1[^>]*>(.*)<\/a>";
		preg_match_all("/$regexp/siU", $this->content, $this->links);

		return $this->links[$this->linkUrlIndex];
	}

	public function printLinks() {
		foreach ($this->links as $link) {
			print $link . '<br>';
		}
	}

	private function setUrl(string $url) {
		$this->url = $url;
	}

	private function setPageContent() {
		$this->content = $this->getPageContent();
	}

	private function removeLinksHashTags() {
		foreach ($this->links as $link) {
			$this->removeLinkHashTag($link);
		}
	}

	private function removeLinkHashTag(string $link) {
		if (strpos($link, "#")) {
			//
		}
	}
}
