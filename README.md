# Bach - Your basic command line application

Like his [Minuet in G](http://www.youtube.com/watch?v=on1DDSLdDOo) (incidentally, the first classical piece I learned on the piano), **Bach** is a very simple skeleton for a command line application. It demonstrates:

* how to bootstrap the Joomla Platform;
* how to provide a configuration file for an application;
* how to set up the application source code to the auto-loader specifications; 
* how to identify command line options; and
* how to use a model and its state.

## Overview

<dl>
  <dt>bin/</dt>
  <dd>This folder contains the executatable files.</dd>
  <dt>code/</dt>
  <dd>This folder contains all the custom application code.</dd>
  <dt>config/</dt>
  <dd>This folder contains the configuration file for the application.</dd>
</dl>

Note that within the ``code/`` folder, all the classes are prefixed with "Bach" and then all the classes follow the auto-loader naming convention. The prefix is specified in the last line of the ``code/bootstrap.php`` file:

<pre>// Setup the autoloader for the Bach application classes.
JLoader::registerPrefix('Bach', __DIR__);</pre>

You can search-and-replace the word "Bach" and replace it with your own application name. You can also search-and-replace "{COPYRIGHT}".

This type of architecture could be used to support a single command-line application, or it could be used for many different variants, each with its own executable in ``bin/``, but using a common code library under ``code/``.

## Requirements

* PHP 5.3+

## Installation

This application assumes that you have cloned it, and the Joomla Platform (you need to use [eBay's fork](https://github.com/eBaySF/joomla-platform/tree/mvc) for now because this example uses the new proposed MVC) into a folder called "joomla" under the same parent. For example:

<pre>/parent
../Bach    &lt;-- this repository
../joomla  &lt;-- eBay's platform</pre>

The simplest way to do this is like this:

<pre>mkdir Composers
cd Composers
git clone git://github.com/ebaysf/joomla-platform.git joomla
git clone git://github.com/eddieajau/jc-bach.git Bach</pre>

Such a setup will allow the application to auto-discover the Joomla Platform. Alternatively, you can configure some environment variables so that your applications know where to find the Joomla Platform (probably the way you would do it on the production server).

<pre>JPLATFORM_HOME=/path/to/joomla/platform</pre>

Once you have cloned this repository, you can then push it to one your have created for your own application.

## Running the application

To run the application, navigation to the "/bin" folder and make sure the "run" file is executable. Then run it directly (if on a *nix operating system), or by invoking php like this (you loose the ability to use command line arguments for the script itself doing it this way):

<pre>php -f run</pre>

Consult your operating system requirements for putting the script in your execution path so that you can run it from any folder.

## About the Joomla Composers

The Joomla Composers are a suite of skeleton git repositories that can be used to kick-start your own Joomla Platform Projects. You can clone any of the repositories as a base for building your own application, or cherry-pick what you need.