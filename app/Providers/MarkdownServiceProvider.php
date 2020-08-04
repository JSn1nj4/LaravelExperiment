<?php

namespace App\Providers;

use GrahamCampbell\Markdown\MarkdownServiceProvider as GCMarkdownProvider;

class MarkdownServiceProvider extends GCMarkdownProvider
{
    /**
     * Override parent method for enabling Blade directive.
     *
     * @return string
     */
    protected function enableBladeDirective()
    {
        $app = $this->app;

        $app['blade.compiler']->directive('markdown', function ($markdown) {
            if ($markdown) {
                return "<?php echo app('markdown')->convertToHtml((string) {$markdown}); ?>";
            }

            return '<?php ob_start(); ?>';
        });

        $app['blade.compiler']->directive('endmarkdown', function () {
            return "<?php echo app('markdown.directive')->render(ob_get_clean()); ?>";
        });
    }
}
