FreeMarket
==========

FreeMarket is a Wordpress theme tailored for [MarketPress](http://premium.wpmudev.org/project/e-commerce/) stores.
Its goal is to be a visually minimalistic theme, focused on usability. No complex configurations, just enable and you're good to go.
There are no administration pages added. Instead any available theme options are visible on WordPress's theme customizer.

This theme relies on the theme customizer which was introduced on WordPress 3.4 so do not attempt to install on older versions. 

Features:
---------

* Responsive layout
* Left/Right sidebar layout, using WordPress's built-in theme customizer
* Light/Dark theme variations, using WordPress's built-in theme customizer
* User-Selectable buttons color, using WordPress's built-in theme customizer. The available button colors can be seen [here](http://twitter.github.com/bootstrap/base-css.html#buttons)
* User can select if the products list will be a list or a grid, using WordPress's built-in theme customizer
* Logo uploader, using WordPress's built-in theme customizer

Includes:
---------

* [Twitter Bootstrap](http://twitter.github.com/bootstrap/)
* [Modernizr](http://modernizr.com/)
* [LessPHP](http://leafo.net/lessphp/)

Other notes:
------------

This theme uses lessphp. If you want to change the css of this theme, you should change the `css/less/styles.less` file. 
When something changes in that file, the `css/styles.css` file is re-compiled to reflect the changes.

If you are not familiar with lesscss and want to know more, you can [read all about it's awesomeness here](http://lesscss.org/).
However, if you're not in the mood to learn new things, you can write simple css in there and it will be included in the final css.

Some advanced options can be configured in the `includes/config.php` file.