<?php

declare(strict_types=1);

namespace SkeletonDDD\Apps\Shared\Backend\Handlers;

use Psr\Http\Message\ServerRequestInterface as Request;
use SkeletonDDD\Apps\Shared\Backend\Handlers\HttpErrorHandler;
use SkeletonDDD\Context\Shared\Domain\Logger;
use Slim\Exception\HttpInternalServerErrorException;
use Slim\ResponseEmitter;

class ShutdownHandler
{
    /**
     * @var Request
     */
    private $request;

    /**
     * @var HttpErrorHandler
     */
    private $errorHandler;

    /**
     * @var bool
     */
    private $displayErrorDetails;

    /**
     * ShutdownHandler constructor.
     *
     * @param Request           $request
     * @param HttpErrorHandler  $errorHandler
     * @param bool              $displayErrorDetails
     */
    public function __construct(Request $request, HttpErrorHandler $errorHandler, bool $displayErrorDetails)
    {
        $this->request = $request;
        $this->errorHandler = $errorHandler;
        $this->displayErrorDetails = $displayErrorDetails;
    }

    public function __invoke()
    {

        $error = error_get_last();
        if (!$error) {
            return;
        }

        $errorFile = $error['file'];
        $errorLine = $error['line'];
        $errorMessage = $error['message'];
        $errorType = $error['type'];
        $message = 'An error while processing your request. Please try again later.';

        if ($this->displayErrorDetails) {
            print_r($errorType);
            switch ($errorType) {
                case E_USER_ERROR:
                    $message = "FATAL ERROR: {$errorMessage}. ";
                    $message .= " on line {$errorLine} in file {$errorFile}.";
                    break;

                case E_USER_WARNING:
                    $message = "WARNING: {$errorMessage}";
                    break;

                case E_USER_NOTICE:
                    $message = "NOTICE: {$errorMessage}";
                    break;

                default:
                    $message = "ERROR: {$errorMessage}";
                    $message .= " on line {$errorLine} in file {$errorFile}.";
                    break;
            }
        }

        $exception = new HttpInternalServerErrorException($this->request, $message);
        $response = $this->errorHandler->__invoke($this->request, $exception, $this->displayErrorDetails, false, false);

        if (ob_get_length()) {
            ob_clean();
        }


        $responseEmitter = new ResponseEmitter();
        $responseEmitter->emit($response);
    }
}
