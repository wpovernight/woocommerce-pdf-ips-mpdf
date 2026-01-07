# Changelog

### v2.8.1

- Fix: Restrict hybrid format to supported document types only

### v2.8.0

- New: Update mPDF to v8.2.7 and add Symfony CssSelector dependency

### v2.7.1

- New: Add filters to customize thumbnail image styles and attributes

### v2.7.0

- New: Update Composer dependencies (mPDF v8.2.6)

### v2.6.0

- New: Add PDF/A-3 support for hybrid e-invoicing formats

### v2.5.8

- New: Upgraded the Github updater to v1.1.4

### v2.5.7

- New: Upgraded the Github updater to v1.1.3

### v2.5.6

- New: Upgraded the Github updater to v1.1.2

### v2.5.5

- New: Upgraded the mPDF library to version v8.2.5.
- New: Moved CJK support to an external extension.
- New: Increased the minimum PHP version requirement to 7.4.
- Fix: Resolved textdomain and translation loading issues.
- Fix: Corrected a style issue with WC item meta when using `dd`.

### v2.5.4

- New: Added GitHub updater (CJK version not supported).

### v2.5.3

- New: Removes templates, support should be given by the core templates
- New: Adds core plugin dependency

### v2.5.2

- New: Bumps mPDF version to 8.2.4
- Fix: Reverts CJK removal

### v2.5.1

- New: Bumps mPDF version to 8.2.3

### v2.5.0

- New: Adds missing document template files for proforma, credit-note, and receipt
- New: Updates the template functions with the recent base plugin changes
- New: Bumps mPDF version to 8.2.2

### v2.4.2

- Fix: Bug on footer not fixed at the bottom on Simple mPDF and RTL templates

### v2.4.1

- Includes document object in PDF maker class and filters
- Uses title & number methods in Invoice templates
- Adds two new filters before and after mPDF write HTML

### v2.4.0

- Fix: HTML modifications in bulk export
- Updated mPDF to 8.0.17

### v2.3.0

- New: Support for invoice notes & the display document notes setting
- New: RTL support setting in General tab
- New: Template wrapper class indicating mPDF & RTL usage
- Fix: Exclude from WooCommerce plugin compatibility checklist
- Fix: Removing `p` tags on item meta
- Fix: Add missing template action hooks

### v2.2.0

- Fix/Feature: Apply header logo height setting
- Fix/Feature: Apply new address visibility settings
- Fix: Thumbnail sizes
- Fix: Premium template footer styles
- Fix: Issues with meta and SKU/weight display
- Tweak: Suppress domdocument warnings by default

### v2.1.2

- Fix: PHP 7.4 compatibility (Updated mPDF to 8.0.6)

### v2.1.1

- Fix: Only enable substitutions if additional fonts included

### v2.1.0

- Feature: Added non-RTL replacement for Simple template
- Feature: Enable character substitutions from backup fonts
- Updated RTL template

### v2.0.0

- Updated mPDF to 8.0
- Removed vendor library from repo
- Fix: Logo height issue
- Fix: Previous errors caught erroneously by mPDF
- Tweak: Filter for mPDF options (`wpo_wcpdf_mpdf_options`)

### v1.0.2

- Log exceptions

### v1.0.1

- Swapped table cell text alignment from left to right

### v1.0.0

- First public release