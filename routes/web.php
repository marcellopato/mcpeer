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

// Debug route
Route::get('/debug', function () {
    try {
        return response()->json([
            'php_version' => PHP_VERSION,
            'laravel_version' => app()->version(),
            'session_driver' => config('session.driver'),
            'session_config' => config('session'),
            'app_key' => config('app.key') ? 'SET' : 'NOT SET',
            'app_env' => config('app.env'),
            'database' => [
                'connection' => config('database.default'),
                'host' => config('database.connections.mysql.host'),
            ],
            'storage_permissions' => [
                'sessions_writable' => is_writable(storage_path('framework/sessions')),
                'storage_writable' => is_writable(storage_path()),
            ]
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'error' => $e->getMessage(),
            'trace' => $e->getTraceAsString()
        ], 500);
    }
});

// Simple test route
Route::get('/test', function () {
    return 'MCPeer está funcionando!';
});

// Session test route
Route::get('/session-test', function () {
    try {
        $session = request()->session();
        $session->put('test_key', 'test_value');
        return response()->json([
            'status' => 'success',
            'message' => 'Sessão funcionando corretamente',
            'session_id' => $session->getId(),
            'test_value' => $session->get('test_key')
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => $e->getMessage(),
            'trace' => $e->getTraceAsString()
        ], 500);
    }
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

// Context7 Integration Demo
Route::prefix('context7')->name('context7.')->group(function () {
    Route::get('/demo', [App\Http\Controllers\Context7DemoController::class, 'index'])->name('demo');
    Route::post('/demo/query', [App\Http\Controllers\Context7DemoController::class, 'demoQuery'])->name('demo.query');
    Route::post('/demo/search', [App\Http\Controllers\Context7DemoController::class, 'demoSearch'])->name('demo.search');
});

// API Routes for testing
Route::prefix('api')->group(function () {
    Route::post('/test-endpoint', [MCPActionController::class, 'testEndpoint'])->name('api.test-endpoint');
    Route::post('/generate-mcp-config', [MCPServerController::class, 'generateConfig'])->name('api.generate-config');
});
