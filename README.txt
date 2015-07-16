=== WP Rewords ===
Contributors: yuvalo, 9minds
Donate link: http://wpflow.com/wp-rewords
Tags: title, campaign, replace, replacing
Requires at least: 3.0.1
Tested up to: 4.2.2
Stable tag: 1.0.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Replaces the page title by looking at the URL parameters. Display a relevant tile for your campaign ads.

== Description ==

## What does the plugin do?
The WP Rewords plugin allows you to display a different page or post titles by looking at the url parameters.
All advertising and engagement platforms like Google Adwords, Facebook Ads, Mailchimp allow you to create a custom urls to the same landing page for each campaign or segment so you can track specific performance.

For example, if you have two Google Adwords ads that lead to the same lading page, and you want to make them convert better by changing the title of the page to match the ad:
* Use the url builder tool to create a custom url campaign: https://support.google.com/analytics/answer/1033867

* So if the lading page url is:
http://exmaple.com/landing-page/

* The campaign url may look like this:
http://exmaple.com/landing-page/?utm_source=adwords&utm_medium=cpc&utm_campaign=ad%2012


WP Rewords allows you to take this one step further. You can now replace the title with custom text for each of these campaigns / ads.

## Using the plugin
In the Wordpress admin dashboard, edit the page / post / custom post page such as woocommerce product page - where you want to replace the title text and look for the WP Rewords section.

Simply add a new campaign, name it, specify the title to be displayed, and paste in the campaign id or full url.

Visiting the page without any parameters will display the original title. To test it, visit the special campaign url, you should be able to see the appropriate title.

To learn more visit us @[WPFlow.com](http://wpflow.com/wp-rewords/ "WP Flow")

== Installation ==

1. Upload the `wp-rewords` folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Set up campaigns for each page or post by editing it:

In the Wordpress admin dashboard, edit a page or post where you want to replace the title text and look for the WP Rewords section.

Simply add a campaign, name it, specify the title to be displayed, and paste in the campaign id or full url.

Visiting the page without any parameters will display the original title. If you now visit the special campaign url, you should be able to see the appropriate title.

To learn visit us @[WPFlow.com](http://wpflow.com/wp-rewords/ "WP Flow")

== Screenshots ==

1. Campaign Settings
2. Page with original title
3. Page with custom titles

== Changelog ==

= 1.0.0 =
* Plugin release - rejoice

== Upgrade Notice ==
