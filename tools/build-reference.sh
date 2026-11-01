#!/usr/bin/env bash

# Rebuilds the generated reference pages from a checkout of the Pedal CMS
# plugin: the PHP API reference (phpdocs/) and the hooks reference
# (userguide/docs/developers/hooks-reference.md), and records the tag they were
# built from in .reference-tag. The plugin checkout is only read.
#
# phpDocumentor runs first. Nothing in this repository is replaced until it
# has succeeded, so a failed build leaves the committed pages untouched.
#
# Usage: tools/build-reference.sh <plugin-dir> [tag]
#   <plugin-dir>  Path of a Pedal CMS checkout (the folder with pedalcms.php).
#   [tag]         Release tag the checkout is at, such as v0.7.0. Defaults to
#                 "main", in which case the version is read from pedalcms.php.
#
# Needs PHP 8.2, and either a phpdoc command or Docker.

set -euo pipefail

PHPDOC_IMAGE="phpdoc/phpdoc:3.10"

if [[ $# -lt 1 || $# -gt 2 ]]; then
	echo "Usage: $0 <plugin-dir> [tag]" >&2
	exit 2
fi

# Resolve the docs repository root from this script's location so it works from anywhere.
DOCS_ROOT="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"

if ! PLUGIN_DIR="$(cd "$1" 2>/dev/null && pwd)" || [[ ! -f "${PLUGIN_DIR}/pedalcms.php" ]]; then
	echo "No pedalcms.php found in '$1'. Pass the path of a Pedal CMS checkout." >&2
	exit 1
fi

TAG="${2:-main}"

if [[ "${TAG}" =~ ^v?[0-9] ]]; then
	VERSION="${TAG#v}"
else
	VERSION="$(sed -n "s/.*define([[:space:]]*'PEDALCMS_VERSION',[[:space:]]*'\([^']*\)'.*/\1/p" "${PLUGIN_DIR}/pedalcms.php" | head -n 1)"
	if [[ -z "${VERSION}" ]]; then
		echo "Unable to read PEDALCMS_VERSION from pedalcms.php." >&2
		exit 1
	fi
fi

# Stage a folder laid out like the plugin, which is what phpdoc.dist.xml expects.
STAGE="${DOCS_ROOT}/.cache/reference-build"
rm -rf "${STAGE}"
mkdir -p "${STAGE}/.phpdoc"
cp "${PLUGIN_DIR}/pedalcms.php" "${STAGE}/"
cp -R "${PLUGIN_DIR}/src" "${STAGE}/src"
cp "${DOCS_ROOT}/tools/phpdoc/phpdoc.dist.xml" "${STAGE}/phpdoc.dist.xml"
sed -i -E "s/(<version number=\")[^\"]*(\")/\1${VERSION}\2/" "${STAGE}/phpdoc.dist.xml"
# phpDocumentor picks up template overrides from .phpdoc/template in the project folder.
cp -R "${DOCS_ROOT}/tools/phpdoc/template" "${STAGE}/.phpdoc/template"

echo "Building the reference for Pedal CMS ${VERSION} (${TAG})..."

if command -v phpdoc >/dev/null 2>&1; then
	(cd "${STAGE}" && phpdoc --config=phpdoc.dist.xml)
elif command -v docker >/dev/null 2>&1; then
	docker run --rm --user "$(id -u):$(id -g)" -v "${STAGE}:/data" "${PHPDOC_IMAGE}" --config=phpdoc.dist.xml
else
	echo "phpDocumentor is not available. Install a phpdoc command, or install Docker to use ${PHPDOC_IMAGE}." >&2
	exit 1
fi

HOOKS_TMP="$(mktemp)"
trap 'rm -f "${HOOKS_TMP}"' EXIT
php "${DOCS_ROOT}/tools/generate-hooks-reference.php" "${PLUGIN_DIR}" "${VERSION}" "${TAG}" > "${HOOKS_TMP}"

# Everything built; now replace the committed output.
mv "${HOOKS_TMP}" "${DOCS_ROOT}/userguide/docs/developers/hooks-reference.md"
chmod 644 "${DOCS_ROOT}/userguide/docs/developers/hooks-reference.md"

rm -rf "${DOCS_ROOT}/phpdocs"
mkdir -p "${DOCS_ROOT}/phpdocs"
cp -R "${STAGE}/.cache/api-docs/." "${DOCS_ROOT}/phpdocs/"

echo "${TAG}" > "${DOCS_ROOT}/.reference-tag"

echo "Done. Updated for Pedal CMS ${VERSION} (${TAG}):"
echo "  phpdocs/"
echo "  userguide/docs/developers/hooks-reference.md"
echo "  .reference-tag"
