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


# Add everything and commit to SVN
# The force flag ensures we recurse into subdirectories even if they are already added
# Suppress stdout in favor of svn status later for readability
echo "➤ Preparing files..."
svn add --force trunk > /dev/null

# SVN delete all deleted files
# Also suppress stdout here
svn status | grep '^\!' | sed 's/! *//' | xargs -I% svn rm %@ > /dev/null

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