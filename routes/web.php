<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MCPActionController;
use App\Http\Controllers\MCPServerController;
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

// Dashboard
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// MCP Actions
Route::resource('actions', MCPActionController::class);

// MCP Servers
Route::resource('servers', MCPServerController::class);

// API Routes for testing
Route::prefix('api')->group(function () {
    Route::post('/test-endpoint', [MCPActionController::class, 'testEndpoint'])->name('api.test-endpoint');
    Route::post('/generate-mcp-config', [MCPServerController::class, 'generateConfig'])->name('api.generate-config');
});
