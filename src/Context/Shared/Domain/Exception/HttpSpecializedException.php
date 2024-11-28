<?php

/**
 * Slim Framework (https://slimframework.com)
 *
 * @license https://github.com/slimphp/Slim/blob/4.x/LICENSE.md (MIT License)
 */

declare(strict_types=1);

namespace SkeletonDDD\Context\Shared\Domain\Exception;

use Psr\Http\Message\ServerRequestInterface;
use Throwable;

abstract class HttpSpecializedException extends HttpException
{
    /**
     * @param ServerRequestInterface $request
     * @param string|null            $message
     * @param Throwable|null         $previous
     */
    public function __construct(string $message = null, ?Throwable $previous = null)
    {
        if ($message !== null) {
            $this->message = $message;
        }

        parent::__construct($this->message, $this->code, $previous);
    }
}
