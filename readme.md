=== RF Frequency to Wavelength Calculator ===
Contributors: David McHale, John Shedd
Tags: rf, calculator, frequency, wavelength, radio
Requires at least: 5.0
Tested up to: 6.4
Requires PHP: 7.4
Stable tag: 1.0.4
License: MPLv2 or later
License URI: https://www.mozilla.org/en-US/MPL/2.0/

A professional RF calculator that converts frequencies to wavelengths using the speed of light.

== Description ==

The RF Frequency to Wavelength Calculator plugin provides a professional calculator tool that helps determine the wavelength of electromagnetic waves based on their frequency. This is essential for RF engineers, ham radio operators, and anyone working with wireless communications.

**Features:**

* Convert frequencies in Hz, kHz, MHz, and GHz to wavelengths in meters
* Real-time AJAX calculations for smooth user experience
* Mobile-responsive design
* Educational content with wave diagram and formula explanation
* Professional styling that matches modern web standards
* Shortcode support for easy embedding

**Usage:**

Simply add the shortcode `[rf_calculator]` to any post or page where you want the calculator to appear.

You can also customize the title:
`[rf_calculator title="Your Custom Title"]`

**Technical Details:**

* Uses the exact speed of light value: 299,792,458 m/s
* Formula: λ = c / f (wavelength = speed of light / frequency)
* Results displayed with 6 decimal place precision
* Secure AJAX implementation with nonce verification

== Installation ==

1. Upload the plugin files to the `/wp-content/plugins/rf-calculator-plugin` directory, or install the plugin through the WordPress plugins screen directly.
2. Activate the plugin through the 'Plugins' screen in WordPress.
3. Use the shortcode `[rf_calculator]` in your posts or pages.

== Frequently Asked Questions ==

= How do I add the calculator to my page? =

Simply add the shortcode `[rf_calculator]` to any post or page where you want the calculator to appear.

= Can I customize the calculator title? =

Yes! Use `[rf_calculator title="Your Custom Title"]` to set a custom title.

= What frequency units are supported? =

The calculator supports Hz, kHz, MHz, and GHz input units.

= What is the output unit? =

Wavelength is always calculated and displayed in meters.

= Is the calculation accurate? =

Yes, the calculator uses the exact speed of light value (299,792,458 m/s) as defined by international standards.

== Screenshots ==

1. The RF calculator interface showing frequency input and unit selection
2. Results display with wavelength calculation
3. Formula explanation section with wave diagram

== Changelog ==

= 1.0.4 = 
* Updating CSS styling to make type selection better contained

= 1.0.3 = 
* Updating CSS styling to make inputs more visible

= 1.0.2 = 
* Updated to work with WordPress 6.7.2
* Added additional license information

= 1.0.0 =
* Initial release
* Frequency to wavelength conversion
* Support for Hz, kHz, MHz, GHz units
* AJAX-powered calculations
* Mobile responsive design
* Educational content and formula explanation

== Upgrade Notice ==

= 1.0.0 =
Initial release of the RF Frequency to Wavelength Calculator plugin.