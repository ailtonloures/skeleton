<?php

namespace App\Services;

use CoffeeCode\Optimizer\Optimizer;

final class SEO
{
    /** @var Optimizer */
    protected $optimizer;

    public function __construct(string $schema = "article")
    {
        $this->optimizer = new Optimizer();
        $this->optimizer
            ->openGraph(
                getenv('APP_NAME'),
                getenv('APP_LOCALE'),
                $schema
            )
            ->publisher(
                getenv('FB_PAGE') ?? null,
                getenv('FB_AUTHOR') ?? null
            )
            ->twitterCard(
                getenv('TWITTER_CREATOR') ?? null,
                getenv('TWITTER_SITE') ?? null,
                getenv('TWITTER_DOMAIN') ?? null
            )
            ->facebook(
                getenv('APP_ID') ?? null, []
            );
    }

    /**
     * @param string $title
     * @param string $description
     * @param string $url
     * @param string $image
     * @param boolean $follow
     * @return string
     */
    public function render(string $title, string $description, string $url, string $image, bool $follow = true): string
    {
        return $this->optimizer->optimize($title, $description, $url, $image, $follow)->render();
    }
}
