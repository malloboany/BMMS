<?php

namespace App\Models;

use Illuminate\Http\JsonResponse;

class MyResult
{
    public function __construct(
        public bool $success,
        public int $code,
        public string $message,
        public mixed $data = null,
    ) {
    }

    public function toArray(): array
    {
        return [
            'success' => $this->success,
            'code' => $this->code,
            'message' => $this->message,
            'data' => $this->data,
        ];
    }

    public function toResponse(): JsonResponse
    {
        return response()->json($this->toArray(), $this->code);
    }

    public static function success(mixed $data = null, string $message = 'OK', int $code = 200): JsonResponse
    {
        return (new self(true, $code, $message, $data))->toResponse();
    }

    public static function error(string $message, int $code = 400, mixed $data = null): JsonResponse
    {
        return (new self(false, $code, $message, $data))->toResponse();
    }
}

