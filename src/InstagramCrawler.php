<?php namespace Inneuron\SocialMediaCrawler;

use Symfony\Component\DomCrawler\Crawler;

class InstagramCrawler implements SocialMediaCrawler
{

    /**
     * @var Crawler
     */
    private $crawler;
    /**
     * @var string
     */
    private $url;

    function __construct( $url )
    {
        $this->crawler = new Crawler();
        $this->url     = $url;
    }

    /**
     * Crawl instagram for user data from url
     *
     * @param $url
     *
     * @return array|null
     */
    public function crawl()
    {
        $this->validateUrl();

        $html = file_get_contents( $this->url );
        if (preg_match( '/("user":{(.*?)})/', $html, $matches )) {
            $result = json_decode( '{' . $matches[2] . '}}' );

            return [
                'handle'          => $result->username,
                'profile_picture' => $result->profile_picture,
                'name'            => $result->full_name,
                'followers'       => $result->counts->followed_by
            ];
        }

        return null;
    }

    private function validateUrl()
    {
        if ( ! $this->url) {
            throw new \Exception( 'Empty url given' );
        }

        if ( ! preg_match( '/(instagram.com)/', $this->url )) {
            throw new \Exception( 'Invalid url' );
        }

        return true;
    }
}