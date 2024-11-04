#!/usr/bin/env bash

# Get the plugin slug from this git repository.
PLUGIN_SLUG="${PWD##*/}"
echo "ℹ︎ SLUG is $SLUG"

# Get the current release version
VERSION="${TAG_NAME#v}"
echo "ℹ︎ VERSION is $VERSION"

# Get the SVN data from wp.org in a folder named `svn`
SVN_URL="https://plugins.svn.wordpress.org/${PLUGIN_SLUG}/"
SVN_DIR="$HOME/svn-${PLUGIN_SLUG}"
echo "➤ Checking out .org repository..."
svn checkout --depth immediates "$SVN_URL" "$SVN_DIR"

# Switch to SVN directory
cd "$SVN_DIR"

svn update --set-depth infinity trunk
# svn update --set-depth infinity tags/$VERSION

# Copy files from release to `svn/trunk`
echo "➤ Copying files..."
rsync -rc --exclude-from="$GITHUB_WORKSPACE/.distignore" "$GITHUB_WORKSPACE/" trunk/ --delete --delete-excluded 

# Detect and schedule additions and deletions in SVN
svn status | grep '^[!?]' | while IFS= read -r line; do
    status="${line:0:1}"
    file="${line:8}"
    if [ "$status" = "!" ]; then
        svn delete "$file"
    elif [ "$status" = "?" ]; then
        svn add "$file"
    fi
done

# Add everything and commit to SVN
# The force flag ensures we recurse into subdirectories even if they are already added
# Suppress stdout in favor of svn status later for readability
echo "➤ Preparing files..."
svn add --force trunk > /dev/null

# Copy tag locally to make this a single commit
echo "➤ Copying tag..."
svn cp "trunk" "tags/$VERSION"

svn status

# Commit files to wordpress.org.
echo "➤ Committing files..."
svn ci  --message "Release $TAG_NAME" \
        --username $SVN_USERNAME \
        --password $SVN_PASSWORD \
        --non-interactive

echo "✓ Plugin deployed!"