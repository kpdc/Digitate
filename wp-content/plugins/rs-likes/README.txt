=== Simplicity Likes ===
Contributors: ratkosolaja, simplicitywp
Tags: likes, hearts
Requires at least: 3.0
Tested up to: 4.7.4
Stable tag: 1.1.0
License: GNU General Public License version 3.0
License URI: http://www.gnu.org/licenses/gpl-3.0.html

Adds support for Likes.

== Description ==

**Simplicity Likes** will add a heart to your posts or pages or any other post type, and we'll call them likes. Hearts are more expressive and they enable your users to convey a range of emotions. This plugin is light, fast (ajax powered) and coded with best practice. Every vote is limited by users IP Address AND a Cookie.



**Features:**

* You can choose whether you want this plugin to add a like to the end of your content.
* You can pick on which post types you want to show like button.
* You can choose whether you want to use our minimal styling or not.
* Included Shortcode
* Included Widget for showing your most liked content.

== Installation ==

They are two ways we can go about this: **Using the WordPress Plugin Search** or **Using the WordPress Admin Plugin Upload**.

Using the WordPress Plugin Search:

1. Go to WordPress admin area.
2. Click on Plugins > Add New.
3. In the Search box, type in **Simplicity Likes** and hit enter.
4. Next to the **Simplicity Likes** click on the Install Now button.
5. Click on Activate Plugin.

Using the WordPress Admin Plugin Upload:

1. Download the plugin here from our plugin page.
2. Go to WordPress admin area.
3. Click on Plugins > Add New > Upload Plugin.
4. Click on Choose File and select **rs-likes.zip**
5. Click on Install Now button.
6. Click on Activate Plugin.

== Frequently Asked Questions ==

**Why did the plugin name change?**
This plugin has been bought by a company that I work for, because of that, plugin name changes from RS Likes to Simplicity Likes.

**Will you still support the plugin?**
Yes, I will still support and be in charge of the plugin. Basically, nothing changes except the name.

**How to change like button html?**
I have created a nice filter for developers, and you can change the button to anything you like.
    function like_button( $html ) {
        $html = 'My Nice Icon';

        return $html;
    }
    add_filter( 'rs_likes_html', 'like_button', 10, 1 );

== Screenshots ==

1. screenshot-1.png
2. screenshot-2.png

== Changelog ==

= 1.1.0 =
* Feature: Enable developers to replace icon with their own via custom HTML.
* Feature: Ability to add shortcode outside singular pages.
* Other: Added support for WP 4.7.4

= 1.0.6 =
* Fixed an issue where the shortcode wouldn't show up. I've managed not to update the shortcode function in the previous update. Silly me.

= 1.0.5 =
* Added support for WordPress 4.6.1.
* Fixed a bug when multiple users come from same IP address.
* Plugin has been renamed to Simplicity Likes.

= 1.0.4 =
* Added support for WordPress 4.6

= 1.0.3 =
* Fixed a bug: IP address wasn't being saved properly.

= 1.0.2 =
* Fixed a bug: when a user has bootstrap tooltip enabled on the website, this plugin has a conflict.
* Updated the README for WP 4.5.3

= 1.0.1 =
* You can choose to make the color of the heart be red if there is at least one like.
* Fixed a bug: if you were to click the like button too fast, the counter would go to negative.
* Fixed a bug: if you click on the like button the color of the button would not change to red.

= 1.0.0 =
* Initial Release June 16th, 2016
