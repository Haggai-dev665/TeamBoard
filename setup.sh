#!/bin/bash

# TeamBoard Quick Setup Script
# This script automates the initial setup process

set -e

echo "🚀 TeamBoard Quick Setup Script"
echo "================================"
echo ""

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

# Function to print colored output
print_success() {
    echo -e "${GREEN}✓ $1${NC}"
}

print_error() {
    echo -e "${RED}✗ $1${NC}"
}

print_warning() {
    echo -e "${YELLOW}⚠ $1${NC}"
}

print_info() {
    echo "ℹ $1"
}

# Check if required commands exist
check_requirements() {
    print_info "Checking system requirements..."
    
    if ! command -v php &> /dev/null; then
        print_error "PHP is not installed. Please install PHP 8.2 or higher."
        exit 1
    fi
    
    if ! command -v composer &> /dev/null; then
        print_error "Composer is not installed. Please install Composer."
        exit 1
    fi
    
    if ! command -v node &> /dev/null; then
        print_error "Node.js is not installed. Please install Node.js 18 or higher."
        exit 1
    fi
    
    if ! command -v npm &> /dev/null; then
        print_error "NPM is not installed. Please install NPM."
        exit 1
    fi
    
    print_success "All required tools are installed"
}

# Install PHP dependencies
install_php_dependencies() {
    print_info "Installing PHP dependencies..."
    composer install || {
        print_error "Failed to install PHP dependencies"
        exit 1
    }
    print_success "PHP dependencies installed"
}

# Install JavaScript dependencies
install_js_dependencies() {
    print_info "Installing JavaScript dependencies..."
    npm install || {
        print_error "Failed to install JavaScript dependencies"
        exit 1
    }
    print_success "JavaScript dependencies installed"
}

# Setup environment
setup_environment() {
    print_info "Setting up environment..."
    
    if [ ! -f .env ]; then
        cp .env.example .env
        print_success "Environment file created"
    else
        print_warning "Environment file already exists, skipping..."
    fi
    
    php artisan key:generate
    print_success "Application key generated"
}

# Setup database
setup_database() {
    print_info "Setting up database..."
    
    read -p "Have you created the database? (y/n) " -n 1 -r
    echo
    if [[ ! $REPLY =~ ^[Yy]$ ]]; then
        print_warning "Please create the database first and configure .env file"
        print_info "Database name: teamboard"
        print_info "Then run: php artisan migrate"
        return
    fi
    
    read -p "Do you want to run migrations? (y/n) " -n 1 -r
    echo
    if [[ $REPLY =~ ^[Yy]$ ]]; then
        php artisan migrate || {
            print_error "Migration failed. Please check your database configuration."
            exit 1
        }
        print_success "Database migrations completed"
        
        read -p "Do you want to seed the database with sample data? (y/n) " -n 1 -r
        echo
        if [[ $REPLY =~ ^[Yy]$ ]]; then
            php artisan db:seed
            print_success "Database seeded with sample data"
            echo ""
            print_info "Default Credentials:"
            echo "  Admin: admin@teamboard.com / password"
            echo "  User:  john@teamboard.com / password"
        fi
    fi
}

# Create storage link
create_storage_link() {
    print_info "Creating storage link..."
    php artisan storage:link
    print_success "Storage link created"
}

# Build assets
build_assets() {
    print_info "Building frontend assets..."
    
    read -p "Build for production? (y/n) " -n 1 -r
    echo
    if [[ $REPLY =~ ^[Yy]$ ]]; then
        npm run build
        print_success "Production assets built"
    else
        print_info "To start development server, run: npm run dev"
        print_info "Keep it running in a separate terminal"
    fi
}

# Main setup flow
main() {
    echo ""
    check_requirements
    echo ""
    
    install_php_dependencies
    echo ""
    
    install_js_dependencies
    echo ""
    
    setup_environment
    echo ""
    
    create_storage_link
    echo ""
    
    setup_database
    echo ""
    
    build_assets
    echo ""
    
    print_success "Setup completed successfully! 🎉"
    echo ""
    echo "Next steps:"
    echo "  1. Configure your .env file (database, mail, etc.)"
    echo "  2. Run: php artisan serve"
    echo "  3. Visit: http://localhost:8000"
    echo "  4. Login with: admin@teamboard.com / password"
    echo ""
    print_info "For more information, see README.md"
    echo ""
}

# Run main function
main
