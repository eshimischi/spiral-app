<?php

declare(strict_types=1);

namespace App\Filter;

use Spiral\Filters\Attribute\Input;
use Spiral\Filters\Attribute\NestedArray;
use Spiral\Filters\Attribute\Setter;
use Spiral\Filters\Attribute\NestedFilter;
use Spiral\Filters\Filter;
use Spiral\Filters\FilterDefinitionInterface;
use Spiral\Validation\Symfony\FilterDefinition;
use Symfony\Component\Validator\Constraints as Assert;

class CreateUser extends Filter
{
    #[Assert\NotBlank]
    #[Assert\Length(['min' => 30])]
    #[Input\Post]
    public string $username;

    #[Input\Post('first_name')]
    public string $firstName;

    #[Input\Post('last_name')]
    public string $lastName;

    #[NestedArray(class: UserTagsFilter::class, input: new Input\Post('tags'))]
    public array $tags = [];

    #[NestedFilter(class: UtmFilter::class)]
    public UtmFilter $utm;

    #[Input\Post]
    #[Setter(filter: 'md5')]
    public string $password;

    public function filterDefinition(): FilterDefinitionInterface
    {
        return new FilterDefinition();
    }
}
