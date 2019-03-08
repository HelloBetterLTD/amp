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

### Configurations 

#### Clearing Caches

To clear the amp caches you need to set up an RSA Key. 

Follow the instructions on the AMP Cache guide on [Generating Keys](https://developers.google.com/amp/cache/update-cache#rsa-keys).

To set up the private key use the following YAML configutation

```
SilverStripers\AMP\Control\AMPCache:
	key_file: 'PATH_TO_YOUR_PRIVATE_KEY'
```

#### Setting up class names

The module allows you to set up class name of pages which are supported by AMPs. 

```
---
Name: amps
---
SilverStripers\AMP\Control\AMPDirector:
  allowed_classes:
    - SilverStripe\Blog\Model\Blog
    - SilverStripe\Blog\Model\BlogPost

```

The configs above limits the amps support to Blog and BlogPost pages.


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
