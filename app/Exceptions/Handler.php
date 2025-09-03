<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * Render an exception into an HTTP response.
     */
    public function render($request, Throwable $e)
    {
        // Handle 404 Not Found errors
        if ($e instanceof NotFoundHttpException) {
            return $this->handleNotFound($request);
        }

        // Handle Method Not Allowed errors
        if ($e instanceof MethodNotAllowedHttpException) {
            return $this->handleMethodNotAllowed($request);
        }

        // Handle Model Not Found errors
        if ($e instanceof ModelNotFoundException) {
            return $this->handleModelNotFound($request);
        }

        // Handle other exceptions
        if ($this->isHttpException($e)) {
            return $this->handleHttpException($request, $e);
        }

        return parent::render($request, $e);
    }

    /**
     * Handle 404 Not Found errors
     */
    private function handleNotFound(Request $request)
    {
        if ($request->expectsJson()) {
            return response()->json([
                'success' => false,
                'message' => 'Halaman tidak ditemukan.',
                'error' => 'Not Found'
            ], 404);
        }

        return redirect()->route('hospitals.index')->with('error', 'Halaman yang Anda cari tidak ditemukan.');
    }

    /**
     * Handle Method Not Allowed errors
     */
    private function handleMethodNotAllowed(Request $request)
    {
        if ($request->expectsJson()) {
            return response()->json([
                'success' => false,
                'message' => 'Method tidak diizinkan.',
                'error' => 'Method Not Allowed'
            ], 405);
        }

        return redirect()->route('hospitals.index')->with('error', 'Method tidak diizinkan.');
    }

    /**
     * Handle Model Not Found errors
     */
    private function handleModelNotFound(Request $request)
    {
        if ($request->expectsJson()) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan.',
                'error' => 'Model Not Found'
            ], 404);
        }

        return redirect()->route('hospitals.index')->with('error', 'Data yang Anda cari tidak ditemukan.');
    }

    /**
     * Handle HTTP exceptions
     */
    private function handleHttpException(Request $request, $e)
    {
        $statusCode = $e->getStatusCode();
        
        if ($request->expectsJson()) {
            return response()->json([
                'success' => false,
                'message' => $this->getErrorMessage($statusCode),
                'error' => $e->getMessage()
            ], $statusCode);
        }

        // Return custom error views
        switch ($statusCode) {
            case 403:
                return response()->view('errors.403', [], 403);
            case 404:
                return response()->view('errors.404', [], 404);
            case 500:
                return response()->view('errors.500', [], 500);
            default:
                return redirect()->route('hospitals.index')->with('error', $this->getErrorMessage($statusCode));
        }
    }

    /**
     * Get error message based on status code
     */
    private function getErrorMessage($statusCode)
    {
        switch ($statusCode) {
            case 403:
                return 'Akses ditolak.';
            case 404:
                return 'Halaman tidak ditemukan.';
            case 500:
                return 'Terjadi kesalahan pada server.';
            default:
                return 'Terjadi kesalahan.';
        }
    }
}
