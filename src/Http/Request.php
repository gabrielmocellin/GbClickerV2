<?php
namespace GbClicker\Http;

class Request
{
    private array $get;
    private array $post;
    private array $server;
    private array $cookies;
    private array $files;

    public function __construct()
    {
        $this->get = $_GET;
        $this->post = $_POST;
        $this->server = $_SERVER;
        $this->cookies = $_COOKIE;
        $this->files = $_FILES;
    }

    public function getMethod(): string
    {
        return $this->server['REQUEST_METHOD'] ?? 'GET';
    }

    public function getPath(): string
    {
        return parse_url($this->server['REQUEST_URI'] ?? '/', PHP_URL_PATH);
    }

    public function get(string $key, $default = null)
    {
        return $this->get[$key] ?? $default;
    }

    public function post(string $key, $default = null)
    {
        return $this->post[$key] ?? $default;
    }

    public function cookie(string $key, $default = null)
    {
        return $this->cookies[$key] ?? $default;
    }

    public function hasGet(string $key): bool
    {
        return isset($this->get[$key]);
    }

    public function hasPost(string $key): bool
    {
        return isset($this->post[$key]);
    }

    public function hasCookie(string $key): bool
    {
        return isset($this->cookies[$key]);
    }

    public function allPost(): array
    {
        return $this->post;
    }
}
