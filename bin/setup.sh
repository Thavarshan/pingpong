#!/bin/bash

function main() {
    installProject
    if [ $? -eq 0 ]; then
        php artisan blaze:project
    fi
}

# Install Composer & JS dependencies, restructure project directories and compile assets.
function installProject() {
    installDependencies
    prepareProjectFiles
    installAndCompileAssets
}

# Install new Composer dependencies to package.json.
function installDependencies() {
    printf "Installing dependencies\n"
    COMPOSER_MEMORY_LIMIT=-1 composer update
}

# Create .env file, generate app key and set permission to artisan file.
function prepareProjectFiles() {
    if [[ ! -f .env && -f .env.example ]]; then
        printf "Copying environment variables\n"
        cp .env.example .env
    fi
    printf "Setting permissions\n"
    chmod +x artisan
    printf "Generate new application key\n"
    php artisan key:generate
}

# Install JS dependencies and compile assets.
function installAndCompileAssets() {
    printf "Installing assets\n"
    npm i
    printf "Compiling assets\n"
    npm run dev
}

main
