<?php

namespace App\Http\Controllers;

use App\Models\MCPServer;
use App\Models\MCPAction;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display the dashboard with overview statistics
     */
    public function index()
    {
        $stats = [
            'mcp_actions' => MCPAction::count(),
            'active_servers' => MCPServer::where('status', 'active')->count(),
            'total_servers' => MCPServer::count(),
            'integrations' => 0, // Future feature
        ];
        
        return view('dashboard', compact('stats'));
    }
}
