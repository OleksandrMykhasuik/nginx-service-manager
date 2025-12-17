<?php

namespace App\Http\Controllers;

use App\DTO\CreateVhostDTO;
use App\Http\Requests\CreateVhostRequest;
use App\Http\Requests\DeleteVhostRequest;
use App\Services\NginxManagerService;

class VhostController extends Controller
{
    public function __construct(private readonly NginxManagerService $nginxManagerService)
    {
    }

    public function store(CreateVhostRequest $request): void
    {
        try {
            $validated = $request->validated();

            $dto = new CreateVhostDTO(
                domain: $validated['domain'],
                port: $validated['port'],
                rootPath: $validated['rootPath'],
                ssl: $validated['ssl'] ?? false,
                sslCertPath: $validated['sslCertPath'] ?? null,
                sslKeyPath: $validated['sslKeyPath'] ?? null
            );
            $this->nginxManagerService->createVhost($dto);

            response()->json(['status' => 'created'], 201);
        } catch (\Throwable $e) {
            response()->json([
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function destroy(DeleteVhostRequest $request): void
    {
        try {
            $validated = $request->validated();

            $this->nginxManagerService->deleteVhost($validated['domain']);

            response()->json([
                'status' => 'deleted'
            ], 200);
        } catch (\Throwable $e) {
            response()->json([
                'error' => $e->getMessage(),
            ], 500);
        }

    }
}
