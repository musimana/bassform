<?php

namespace Tests\Browser\Traits;

trait HasSocialLinks
{
    /**
     * Get the Dusk selector array for the app's social links.
     *
     * @return array<string, string>
     */
    public function getSelectorsSocialLinks(): array
    {
        $elements = [];

        foreach (config('metadata.social_links', []) as $name => $url) {
            $elements['@social-link-' . $name] = 'nav a[href="' . $url . '"]';
        }

        return $elements;
    }
}
