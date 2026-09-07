#!/bin/bash
# ============================================
# LD TechLab - Start Server
# Works on macOS and Linux
# ============================================

cd "$(dirname "$0")"

PORT=8080

# Find PHP binary
find_php() {
    # Check bundled binaries first (platform-specific)
    case "$(uname -s)" in
        Darwin)
            if [ "$(uname -m)" = "arm64" ] && [ -x "./bin/php-macos-arm64" ]; then
                echo "./bin/php-macos-arm64"
                return
            elif [ "$(uname -m)" = "x86_64" ] && [ -x "./bin/php-macos-x86_64" ]; then
                echo "./bin/php-macos-x86_64"
                return
            fi
            ;;
        Linux*)
            if [ "$(uname -m)" = "x86_64" ] && [ -x "./bin/php-linux-x86_64" ]; then
                echo "./bin/php-linux-x86_64"
                return
            fi
            ;;
    esac

    # Check for system PHP
    if command -v php >/dev/null 2>&1; then
        echo "php"
        return
    fi

    # Check common locations
    for p in /usr/local/bin/php /opt/homebrew/bin/php /usr/bin/php; do
        if [ -x "$p" ]; then
            echo "$p"
            return
        fi
    done

    return 1
}

PHP_BIN=$(find_php)

if [ -z "$PHP_BIN" ]; then
    echo ""
    echo "  =========================================="
    echo "   LD TechLab - PHP Not Found"
    echo "  =========================================="
    echo ""
    echo "  PHP is not installed or not bundled."
    echo "  Run ./setup.sh to download PHP, or"
    echo "  install PHP manually:"
    echo ""
    echo "    macOS:  brew install php"
    echo "    Ubuntu: sudo apt install php-cli"
    echo "    Other:  https://www.php.net/downloads"
    echo ""
    exit 1
fi

echo ""
echo "  =========================================="
echo "   LD TechLab Programming Tutorials"
echo "  =========================================="
echo ""
echo "  Starting server..."
echo "  PHP: $($PHP_BIN -v 2>&1 | head -1)"
echo ""
echo "  Open in your browser:"
echo "  >>> http://localhost:$PORT <<<"
echo ""
echo "  Press Ctrl+C to stop the server."
echo ""

$PHP_BIN -S "127.0.0.1:$PORT" -t public public/router.php
