import './bootstrap';

// Alpine.js is handled by Livewire automatically
// Removed: import Alpine from 'alpinejs'; to avoid conflicts

// Dark mode toggle functionality
function initDarkMode() {
    // Check for saved theme preference or default to system preference
    const savedTheme = localStorage.getItem('theme');
    const systemPrefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
    
    if (savedTheme === 'dark' || (!savedTheme && systemPrefersDark)) {
        document.documentElement.classList.add('dark');
    } else {
        document.documentElement.classList.remove('dark');
    }
}

// Theme toggle function
window.toggleTheme = function() {
    const isDark = document.documentElement.classList.contains('dark');
    
    if (isDark) {
        document.documentElement.classList.remove('dark');
        localStorage.setItem('theme', 'light');
    } else {
        document.documentElement.classList.add('dark');
        localStorage.setItem('theme', 'dark');
    }
};

// Initialize dark mode on load
document.addEventListener('DOMContentLoaded', initDarkMode);

// Listen for system theme changes
window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', (e) => {
    if (!localStorage.getItem('theme')) {
        if (e.matches) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    }
});

// MCPeer specific JavaScript functionality
window.MCPeer = {
    // Function to validate MCP action configuration
    validateMCPAction(action) {
        const required = ['name', 'description', 'handler'];
        return required.every(field => action[field] && action[field].trim() !== '');
    },
    
    // Function to generate MCP server configuration
    generateMCPConfig(actions) {
        return {
            version: "1.0",
            actions: actions.map(action => ({
                name: action.name,
                description: action.description,
                parameters: action.parameters || {},
                handler: action.handler
            }))
        };
    },
    
    // API testing functionality
    async testAPIEndpoint(endpoint, method = 'GET', headers = {}, body = null) {
        try {
            const response = await fetch(endpoint, {
                method,
                headers: {
                    'Content-Type': 'application/json',
                    ...headers
                },
                body: body ? JSON.stringify(body) : null
            });
            
            return {
                status: response.status,
                data: await response.json(),
                success: response.ok
            };
        } catch (error) {
            return {
                success: false,
                error: error.message
            };
        }
    }
};
