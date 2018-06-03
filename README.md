# SilverStripe AMP

AMP HTML⚡ Bundle - provide [AMP HTML](https://www.ampproject.org/) conversion to your SilverStripe website.

## Requirements 

* lullabot/amp ^1.1.3
* silverstripe/framework 4+

## Installation & Usage 

Install with composer 

```
composer require silverstripers/amp dev-master
```

This module adds extensions on for your controllers where the pages will have an AMP based version with a URL suffix 
for each page. 

EG: 

/home/ will have /home/amp.html 
/about-us/ will have /about-us/amp.html

The mobile also provides a template global `$IsAMP` which you can use on any template to add specific HTML segments for the AMP version of the website. 

The module adds cannonical URLs and amphtml links for the sites as well. 

## $IsAMP

In order to determine whether the current request is in AMP or not you can use `$IsAMP` variable.

```
<% if $IsAMP %>
<!-- YOUR AMP CODES HERE -->
<% end_if %>
```

Same way you can use the not as well 

```
<% if not $IsAMP %>
<!-- YOUR NONE AMP CODES HERE -->
<% end_if %>
```

## Reporting Issues

Please [create an issue](https://github.com/SilverStripers/amp/issues) for any bugs, or submit merge requests. 
