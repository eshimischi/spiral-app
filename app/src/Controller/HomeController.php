<?php

declare(strict_types=1);

namespace App\Controller;

use App\Filter\CreateBlogPost;
use App\Filter\CreateUser;
use Spiral\Prototype\Traits\PrototypeTrait;

class HomeController
{
    use PrototypeTrait;

    /**
     * @return string
     */
    public function index(): string
    {
        return $this->views->render('home.dark.php');
    }

    public function createUser(CreateUser $filter): array
    {
        dump($filter);

        return [];
    }

    public function createPost(CreateBlogPost $filter): array
    {
        return $filter->filteredData();
    }
}
