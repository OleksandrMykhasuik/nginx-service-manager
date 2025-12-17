<?php

namespace App\Http\Controllers;

use App\Enum\NginxSystemOperation;
use App\Services\NginxManagerService;

class NginxController extends Controller
{
    public function __construct(private readonly NginxManagerService $nginxManagerService)
    {
    }

    public function start(): void
    {
        $this->do(NginxSystemOperation::start);
    }
    public function stop(): void
    {
        $this->do(NginxSystemOperation::stop);
    }
    public function restart(): void
    {
        $this->do(NginxSystemOperation::restart);
    }
    public function reload(): void
    {
        $this->do(NginxSystemOperation::reload);
    }

    private function do(NginxSystemOperation $command): void
    {
        try {
            $this->nginxManagerService->exec($command);
            response()->json(['status' => 'done'], 201);
        } catch (\Throwable $exception) {
            response()->json([
                'error' => $exception->getMessage(),
            ], 500);
        }
    }
}
