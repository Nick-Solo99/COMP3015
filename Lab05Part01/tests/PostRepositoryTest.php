<?php

require_once __DIR__ . '/../src/Repositories/PostRepository.php';
require_once __DIR__ . '/../src/Models/Post.php';

require_once __DIR__ . '/../vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use src\Repositories\PostRepository;

class PostRepositoryTest extends TestCase
{
    private PostRepository $postRepository;

    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
    }

    /**
     * Runs before each test
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->postRepository = new PostRepository();
    }

    /**
     * Runs after each test
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        $dsn = "mysql:host=" . $_ENV['DB_HOST'] . ';';
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        try {
            $pdo = new PDO($dsn, $_ENV['DB_USER'], $_ENV['DB_PASS'], $options);
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
        $commands = file_get_contents(__DIR__ . '/../database/test_schema.sql', true);
        $pdo->exec($commands);
    }

    public function testPostCreation()
    {
        $post = $this->postRepository->savePost('test', 'body');
        $this->assertEquals('test', $post->title);
        $this->assertEquals('body', $post->body);
    }

    public function testPostRetrieval()
    {
        $savePost = $this->postRepository->savePost('test', 'body');
        $getPost = $this->postRepository->getPostById($savePost->id);
        $this->assertEquals($savePost->id, $getPost->id);
        $this->assertEquals($savePost->title, $getPost->title);
        $this->assertEquals($savePost->body, $getPost->body);


        $allPosts = $this->postRepository->getAllPosts();
        $this->assertIsArray($allPosts);
        $this->assertCount(1, $allPosts);
    }

    public function testPostUpdate()
    {
        $post = $this->postRepository->savePost('testInit', 'bodyInit');
        $this->postRepository->updatePost($post->id, 'testUpd', 'bodyUpd');
        $post = $this->postRepository->getPostById($post->id);
        $this->assertEquals('testUpd', $post->title);
        $this->assertEquals('bodyUpd', $post->body);
    }

    public function testPostDeletion()
    {
        $post = $this->postRepository->savePost('test', 'body');
        $this->postRepository->deletePostById($post->id);
        $allPosts = $this->postRepository->getAllPosts();
        $this->assertIsArray($allPosts);
        $this->assertCount(0, $allPosts);
    }
}
