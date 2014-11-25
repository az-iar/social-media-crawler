Social Media Crawler
====================

Crawl instagram and twitter for basic user data e.g handle, name, followers and profile image. Require Symfony DomCrawler - https://github.com/symfony/DomCrawler.

## Installation

Install through composer:
``` composer require az-iar/social-media-crawler ```

## Usage

```php
$crawler = new InstagramCrawler('http://instagram.com/username');
$data = $crawler->crawl();
```
