<?php

namespace App\Livewire;

use App\Models\MCPServer;
use App\Models\MCPAction;
use Livewire\Component;
use Livewire\WithPagination;

class MCPServerManager extends Component
{
    use WithPagination;

    public $layout = 'components.layouts.app';

    public $showCreateForm = false;
    public $editingServer = null;
    public $name = '';
    public $description = '';
    public $version = '1.0.0';
    public $author = '';
    public $port = 3000;

    protected $rules = [
        'name' => 'required|string|max:255',
        'description' => 'nullable|string|max:1000',
        'version' => 'required|string|max:50',
        'author' => 'nullable|string|max:255',
        'port' => 'required|integer|min:1000|max:65535',
    ];

    public function render()
    {
        return view('livewire.mcp-server-manager', [
            'servers' => MCPServer::with('actions')->paginate(10)
        ]);
    }

    public function createServer()
    {
        $this->showCreateForm = true;
        $this->reset(['name', 'description', 'version', 'author', 'port']);
    }

    public function saveServer()
    {
        $this->validate();

        if ($this->editingServer) {
            $this->editingServer->update([
                'name' => $this->name,
                'description' => $this->description,
                'version' => $this->version,
                'author' => $this->author,
                'port' => $this->port,
            ]);
        } else {
            MCPServer::create([
                'name' => $this->name,
                'description' => $this->description,
                'version' => $this->version,
                'author' => $this->author,
                'port' => $this->port,
            ]);
        }

        $this->reset(['showCreateForm', 'editingServer', 'name', 'description', 'version', 'author', 'port']);
        $this->dispatch('server-saved');
    }

    public function editServer(MCPServer $server)
    {
        $this->editingServer = $server;
        $this->name = $server->name;
        $this->description = $server->description;
        $this->version = $server->version;
        $this->author = $server->author;
        $this->port = $server->port;
        $this->showCreateForm = true;
    }

    public function deleteServer(MCPServer $server)
    {
        $server->delete();
        $this->dispatch('server-deleted');
    }

    public function cancelEdit()
    {
        $this->reset(['showCreateForm', 'editingServer', 'name', 'description', 'version', 'author', 'port']);
    }

    public function toggleStatus(MCPServer $server)
    {
        $server->update([
            'status' => $server->status === 'active' ? 'inactive' : 'active'
        ]);
    }
}
