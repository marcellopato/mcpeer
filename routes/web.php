<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MCPActionController;
use App\Http\Controllers\MCPServerController;
use App\Livewire\MCPServerManager;
use App\Livewire\MCPActionManager;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Simple test route
Route::get('/test', function () {
    return 'MCPeer está funcionando!';
});

// Backend API test route (working)
Route::get('/api-test', function () {
    return response()->json([
        'status' => 'ok',
        'message' => 'MCPeer Backend is operational',
        'version' => '1.0.0',
        'features' => [
            'mcp_server_management' => true,
            'action_configuration' => true,
            'code_generation' => true,
            'docker_integration' => true
        ]
    ]);
});

// Dashboard
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// MCP Livewire Routes  
Route::get('/mcp/servers', MCPServerManager::class)->name('mcp.servers');
Route::get('/mcp/servers/{server}/actions', MCPActionManager::class)->name('mcp.server.actions');

// Legacy MCP Routes (keeping for API compatibility)
Route::resource('actions', MCPActionController::class);
Route::resource('servers', MCPServerController::class);

// API Routes for testing
Route::prefix('api')->group(function () {
    Route::post('/test-endpoint', [MCPActionController::class, 'testEndpoint'])->name('api.test-endpoint');
    Route::post('/generate-mcp-config', [MCPServerController::class, 'generateConfig'])->name('api.generate-config');
});
