=== PDF Invoices & Packing Slips for WooCommerce - mPDF ===
Contributors: wpovernight
Donate link: https://wpovernight.com/
Tags: woocommerce, mpdf, pdf, rtl
Requires at least: 4.4
Tested up to: 6.5
Requires PHP: 7.2
Stable tag: 2.5.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Add mPDF engine compatibility to PDF Invoices & Packing Slips for WooCommerce for flexible document creation.

== Description ==

Enhance your PDF Invoices & Packing Slips for WooCommerce with mPDF engine integration, replacing the default engine for improved handling of specific languages, including Arabic and Hebrew. This alternative offers robust support for right-to-left orientation, ensuring seamless document creation for a wider range of linguistic needs.


== Frequently Asked Questions ==

= Something is not working correctly =

Please post a message to our [support forum](https://wordpress.org/support/plugin/woocommerce-pdf-ips-mpdf) and we'll do our best to help resolve your issue!

= How can I contribute to this project? =

This project is hosted on github: https://github.com/wpovernight/woocommerce-pdf-ips-mpdf
If you want to contribute to the code, feel free to submit a PR. You can also open issues on Github, although we encourage you to open a ticket in the support forum here on WordPress.org first if you're not absolutely sure something is a bug.

== Changelog ==

= 2.5.0 =
* New: adds missing document template files for: proforma, credit-note and receipt
* New: updates the template functions with the recent base plugin changes
* New: bumps mPDF version to 8.2.2

= 2.4.2 =
* Fix: bug on footer not fixed in bottom on Simple mPDF and RTL templates

= 2.4.1 =
* Includes document object in PDF maker class and filters
* Use title & number methods in Invoice templates
* Adds two new filters before and after mPDF write HTML

= 2.4.0 =
* Fix: HTML modifications in bulk export
* Updated mpdf to 8.0.17

= 2.3.0 =
* New: Support for invoice notes & the display document notes setting
* New: RTL support setting in General tab
* New: Template wrapper class indicating mpdf & rtl usage
* Fix: Exclude from WooCommerce plugin compatibility checklist
* Fix: Removing p tags on item meta
* Fix: Add missing template action hooks

= 2.2.0 =
* Fix/feature: apply header logo height setting
* Fix/feature: apply new address visibility settings
* Fix: Thumbnail sizes
* Fix: premium template footer styles
* Fix: issues with meta and sku/weight display
* Tweak: suppress domdocument warnings by default

= 2.1.2 =
* Fixed PHP7.4 compatibility (Updated mpdf to 8.0.6)

= 2.1.1 =
* Fix: only enable substitutions if additional fonts included

= 2.1.0 =
* Feature: Added non-RTL replacement for Simple template.
* Feature: Enable character substitutions from backup fonts
* Updated RTL template

= 2.0.0 =
* Updated mpdf to 8.0
* Removed vendor library from repo
* Fix: logo height issue
* Fix: Previous errors caught erroneously by mpdf
* Tweak: filter for mpdf options (wpo_wcpdf_mpdf_options)

= 1.0.2 =
* Log exceptions

= 1.0.1 =
* Swapped table cell text alignment from left to right

= 1.0.0 =
* First public release