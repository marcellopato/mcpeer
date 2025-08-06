# Contributing to MCPeer 🤝

Thank you for considering contributing to MCPeer! We're excited to have you join our community of developers working to make MCP adoption simple and accessible.

## 🚀 Getting Started

### Prerequisites

Before you start contributing, make sure you have:

- **Git** installed on your system
- **PHP 8.1+** and **Composer**
- **Node.js 18+** and **npm**
- **Docker** and **Docker Compose** (recommended)
- Basic knowledge of Laravel, TailwindCSS, and MCP concepts

### Setting up your Development Environment

1. **Fork the repository** on GitHub
2. **Clone your fork**:
   ```bash
   git clone https://github.com/YOUR_USERNAME/mcpeer.git
   cd mcpeer
   ```

3. **Set up the development environment**:
   ```bash
   # Copy environment file
   cp .env.example .env
   
   # Start with Docker (recommended)
   docker-compose up -d
   
   # Or set up locally
   composer install
   php artisan key:generate
   npm install
   ```

4. **Create a new branch** for your feature:
   ```bash
   git checkout -b feature/your-amazing-feature
   ```

## 📋 How to Contribute

### 1. Code Contributions

- **Bug Fixes**: Find and fix bugs, improve error handling
- **New Features**: Add new MCP actions, UI improvements, integrations
- **Performance**: Optimize database queries, caching, frontend performance
- **Refactoring**: Improve code structure and maintainability

### 2. Documentation

- **API Documentation**: Document new endpoints and features
- **User Guides**: Create tutorials and how-to guides
- **Code Comments**: Improve inline documentation
- **README Updates**: Keep documentation current

### 3. Testing

- **Unit Tests**: Write tests for new features and bug fixes
- **Integration Tests**: Test API endpoints and workflows
- **End-to-End Tests**: Validate complete user scenarios
- **Performance Tests**: Benchmark and load testing

### 4. Design and UX

- **UI/UX Improvements**: Enhance user experience and interface design
- **Accessibility**: Ensure WCAG compliance
- **Mobile Responsiveness**: Optimize for different screen sizes
- **Dark Mode**: Improve dark theme implementation

## 🤖 AI and GitHub Copilot Contributions

**MCPeer actively welcomes AI-assisted contributions!**

### GitHub Copilot Integration

- ✅ **Authorized**: GitHub Copilot can create Pull Requests
- ✅ **Encouraged**: AI-generated code improvements are welcome
- ✅ **Supported**: Use `#github-pull-request_copilot-coding-agent` in issues

### AI Contribution Guidelines

1. **Quality First**: AI-generated code should be reviewed and tested
2. **Documentation**: Include clear commit messages and PR descriptions
3. **Testing**: Add appropriate tests for AI-generated features
4. **Review Process**: All AI contributions go through the same review process

## 📝 Coding Standards

### PHP (Laravel)

- Follow **PSR-12** coding standards
- Use **Laravel conventions** for naming and structure
- Write **meaningful variable names** and comments
- Include **type hints** where appropriate

```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExampleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        // Implementation
    }
}
```

### Frontend (JavaScript/CSS)

- Use **ES6+** syntax
- Follow **TailwindCSS** utility-first approach
- Write **semantic HTML**
- Ensure **accessibility** (ARIA labels, keyboard navigation)

### Database

- Use **descriptive migration names**
- Include **foreign key constraints**
- Add **indexes** for performance
- Write **seeders** for test data

## 🧪 Testing Guidelines

### Running Tests

```bash
# PHP tests
./vendor/bin/phpunit

# JavaScript tests (if applicable)
npm test

# Run all tests
composer test
```

### Writing Tests

- **Unit Tests**: Test individual functions and classes
- **Feature Tests**: Test HTTP endpoints and user workflows
- **Database Tests**: Use transactions and factories

```php
<?php

namespace Tests\Feature;

use Tests\TestCase;

class ExampleTest extends TestCase
{
    public function test_example_endpoint(): void
    {
        $response = $this->get('/api/example');
        
        $response->assertStatus(200)
                ->assertJson(['success' => true]);
    }
}
```

## 📦 Submitting Your Contribution

### Before Submitting

1. **Test thoroughly**: Run all tests and verify manually
2. **Follow code style**: Use `composer lint` to check style
3. **Update documentation**: Include relevant documentation updates
4. **Write clear commit messages**: Use conventional commit format

### Commit Message Format

```
type(scope): description

[optional body]

[optional footer]
```

Examples:
- `feat(api): add MCP action validation endpoint`
- `fix(ui): resolve dark mode toggle issue`
- `docs(readme): update installation instructions`
- `test(actions): add unit tests for action controller`

### Creating a Pull Request

1. **Push your branch** to your fork
2. **Create a Pull Request** against the `main` branch
3. **Use our PR template** and fill out all sections
4. **Link related issues** using keywords (Fixes #123)
5. **Add appropriate labels** (feature, bugfix, documentation, etc.)

### Review Process

1. **Automated Checks**: CI/CD will run tests and linting
2. **Code Review**: Maintainers will review your changes
3. **Feedback**: Address any requested changes
4. **Merge**: Once approved, your PR will be merged

## 🏆 Recognition

We value all contributions! Contributors will be:

- **Listed** in our README
- **Credited** in release notes
- **Invited** to join our contributor Discord/Slack
- **Eligible** for contributor badges and swag

## 🆘 Getting Help

### Questions or Issues?

- **GitHub Discussions**: Ask questions and share ideas
- **GitHub Issues**: Report bugs and request features
- **Discord/Slack**: Real-time chat with the community
- **Email**: Contact maintainers directly

### Resources

- **Laravel Documentation**: https://laravel.com/docs
- **TailwindCSS Documentation**: https://tailwindcss.com/docs
- **MCP Specification**: https://modelcontextprotocol.io/docs
- **Docker Documentation**: https://docs.docker.com

## 📜 Code of Conduct

By participating in this project, you agree to abide by our Code of Conduct:

- **Be respectful** and inclusive
- **Be constructive** in feedback
- **Be collaborative** and helpful
- **Be mindful** of different backgrounds and experiences

## 🎯 Current Priorities

Check our [GitHub Issues](https://github.com/marcellopato/mcpeer/issues) and [Project Board](https://github.com/marcellopato/mcpeer/projects) for current priorities:

- **High Priority**: Core MCP functionality, security fixes
- **Medium Priority**: UI/UX improvements, performance optimizations
- **Low Priority**: Nice-to-have features, documentation updates

---

**Thank you for contributing to MCPeer! Together, we're making MCP adoption simple and accessible for everyone.** 🚀

*Happy coding!*
