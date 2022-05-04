<?php

declare(strict_types=1);

namespace App\Filter;

use Spiral\Filters\Attribute\Input;
use Spiral\Filters\Filter;
use Spiral\Filters\FilterDefinitionInterface;
use Spiral\Validation\Symfony\FilterDefinition;
use Symfony\Component\Validator\Constraints as Assert;

class UserTagsFilter extends Filter
{
    #[Assert\NotBlank]
    #[Assert\Length(['min' => 30])]
    #[Input\Post]
    public string $name;

    #[Assert\NotBlank]
    #[Assert\Length(['min' => 3])]
    #[Input\Post]
    public string $role;

    public function filterDefinition(): FilterDefinitionInterface
    {
        return new FilterDefinition();
    }
}
