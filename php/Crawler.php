<?php

class Crawler {

	private $url = '';
	private $content = '';
	private $links = [];
	/**
	 * Links current index of the data that is grabed from the <a></a> tags.
	 * By default it grabs the href attr.
	 */
	private $currentLinkIndex = 2;
	private $linkHrefIndex = 2;
	private $linkNodeTextIndex = 3;

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
		$this->printLinks();
		return $this->links[$this->currentLinkIndex];
	}

	public function printLinks() {
		foreach ($this->links[$this->currentLinkIndex] as $link) {
			print "$link<br />";
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
		if (strpos($link, '#')) {
			$link = substr($link, 0, strpos($link, '#'));
		}
		// Remove links starting with the dot
		if (substr($link, 0, 1) == '.') {
			$link = substr($link, 1);
		}
	}
}
