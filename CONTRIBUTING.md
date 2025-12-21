# Contributing to TeamBoard

First off, thank you for considering contributing to TeamBoard! It's people like you that make TeamBoard such a great tool.

## Code of Conduct

This project and everyone participating in it is governed by our Code of Conduct. By participating, you are expected to uphold this code.

## How Can I Contribute?

### Reporting Bugs

Before creating bug reports, please check the existing issues as you might find out that you don't need to create one. When you are creating a bug report, please include as many details as possible:

* **Use a clear and descriptive title**
* **Describe the exact steps which reproduce the problem**
* **Provide specific examples to demonstrate the steps**
* **Describe the behavior you observed after following the steps**
* **Explain which behavior you expected to see instead and why**
* **Include screenshots if possible**

### Suggesting Enhancements

Enhancement suggestions are tracked as GitHub issues. When creating an enhancement suggestion, please include:

* **Use a clear and descriptive title**
* **Provide a step-by-step description of the suggested enhancement**
* **Provide specific examples to demonstrate the steps**
* **Describe the current behavior and explain which behavior you expected to see instead**
* **Explain why this enhancement would be useful**

### Pull Requests

* Fill in the required template
* Do not include issue numbers in the PR title
* Follow the PHP and JavaScript style guides
* Include thoughtfully-worded, well-structured tests
* Document new code
* End all files with a newline

## Development Process

### Setting Up Your Development Environment

1. Fork the repository
2. Clone your fork: `git clone https://github.com/your-username/TeamBoard.git`
3. Install dependencies: `composer install && npm install`
4. Copy `.env.example` to `.env` and configure
5. Generate key: `php artisan key:generate`
6. Run migrations: `php artisan migrate`
7. Seed database: `php artisan db:seed`

### Making Changes

1. Create a branch: `git checkout -b feature/your-feature-name`
2. Make your changes
3. Write or update tests
4. Run tests: `php artisan test`
5. Commit your changes: `git commit -am 'Add some feature'`
6. Push to the branch: `git push origin feature/your-feature-name`
7. Submit a pull request

### Coding Standards

#### PHP
* Follow PSR-12 coding standard
* Use type hints where possible
* Write PHPDoc comments for classes and methods
* Keep methods focused and small

```php
/**
 * Create a new notice.
 *
 * @param  array  $data
 * @return \App\Models\Notice
 */
public function createNotice(array $data): Notice
{
    return Notice::create($data);
}
```

#### JavaScript
* Use ES6+ syntax
* Use meaningful variable names
* Add comments for complex logic

#### Blade Templates
* Use components where possible
* Keep logic minimal in views
* Use proper indentation (4 spaces)

### Testing

* Write tests for all new features
* Ensure all tests pass before submitting PR
* Aim for high code coverage

```bash
# Run all tests
php artisan test

# Run specific test
php artisan test --filter=NoticeTest

# Run with coverage
php artisan test --coverage
```

### Commit Messages

* Use the present tense ("Add feature" not "Added feature")
* Use the imperative mood ("Move cursor to..." not "Moves cursor to...")
* Limit the first line to 72 characters or less
* Reference issues and pull requests liberally after the first line

Good commit message:
```
Add employee photo upload feature

- Add photo field to employees table
- Create photo upload form component
- Implement image validation
- Add tests for photo upload

Closes #123
```

## Project Structure

```
TeamBoard/
├── app/
│   ├── Http/Controllers/     # Request handlers
│   ├── Models/               # Eloquent models
│   └── Policies/             # Authorization policies
├── database/
│   ├── migrations/           # Database migrations
│   └── seeders/              # Database seeders
├── resources/
│   ├── css/                  # Stylesheets
│   ├── js/                   # JavaScript
│   └── views/                # Blade templates
├── routes/
│   └── web.php               # Web routes
└── tests/
    ├── Feature/              # Feature tests
    └── Unit/                 # Unit tests
```

## Style Guides

### Git Branch Naming

* `feature/` - New features
* `bugfix/` - Bug fixes
* `hotfix/` - Urgent fixes
* `refactor/` - Code refactoring
* `docs/` - Documentation changes

Examples:
* `feature/add-employee-export`
* `bugfix/fix-notice-deletion`
* `docs/update-installation-guide`

### Code Review Process

1. All submissions require review
2. We use GitHub pull requests for this purpose
3. Reviewers will check:
   - Code quality and standards
   - Test coverage
   - Documentation
   - Security implications
   - Performance impact

## Additional Notes

### Issue and Pull Request Labels

* `bug` - Something isn't working
* `enhancement` - New feature or request
* `documentation` - Documentation improvements
* `good first issue` - Good for newcomers
* `help wanted` - Extra attention is needed
* `question` - Further information is requested

## Recognition

Contributors will be recognized in:
* README.md contributors section
* Release notes
* Project documentation

Thank you for contributing to TeamBoard! 🎉
