<?php

require __DIR__ . '/vendor/autoload.php';

use App\GeneratorCollection;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

$stringOptions = getopt('s::', ['stringLength::']);
$arrayOptions = getopt('a::', ['arraySize::']);
$stringLength = $stringOptions['s'] ?? $stringOptions['stringLength'] ?? 6;
$arraySize = $arrayOptions['a'] ?? $arrayOptions['arraySize'] ?? 3;

$container = new ContainerBuilder();
$loader = new YamlFileLoader($container, new FileLocator(__DIR__.'/config'));
$loader->load('services.yaml');

$container->setParameter('stringLength', $stringLength);
$container->setParameter('arraySize', $arraySize);

$container->compile();

$generatorsCollection = $container->get(GeneratorCollection::class);
$result = $generatorsCollection->process();
foreach ($result as $generator => $values) {
    foreach ($values as $type => $value) {
        echo $generator .' '. $type . ' value ' . implode(',', $value) . PHP_EOL;
    }
}
