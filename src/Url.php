<?php

namespace Hexlet\Code;

class Url
{
    private ?int $id = null;
    private ?string $name = null;
    private ?string $createdAt = null;
    private ?int $lastCheckCode = null;
    private ?string $lastCheckDate = null;

    public static function fromArray(array $urlData): Url
    {
        [$name] = $urlData;
        $url = new Url();
        $url->setName($name);
        return $url;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getCreatedAt(): ?string
    {
        return $this->createdAt;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setCreatedAt(string $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getLastCheckCode(): ?int
    {
        return $this->lastCheckCode;
    }

    public function getLastCheckDate(): ?string
    {
        return $this->lastCheckDate;
    }

    public function setLastCheckCode(int $lastCheckCode): void
    {
        $this->lastCheckCode = $lastCheckCode;
    }

    public function setLastCheckDate(string $lastCheckDate): void
    {
        $this->lastCheckDate = $lastCheckDate;
    }

    public function exists(): bool
    {
        return !is_null($this->getId());
    }
}
