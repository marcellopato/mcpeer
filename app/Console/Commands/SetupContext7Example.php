<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Database\Seeders\Context7ExampleSeeder;

class SetupContext7Example extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mcpeer:setup-context7 {--fresh : Delete existing Context7 data first}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Setup Context7 as an example MCP server in MCPeer';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $this->info('🚀 Setting up Context7 MCP Server example...');
        $this->newLine();

        if ($this->option('fresh')) {
            $this->warn('🗑️  Removing existing Context7 data...');
            
            // Remove existing Context7 server and actions
            \App\Models\MCPServer::where('slug', 'context7-docs')->delete();
            
            $this->info('✅ Existing data cleaned');
        }

        // Run the seeder
        $this->info('📦 Creating Context7 example data...');
        
        $seeder = new Context7ExampleSeeder();
        $seeder->setCommand($this);
        $seeder->run();

        $this->newLine();
        $this->info('🎉 Context7 integration setup complete!');
        $this->newLine();

        // Display usage information
        $this->comment('📖 How to use:');
        $this->line('  1. Visit: http://localhost:8080/mcp/servers');
        $this->line('  2. Find "Context7 Documentation Server"');
        $this->line('  3. Click actions to see MCP integration examples');
        $this->line('  4. Test the actions to see real Context7 responses');
        $this->newLine();

        $this->comment('🔗 Context7 Resources:');
        $this->line('  • Website: https://context7.com');
        $this->line('  • GitHub: https://github.com/upstash/context7');
        $this->line('  • MCP Endpoint: https://mcp.context7.com/mcp');
        $this->newLine();

        $this->comment('🛠️  Example usage in your applications:');
        $this->line('  • Query Laravel 10.x documentation');
        $this->line('  • Search for React components');
        $this->line('  • Compare Python frameworks');
        $this->line('  • Stream library update notifications');

        return Command::SUCCESS;
    }
}
