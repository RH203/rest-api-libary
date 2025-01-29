<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

class ErrorException extends Exception
{
  protected int $statusCode;

  public function __construct(string $message = "Terjadi kesalahan", int $statusCode = 500)
  {
    parent::__construct($message);
    $this->statusCode = $statusCode;
  }

  public function render(): JsonResponse
  {
    return response()->json([
      'message' => $this->getMessage(),
    ], $this->statusCode);
  }
}
