<?php

declare(strict_types=1);

namespace App\Filter;

use Psr\Http\Message\UploadedFileInterface;
use Spiral\Validation\Symfony\FilterDto;
use Symfony\Component\Validator\Constraints as Assert;

class CreateBlogPost extends FilterDto
{
    #[Assert\NotBlank]
    #[Assert\Length(['min' => 1])]
    #[Input\Data()]
    public string $title;

    #[Assert\NotBlank]
    #[Assert\Length(['min' => 100])]
    public string $description;

    #[Assert\NotBlank]
    #[Assert\Length(['min' => 1000])]
    public string $text;

    #[Assert\Image]
    public ?UploadedFileInterface $image = null;

    public function filterDefinition(): Definition
    {
    }

    public function mappingSchema(): array
    {
        return [
            'title' => 'data:title',
            'description' => 'data:description',
            'text' => 'data:text',
            'image' => 'file:image',
            'tags' => 'data:tags',
        ];
    }

    /*public function validationRules(): array
    {
        return [
            'title' => new Assert\Length(['min' => 1]),
            'description' => new Assert\Length(['min' => 100]),
            'text' => new Assert\Length(['min' => 1000]),
            'image' => new Assert\Optional([
                new Assert\Image(),
            ]),
        ];
    }*/
}
