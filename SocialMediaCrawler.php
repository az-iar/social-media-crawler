<?php

interface SocialMediaCrawler {
    /**
     * @param $url string
     */
    public function __construct($url);

    /**
     * @return array|null
     */
    public function crawl();
}