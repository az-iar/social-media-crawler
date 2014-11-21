<?php namespace Inneuron\SocialMediaCrawler;

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