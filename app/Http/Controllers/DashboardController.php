<?php

namespace App\Http\Controllers;

use App\Models\MCPServer;
use App\Models\MCPAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    /**
     * Display the dashboard with overview statistics
     */
    public function index(Request $request)
    {
        try {
            // Ensure session is available
            if (!$request->hasSession()) {
                Log::warning('Dashboard: No session available, creating one');
                $sessionManager = app('session');
                $session = $sessionManager->driver();
                $request->setSession($session);
            }

            // Start session if needed
            if (!$request->session()->isStarted()) {
                $request->session()->start();
            }

            // Get statistics safely
            $stats = [
                'mcp_actions' => $this->safeCount(MCPAction::class),
                'active_servers' => $this->safeCountWhere(MCPServer::class, 'status', 'active'),
                'total_servers' => $this->safeCount(MCPServer::class),
                'integrations' => 0, // Future feature
            ];
            
            return view('dashboard', compact('stats'));
            
        } catch (\Exception $e) {
            Log::error('Dashboard error: ' . $e->getMessage());
            
            // Fallback stats if database fails
            $stats = [
                'mcp_actions' => 0,
                'active_servers' => 0,
                'total_servers' => 0,
                'integrations' => 0,
            ];
            
            return view('dashboard', compact('stats'));
        }
    }

    private function safeCount($model)
    {
        try {
            return $model::count();
        } catch (\Exception $e) {
            Log::warning("Failed to count {$model}: " . $e->getMessage());
            return 0;
        }
    }

    private function safeCountWhere($model, $column, $value)
    {
        try {
            return $model::where($column, $value)->count();
        } catch (\Exception $e) {
            Log::warning("Failed to count {$model} where {$column}={$value}: " . $e->getMessage());
            return 0;
        }
    }
}
