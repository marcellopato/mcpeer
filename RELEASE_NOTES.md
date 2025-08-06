# MCPeer v1.0.0-alpha - Initial Alpha Release 🚀

First alpha release of **MCPeer**, a visual platform for managing **Model Context Protocol (MCP)** servers.

## 🎯 What is MCPeer?

MCPeer standardizes MCP implementation with a visual, intuitive interface built on modern web technologies. Create MCP adapters for your APIs (GitLab, Jira, Trello, etc.) without complex manual coding.

## ✨ Key Features

- **🎨 Visual MCP Configuration** - Configure actions (query, mutation, stream) through intuitive UI
- **⚡ Auto Code Generation** - Automatic PHP backend and Docker configuration generation
- **🐳 Docker Ready** - Complete containerized environment with MySQL, Redis, Nginx
- **🌙 Dark Mode Support** - Automatic dark mode based on system preferences
- **🔧 Laravel Foundation** - Built on Laravel 10.x with modern PHP 8.1+ features
- **📚 Comprehensive Docs** - Full documentation and contribution guidelines
- **🤖 GitHub Copilot Integration** - AI-assisted contributions welcome

## 💻 Tech Stack

- **Backend**: PHP 8.1+ with Laravel Framework 10.x
- **Frontend**: Blade Templates + TailwindCSS + Alpine.js  
- **Containerization**: Docker + Docker Compose
- **Database**: MySQL 8.0 + Redis for caching
- **Build Tools**: Vite for asset compilation
- **CI/CD**: GitHub Actions workflow

## 🚀 Quick Start

```bash
# Clone the repository
git clone https://github.com/marcellopato/mcpeer.git
cd mcpeer

# Set up environment
cp .env.example .env

# Start with Docker (Recommended)
docker-compose up -d
docker-compose exec app composer install
docker-compose exec app php artisan key:generate
docker-compose exec app php artisan migrate

# Install frontend dependencies
npm install && npm run build

# Access the application
# Docker: http://localhost:8080
# Local: http://localhost:8000
```

## 📋 Current Status

### ✅ Phase 1 (Current - Alpha Release)
- [x] Complete Laravel project structure
- [x] Docker containerization setup  
- [x] Frontend with TailwindCSS and dark mode
- [x] Professional brand identity and documentation
- [x] GitHub integration with CI/CD pipeline
- [x] Community contribution guidelines
- [ ] MCP Actions CRUD interface
- [ ] Server management dashboard

### 🔄 Phase 2 (Next - Beta Release)
- [ ] API testing interface
- [ ] MCP configuration generator  
- [ ] Authentication systems
- [ ] Real-time validation

### 🚀 Phase 3 (Future - Stable Release)  
- [ ] AI-powered action generation
- [ ] MCP template marketplace
- [ ] Advanced monitoring
- [ ] Multi-tenant support

## ⚠️ Important Notes

**Alpha Release Warning**: This is an early alpha version intended for development and testing purposes. Not recommended for production use.

**Missing Features**: Core MCP functionality (CRUD operations, server management) is still under development.

## 🤝 Community & Support

- **🐛 Issues**: [Report bugs and request features](https://github.com/marcellopato/mcpeer/issues)
- **💬 Discussions**: [Join community discussions](https://github.com/marcellopato/mcpeer/discussions)  
- **📖 Wiki**: [Documentation and guides](https://github.com/marcellopato/mcpeer/wiki)
- **💖 Sponsors**: [Support development](https://github.com/sponsors/marcellopato)

## 🎉 What's Next?

1. **Complete Phase 1**: Finish MCP Actions CRUD and Server management
2. **Beta Release**: Add API testing and real-time validation  
3. **Community Growth**: Promote in Laravel, MCP, and DevTools communities
4. **Feature Expansion**: AI-powered generation and advanced features

## 📈 Project Stats

- **Language**: PHP (Laravel)
- **Dependencies**: 25+ Composer packages
- **Docker Services**: 4 (App, MySQL, Redis, Nginx)
- **Documentation**: Comprehensive README, contributing guides
- **Community**: Open for contributions, GitHub Copilot friendly

---

**Built with ❤️ by the MCPeer community**

*Making Model Context Protocol adoption simple and visual for everyone*
