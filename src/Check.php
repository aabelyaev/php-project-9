<?php

namespace Hexlet\Code;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use DiDom\Document;

class Check
{
    private ?int $id = null;
    private ?int $urlId = null;
    private ?string $createdAt = null;
    private ?int $status_code = null;
    private ?string $h1 = null;
    private ?string $title = null;
    private ?string $description = null;

    public static function fromArray(array $checkData): Check
    {
        [$urlId] = $checkData;
        $check = new Check();
        $check->setUrlId($urlId);

        return $check;
    }

    public function checkStatus(string $urlName): ?Check
    {
        $client = new Client();

        try {
            $response = $client->request('GET', $urlName, ['connect_timeout' => 6]);
        } catch (GuzzleException $e) {
            return null;
        }
        $statusCode = $response->getStatusCode();
        $this->setStatusCode($statusCode);

        return $this;
    }

    public function parseHtml(string $urlName): ?Check
    {
        $document = new Document($urlName, true);

        if ($document->has('h1')) {
            $doc = $document->first('h1');
            if ($doc instanceof \DiDom\Element) {
                $h1 = trim($doc->text());
                $this->setH1($h1);
            }
        }
        if ($document->has('title')) {
            $doc = $document->first('title');
            if ($doc instanceof \DiDom\Element) {
                $title = trim($doc->text());
                $this->setTitle($title);
            }
        }
        if ($document->has('meta')) {
            $this->setDescription(optional($document->first('meta[name=description]'))->getAttribute('content'));
        }

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUrlid(): ?int
    {
        return $this->urlId;
    }

    public function getStatusCode(): ?int
    {
        return $this->status_code;
    }

    public function getCreatedAt(): ?string
    {
        return $this->createdAt;
    }

    public function getH1(): ?string
    {
        return $this->h1;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setStatusCode(?int $status_code): void
    {
        $this->status_code = $status_code;
    }

    public function setCreatedAt(?string $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function setUrlId(?int $urlId): void
    {
        $this->urlId = $urlId;
    }

    public function setH1(?string $h1): void
    {
        $this->h1 = $h1;
    }

    public function setTitle(?string $title): void
    {
        $this->title = $title;
    }

    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    public function exists(): bool
    {
        return !is_null($this->getId());
    }
}
