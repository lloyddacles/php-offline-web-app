#!/bin/bash
# ============================================
# LD TechLab - Setup Script
# Auto-detects platform and downloads PHP
# ============================================

set -e

cd "$(dirname "$0")"

PHP_VERSION="8.5.8"
BASE_URL="https://dl.static-php.dev/static-php-cli/common"

echo ""
echo "  =========================================="
echo "   LD TechLab - Setup"
echo "  =========================================="
echo ""

# Detect platform
OS="$(uname -s)"
ARCH="$(uname -m)"

case "$OS" in
    Darwin)
        if [ "$ARCH" = "arm64" ]; then
            PLATFORM="macos-arm64"
            FILENAME="php-macos-arm64"
        else
            PLATFORM="macos-x86_64"
            FILENAME="php-macos-x86_64"
        fi
        ;;
    Linux*)
        if [ "$ARCH" = "x86_64" ]; then
            PLATFORM="linux-x86_64"
            FILENAME="php-linux-x86_64"
        elif [ "$ARCH" = "aarch64" ]; then
            PLATFORM="linux-aarch64"
            FILENAME="php-linux-aarch64"
        else
            echo "  Unsupported Linux architecture: $ARCH"
            echo "  Install PHP manually: https://www.php.net/downloads"
            exit 1
        fi
        ;;
    MINGW*|MSYS*|CYGWIN*)
        echo "  Windows detected. For Windows:"
        echo ""
        echo "  Option 1: Install PHP via winget"
        echo "    winget install PHP.PHP"
        echo ""
        echo "  Option 2: Download PHP manually"
        echo "    https://windows.php.net/download/"
        echo "    Extract php.exe to the bin\\ folder"
        echo ""
        echo "  Option 3: Use Git Bash and run this script again"
        exit 0
        ;;
    *)
        echo "  Unsupported OS: $OS"
        echo "  Install PHP manually: https://www.php.net/downloads"
        exit 1
        ;;
esac

echo "  Platform: $PLATFORM"
echo "  PHP: $PHP_VERSION"
echo ""

# Check if already installed
if [ -x "./bin/$FILENAME" ]; then
    echo "  PHP is already installed."
    echo "  Run ./start.sh to launch the server."
    exit 0
fi

# Check if curl is available
if ! command -v curl >/dev/null 2>&1; then
    echo "  curl is required but not installed."
    echo "  Install curl or download PHP manually."
    exit 1
fi

echo "  Downloading PHP $PHP_VERSION for $PLATFORM..."
echo ""

DOWNLOAD_URL="$BASE_URL/php-$PHP_VERSION-cli-$PLATFORM.tar.gz"
TEMP_FILE="/tmp/php-download-$$.tar.gz"

curl -L -o "$TEMP_FILE" "$DOWNLOAD_URL" --progress-bar

if [ ! -s "$TEMP_FILE" ]; then
    echo ""
    echo "  Download failed. Check your internet connection."
    rm -f "$TEMP_FILE"
    exit 1
fi

echo ""
echo "  Extracting..."
mkdir -p bin
tar xzf "$TEMP_FILE" -C bin
mv "bin/php" "bin/$FILENAME"
chmod +x "bin/$FILENAME"
rm -f "$TEMP_FILE"

echo ""
echo "  =========================================="
echo "   Setup Complete!"
echo "  =========================================="
echo ""
echo "  Start the server with:"
echo "    ./start.sh"
echo ""
