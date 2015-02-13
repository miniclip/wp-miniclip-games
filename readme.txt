=== Miniclip Games Arcade ===
Contributors: binarymoon
Tags: games, miniclip, shortcode, embed, arcade
Requires at least: 3.9
Tested up to: 4.1
Stable tag: trunk
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Create your own games arcade using free content from Miniclip.com

== Description ==

The Miniclip Games Arcade WordPress plugin gives you a simple way to make use of the Miniclip Webmaster Games API and embed our content onto your site.

This plugin is great for those who want to get some free interactive content onto their website. Games are a fun way to encourage your site visitors to stick around, and visit again and Miniclip has one of the best games libraries online.

You can get a full list of available game embed shortcodes here: http://www.miniclip.com/webmasters/docs/shortcodes/en/

Currently you can embed games in your blog posts using a couple of shortcodes, and we have a lot of ideas for future additions. Please feel free to [ping us on Twitter](http://twitter.com/miniclip) if you have any feedback or suggestions.

Use of the Miniclip Games plugin is subject to agreeing to the Miniclip webmaster [terms and conditions](http://www.miniclip.com/games/page/en/terms-and-conditions/#webmaster-terms).

== How To ==

After downloading and installing the plugin you can start to embed Miniclip games into your website.

= Game Shortcode Embed =

The most basic usage is with a shortcode. All you need to use this is the game id for the game you would like to embed. The following code will embed the game '8 Ball Pool' on your site.

`[game id="2471"]`

You can get a list of all the available games here: http://www.miniclip.com/webmasters/docs/shortcodes/en/

= Category Shortcode Embed =

Embed the top 5 games from the specified game category on a page. The following example will embed the top 5 action games from Miniclip.com.

`[game-category id="13]`

At the moment the easiest way to find the id for the game categories is to browse to the category you want to embed on http://www.miniclip.com and then look at the number next to the word *genre-* in the url. For example the action category looks like http://www.miniclip.com/games/genre-13/action/en/ - which makes *13* the category id.

== Changelog ==

= 1.2 =
* add a games category widget. Similar to the games category shortcode but you can add it to your sidebar widgets.

= 1.1 =
* cache the data properly which makes the page load much more quickly
* add a new shortcode [game-category] allows you to embed the top 5 webmaster games from the specified category.

= 1.0.3 =
* stop all the games from loading at once when there are multiple games on a page
* more javascript improvements

= 1.0.2 =
* javascript changes

= 1.0.1 =
* ensure jquery is included in the page if it's not being used by the theme already

= 1.0 =
* first version live! :)

== Upgrade Notice ==