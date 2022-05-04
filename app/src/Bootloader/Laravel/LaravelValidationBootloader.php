<?php

declare(strict_types=1);

namespace App\Bootloader\Laravel;

use Illuminate\Translation\ArrayLoader;
use Illuminate\Translation\Translator;
use Illuminate\Validation\Factory;
use Spiral\Boot\Bootloader\Bootloader;
use Spiral\Translator\TranslatorInterface;
use Spiral\Validation\ValidationInterface;
use Spiral\Validation\ValidationProvider;

final class LaravelValidationBootloader extends Bootloader
{
    protected const SINGLETONS = [
        LaravelValidation::class => [self::class, 'initValidation'],
    ];

    public function boot(ValidationProvider $provider): void
    {
        $provider->register(
            FilterDefinition::class,
            static fn(LaravelValidation $validation) => $validation
        );
    }

    private function initValidation(TranslatorInterface $translator): ValidationInterface
    {
        $loader = new ArrayLoader();

        $cat = $translator->getCatalogueManager();
        foreach ($cat->getLocales() as $locale) {
            foreach ($cat->get($locale)->getData() as $domain => $messages) {
                $loader->addMessages($locale, $domain, $messages);
            }
        }

        return new LaravelValidation(
            new Factory(
                new Translator(
                    $loader,
                    $translator->getLocale(),
                )
            )
        );
    }
}
