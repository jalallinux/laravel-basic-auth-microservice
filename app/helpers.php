<?php

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

if (!function_exists('to_valid_mobile_number')) {
    function to_valid_mobile_number(string $mobile): string
    {
        return '+98' . substr($mobile, -10, 10);
    }
}

if (!function_exists('responseData')) {
    function responseData($data = [], $status = 200, array $headers = [], $options = 0): JsonResponse
    {
        return response()->json([
            'data' => $data,
            'code' => ($status == 0 ? 500 : $status),
            'timestamp' => now()->timestamp,
        ], $status, $headers, $options);
    }
}

if (!function_exists('responsePaginate')) {
    function responsePaginate(iterable $data, int $total, int $page = null, int $perPage = null): AnonymousResourceCollection
    {
        [$page, $perPage] = [$page ?? @request()->page ?? 1, $perPage ?? @request()->perPage ?? 20];
        $paginated = new LengthAwarePaginator($data ?? [], $total, $perPage, $page, [
            'path' => Paginator::resolveCurrentPath(),
            'pageName' => 'page',
        ]);
        return JsonResource::collection($paginated);
    }
}

if (!function_exists('responseMessage')) {
    function responseMessage(string $message, $status = 200, array $headers = [], $options = 0): JsonResponse
    {
        return response()->json([
            'message' => $message,
            'code' => ($status == 0 ? 500 : $status),
            'timestamp' => now()->timestamp,
        ], $status, $headers, $options);
    }
}

if (!function_exists('classToSlug')) {
    function classToSlug(string $class, string $glue = '_'): string
    {
        return strtolower(str_replace('\\', $glue, $class));
    }
}

if (!function_exists('slugToClass')) {
    function slugToClass(string $slug, string $glue = '_'): string
    {
        return strtolower(str_replace($glue, '\\', $slug));
    }
}

if (!function_exists('isJsonString')) {
    function isJsonString(string $string): bool
    {
        json_decode($string);
        return json_last_error() === JSON_ERROR_NONE;
    }
}
