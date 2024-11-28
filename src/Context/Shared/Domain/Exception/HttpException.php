<?php

/**
 * Slim Framework (https://slimframework.com)
 *
 * @license https://github.com/slimphp/Slim/blob/4.x/LICENSE.md (MIT License)
 */

declare(strict_types=1);

namespace SkeletonDDD\Context\Shared\Domain\Exception;

use Psr\Http\Message\ServerRequestInterface;
use RuntimeException;
use Throwable;

/**
 * @api
 * @method int getCode()
 */
class HttpException extends RuntimeException
{
    protected string $title = '';

    protected string $description = '';

    public function __construct(
        string $message = '',
        int $code = 0,
        ?Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }
}
