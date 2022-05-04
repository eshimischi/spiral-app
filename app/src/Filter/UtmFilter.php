<?php

declare(strict_types=1);

namespace App\Filter;

use App\Bootloader\Laravel\FilterDefinition;
use Spiral\Filters\Filter;
use Spiral\Filters\Attribute\Input;
use Spiral\Filters\FilterDefinitionInterface;

class UtmFilter extends Filter
{
    #[Input\Post('utm_id')]
    public ?string $utmId = null;

    #[Input\Post('utm_source')]
    public string $utmSource;

    #[Input\Post('utm_medium')]
    public string $utmMedium;

    #[Input\Post('utm_campaign')]
    public ?string $utmCampaign = null;

    #[Input\Post('utm_term')]
    public ?string $utmTerm = null;

    #[Input\Post('utm_content')]
    public ?string $utmContent = null;

    public function filterDefinition(): FilterDefinitionInterface
    {
        return new FilterDefinition([
            'utmId' => ['required', 'min:5', 'max:10'],
            'utmSource' => ['required', 'min:5', 'max:10'],
            'utmContent' => ['required', 'min:5', 'max:10'],
        ]);
    }
}
