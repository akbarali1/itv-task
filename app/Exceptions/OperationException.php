<?php
declare(strict_types=1);

namespace App\Exceptions;

use Throwable;

class OperationException extends \Exception
{
    /**
     * OperationException constructor.
     * @param string         $message
     * @param int            $code
     * @param Throwable|null $previous
     */
    public function __construct(string $message = "", int $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public const ERROR_CODE_NOT_FOUND       = 404;
    public const ERROR_NO_RESPONSE          = -200;
    public const ERROR_NO_PERMISSIONS       = -401;
    public const ERROR_NOT_FOUND            = -404;
    public const ERROR_INVALID_REQUEST      = -422;
    public const ERROR_INPUT_VALIDATION     = -423;
    public const ERROR_SOMETHING_WENT_WRONG = -500;

    public const ERROR_AUTH_FAILED = -700;

}
