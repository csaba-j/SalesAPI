<?php

declare(strict_types=1);

namespace Csaba\SalesApi\View;

final class View
{
    public function render(string $template, array $data = [], string $error = ''): void
    {
        $templatePath = __DIR__ . '/templates/' . $template . '.php';
        if (!is_file($templatePath)) {
            throw new \RuntimeException('Template not found: ' . $templatePath);
        }

        extract($data, EXTR_SKIP);
        include $templatePath;
    }
}
