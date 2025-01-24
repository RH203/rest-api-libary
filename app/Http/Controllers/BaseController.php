<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BaseController extends Controller
{
  /**
   * Return a success response with data.
   *
   * @param mixed $data
   * @param int $statusCode
   * @return \Illuminate\Http\JsonResponse
   */
  public function success($data = [], $statusCode = 200)
  {
    return response()->json([
      'data' => $data,
    ], $statusCode);
  }

  /**
   * Return an error response.
   *
   * @param string $message
   * @param int $statusCode
   * @return \Illuminate\Http\JsonResponse
   */
  public function error($message = 'An error occurred', $statusCode = 500)
  {
    return response()->json([
      'message' => $message
    ], $statusCode);
  }
}
