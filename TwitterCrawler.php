<?php

use Symfony\Component\DomCrawler\Crawler;

class TwitterCrawler implements SocialMediaCrawler
{

    /**
     * @var string
     */
    private $url;

    public function __construct( $url )
    {
        $this->crawler = new Crawler();
        $this->url     = $url;
    }

    public function crawl()
    {
        $this->validateUrl();

        $html = file_get_contents( $this->url );
        $this->crawler->add( $html );

        $followers       = $this->crawler->filter( '.ProfileNav-item--followers .ProfileNav-value' )->text();
        $profile_img     = $this->crawler->filter( 'img.ProfileAvatar-image' );
        $profile_picture = $profile_img->attr( 'src' );
        $name            = $profile_img->attr( 'alt' );
        if (preg_match( '/\(@(.*)\)/', $html, $matches )) {
            $handle = $matches[1];
        }

        return compact( 'followers', 'profile_picture', 'name', 'handle' );
    }

    private function validateUrl()
    {
        if ( ! $this->url) {
            throw new \Exception( 'Empty url given' );
        }

        if ( ! preg_match( '/(twitter.com)/', $this->url )) {
            throw new \Exception( 'Invalid url' );
        }

        return true;
    }
}