<?php

/**
 * Spiral Framework.
 *
 * @license   MIT
 * @author    Kairee Wu (krwu)
 */

declare(strict_types=1);

namespace Tests\Feature\Controller;

use Tests\TestCase;

class HomeControllerTest extends TestCase
{
    public function testCreateUser(): void
    {
        $http = $this->fakeHttp();
        $response = $http
            ->post(
                uri: '/createUser.html',
                data: [
                    'username' => 'john_smith',
                    'first_name' => 'John',
                    'last_name' => 'Smith',
                    'password' => 'secret',
                    'utm_id' => '34wmrn_34n25nj3_4k23bn_4dkj2n34',
                    'utm_source' => 'google',
                    'utm_medium' => 'cpc',
                    'utm_term' => 'search',
                    'tags' => [
                        'first' => [
                            'name' => 'Admin',
                            'role' => 'admin',
                        ],
                        'second' => [
                            'name' => 'Manager',
                            'role' => 'manager',
                        ],
                    ],
                ],
                files: [
                    'avatar' => $http->getFileFactory()->createImage('avatar.jpg'),
                ]
            );

        var_dump((string)$response->getOriginalResponse()->getBody());
    }

    public function testCreateBlogPost(): void
    {
        $http = $this->fakeHttp();
        $response = $http
            ->post(
                uri: '/createPost.html',
                data: [
                    'title' => 'Hello world',
                    'description' => 'Hello world',
                    'tags' => [
                        [
                            'tag' => 'php',
                            'title' => 'PHP language',
                        ],
                        [
                            'tag' => 'go',
                            'title' => 'Golang',
                        ],
                    ],
                ],
                files: [
                    'image' => $http->getFileFactory()->createImage('image.jpg'),
                ]
            );

        var_dump((string)$response->getOriginalResponse()->getBody());
    }
}
