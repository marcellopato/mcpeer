<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display the dashboard with overview statistics
     */
    public function index()
    {
        // In the future, we'll gather statistics here
        $stats = [
            'mcp_actions' => 0, // MCPAction::count()
            'active_servers' => 0, // MCPServer::where('status', 'active')->count()
            'integrations' => 0, // Future feature
        ];
        
        return view('dashboard', compact('stats'));
    }
}
