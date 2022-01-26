<?php

namespace App;

use Laminas\ServiceManager\ServiceManager;
use Laminas\View\HelperPluginManager;
use Laminas\View\Renderer\PhpRenderer;
use Laminas\View\Resolver\TemplateMapResolver;
use Laminas\View\Helper\AbstractHelper;

require_once __DIR__ . '/vendor/autoload.php';

// Helper definition
class ExampleHelper extends AbstractHelper
{
    public function __invoke(int $value): string
    {
        return $value . ' - TEST';
    }
}

// Renderer setup
$renderer = new PhpRenderer();
$renderer->setResolver(
    new TemplateMapResolver(
        [
            'template' => __DIR__ . '/template.phtml'
        ]
    )
);
$helperManager = new HelperPluginManager(new ServiceManager());
$helperManager->setService('exampleHelper', new ExampleHelper());
$renderer->setHelperPluginManager($helperManager);

echo $renderer->render('template', []);
