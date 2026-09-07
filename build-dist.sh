#!/bin/bash
# ============================================
# LD TechLab - Build Distribution Package
# Creates a ZIP with all binaries included
# ============================================

set -e

cd "$(dirname "$0")"

VERSION="1.0.0"
NAME="LD-TechLab-v${VERSION}"
DIST_DIR="/tmp/${NAME}"

echo ""
echo "  Building distribution package: ${NAME}"
echo ""

# Clean
rm -rf "$DIST_DIR"
mkdir -p "$DIST_DIR"

# Copy project files (excluding .git and temp files)
echo "  Copying project files..."
rsync -a --exclude='.git' --exclude='tmp' --exclude='*.tmp' --exclude='.DS_Store' \
    --exclude='bin/php' --exclude='bin/php-*' --exclude='bin/*.tar.gz' \
    ./ "$DIST_DIR/"

# Copy binaries if they exist
echo "  Copying PHP binaries..."
mkdir -p "$DIST_DIR/bin"
for f in bin/php-*; do
    if [ -f "$f" ] && [ -x "$f" ]; then
        cp "$f" "$DIST_DIR/bin/"
        echo "    $(basename $f) ($(du -h "$f" | cut -f1))"
    fi
done

# Create ZIP
echo ""
echo "  Creating ZIP archive..."
cd /tmp
zip -r -q "${NAME}.zip" "$NAME"
SIZE=$(du -h "${NAME}.zip" | cut -f1)

echo ""
echo "  =========================================="
echo "   Distribution Package Ready!"
echo "  =========================================="
echo ""
echo "  File: /tmp/${NAME}.zip"
echo "  Size: $SIZE"
echo ""
echo "  Contents:"
echo "    - All lessons (84 total)"
echo "    - All demos (7 interactive)"
echo "    - PHP binaries for macOS (ARM + Intel)"
echo "    - PHP binaries for Linux (x86_64)"
echo "    - Start scripts for Mac/Linux/Windows"
echo "    - Setup script for auto-downloading PHP"
echo ""
echo "  To distribute:"
echo "    1. Share the ZIP file with teachers"
echo "    2. They extract it"
echo "    3. Double-click start.command (Mac)"
echo "       or run start.sh (Linux)"
echo "       or double-click start.bat (Windows)"
echo ""
