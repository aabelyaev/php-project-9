<?php

namespace Hexlet\Code;

class UrlValidator
{
    public function validate(array $urlData): array
    {
        $errors = [];
        $url = parse_url($urlData['name']);
        $scheme = $url['scheme'] ?? '';
        $host = $url['host'] ?? '';

        if (empty($urlData['name'])) {
            $errors[] = 'URL не должен быть пустым';
        }

        if (empty($scheme) || empty($host)) {
            $errors[] = 'Некорректный URL';
        }

        if ($scheme !== 'http' && $scheme !== 'https') {
            $errors[] = 'Некорректный URL';
        }

        if (!str_starts_with($urlData['name'], 'http://') && !str_starts_with($urlData['name'], 'https://')) {
            $errors[] = 'Некорректный URL';
        }

        return $errors;
    }
}
