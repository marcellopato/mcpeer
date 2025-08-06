# MCPeer 🚀

![MCPeer Logo](./logo.png) <!-- Place your logo here -->

[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)
[![Laravel](https://img.shields.io/badge/Laravel-10.x-red.svg)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.1%2B-blue.svg)](https://www.php.net)
[![Docker](https://img.shields.io/badge/Docker-Ready-blue.svg)](https://www.docker.com)

## What is MCPeer?

**MCPeer** is a visual platform for creating, configuring, and managing **Model Context Protocol (MCP)** servers in a simple, visual, and standardized way.

Built with a modern interface using **PHP + TailwindCSS** and containerized with **Docker**, MCPeer enables companies, developers, and teams to create MCP adapters for their APIs (like GitLab, Jira, Trello, etc.) quickly, without the need for complex manual coding.

---

## Why use MCPeer?

- **Standardizes MCP implementation**, making it easier to adopt the protocol across multiple systems
- **Visual configuration** for MCP actions (`query`, `mutation`, `stream`) connected to existing APIs via visual interface or YAML/JSON files
- **Automatically generates** PHP backend code and Docker configuration ready for deployment
- **Automatic dark mode** support via TailwindCSS, ensuring great usability for all users
- **Facilitates integrations** with AI, chatbots, and intelligent UIs that depend on MCP for contextual communication

---

## Key Features

- 🎯 **Web interface** to define MCP actions, parameters, and HTTP handlers
- ⚡ **Automatic generation** of MCP servers based on Laravel/PHP
- 🔐 **Simple authentication** setup for external APIs (Token, Basic, OAuth2)
- 👀 **Visualization and testing** of MCP responses within the platform
- 📦 **Project export** with Dockerfile and MCP specification file (`mcp.json`)
- 🌙 **Dark mode support** based on user system preferences
- 🔄 **Real-time API testing** and validation
- 📚 **Comprehensive documentation** generation

---

## Tech Stack

- **Backend**: PHP 8.1+ with Laravel Framework
- **Frontend**: Blade Templates + TailwindCSS + Alpine.js
- **Containerization**: Docker + Docker Compose
- **Database**: MySQL 8.0 + Redis for caching
- **Build Tools**: Vite for asset compilation
- **Future Integration**: OpenAI GPT / Claude for automatic MCP action generation

---

## Getting Started

### Prerequisites

- Docker and docker-compose installed
- PHP 8.1+ (for local development)
- Composer (for PHP dependencies)
- Node.js 18+ (for frontend assets)

### Quick Start

1. **Clone the repository:**

   ```

2. **Set up environment variables:**

   ```bash
   cp .env.example .env
   ```

3. **Using Docker (Recommended):**

   ```bash
   # Start all services
   docker-compose up -d
   
   # Install dependencies
   docker-compose exec app composer install
   docker-compose exec app php artisan key:generate
   docker-compose exec app php artisan migrate
   
   # Install frontend dependencies and build assets
   npm install
   npm run build
   ```

4. **Or run locally:**

   ```bash
   # Install PHP dependencies
   composer install
   
   # Generate application key
   php artisan key:generate
   
   # Install frontend dependencies
   npm install
   npm run dev
   
   # Start the development server
   php artisan serve
   ```

5. **Access the application:**
   - Docker: `http://localhost:8080`
   - Local: `http://localhost:8000`

---

## Project Structure

```
mcpeer/
├── app/
│   └── Http/Controllers/     # Laravel controllers
├── resources/
│   ├── views/               # Blade templates
│   ├── css/                 # Stylesheets
│   └── js/                  # JavaScript files
├── docker/                  # Docker configuration
├── routes/                  # Application routes
├── public/                  # Public assets
├── docker-compose.yml       # Docker services
└── README.md               # This file
```

---

## Contributing 🤝

We welcome contributions from developers, designers, and MCP enthusiasts! 

### How to Contribute

1. **Fork the repository**
2. **Create a feature branch**: `git checkout -b feature/amazing-feature`
3. **Make your changes** and add tests if applicable
4. **Follow our coding standards** (Laravel PSR-12)
5. **Commit your changes**: `git commit -m 'Add: Amazing feature'`
6. **Push to the branch**: `git push origin feature/amazing-feature`
7. **Open a Pull Request**

### GitHub Copilot Integration 🤖

**MCPeer officially supports and welcomes GitHub Copilot contributions!**

- ✅ **Copilot can create Pull Requests** to improve features
- ✅ **AI-generated code contributions** are welcome and encouraged
- ✅ **Automated improvements** and bug fixes by AI assistants
- ✅ **Documentation enhancements** via AI tools

To authorize GitHub Copilot to contribute:
1. Enable GitHub Actions in your fork
2. Use the `#github-pull-request_copilot-coding-agent` hashtag in issues
3. Copilot will automatically create branches and PRs for improvements

### Contribution Guidelines

- **Code Style**: Follow Laravel conventions and PSR-12 standards
- **Testing**: Add tests for new features
- **Documentation**: Update README and inline docs
- **Commit Messages**: Use conventional commit format
- **Issues**: Use our issue templates for bugs and features

### Areas for Contribution

- 🔧 **Backend Features**: New MCP actions, API integrations
- 🎨 **Frontend/UI**: Interface improvements, new components
- 🐳 **DevOps**: Docker improvements, CI/CD workflows  
- 📚 **Documentation**: Guides, tutorials, API docs
- 🧪 **Testing**: Unit tests, integration tests
- 🌐 **Internationalization**: Multi-language support
- ⚡ **Performance**: Optimization and caching improvements

---

## Roadmap 🗺️

### Phase 1 (Current)
- [x] Basic project structure
- [x] Docker configuration
- [x] Laravel framework setup
- [x] Frontend with TailwindCSS
- [ ] MCP Actions CRUD
- [ ] Server management interface

### Phase 2
- [ ] API testing interface
- [ ] MCP configuration generator
- [ ] Authentication systems
- [ ] Real-time validation

### Phase 3
- [ ] AI-powered action generation
- [ ] Marketplace for MCP templates
- [ ] Advanced monitoring
- [ ] Multi-tenant support

---

## License 📄

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

---

## Support & Community 💬

- **GitHub Issues**: [Report bugs and request features](https://github.com/marcellopato/mcpeer/issues)
- **Discussions**: [Join community discussions](https://github.com/marcellopato/mcpeer/discussions)
- **Wiki**: [Documentation and guides](https://github.com/marcellopato/mcpeer/wiki)

---

## Acknowledgments 🙏

- Model Context Protocol (MCP) specification
- Laravel community for the amazing framework
- TailwindCSS for beautiful styling
- Docker for containerization
- All contributors who help make MCPeer better

---

## Star History ⭐

[![Star History Chart](https://api.star-history.com/svg?repos=marcellopato/mcpeer&type=Date)](https://star-history.com/#marcellopato/mcpeer&Date)

---

**Made with ❤️ by the MCPeer community**

*MCPeer - Making MCP adoption simple and visual for everyone*bash
   git clone https://github.com/marcellopato/mcpeer.git
   cd mcpeer
