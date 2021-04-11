# PHP Autoloader
Lightweight PSR-4 PHP Autoloader Class.

[![Latest Stable Version](https://poser.pugx.org/varunsridharan/php-autoloader/version)](https://packagist.org/packages/varunsridharan/php-autoloader)
[![Total Downloads](https://poser.pugx.org/varunsridharan/php-autoloader/downloads)](https://packagist.org/packages/varunsridharan/php-autoloader)
[![Latest Unstable Version](https://poser.pugx.org/varunsridharan/php-autoloader/v/unstable)](//packagist.org/packages/varunsridharan/php-autoloader)
[![License](https://poser.pugx.org/varunsridharan/php-autoloader/license)](https://packagist.org/packages/varunsridharan/php-autoloader)
[![composer.lock available](https://poser.pugx.org/varunsridharan/php-autoloader/composerlock)](https://packagist.org/packages/varunsridharan/php-autoloader) 


## Installation
The preferred way to install this extension is through [Composer](http://getcomposer.org/download/).

To install **PHP_Autoloader library**, simply:

    $ composer require varunsridharan/php-autoloader

The previous command will only install the necessary files, if you prefer to **download the entire source code** you can use:

    $ composer require varunsridharan/php-autoloader --prefer-source

You can also **clone the complete repository** with Git:

    $ git clone https://github.com/varunsridharan/php-autoloader.git

Or **install it manually**:

[Download autoloader.php](https://raw.githubusercontent.com/varunsridharan/php-autoloader/master/src/autoloader.php):

    $ wget https://raw.githubusercontent.com/varunsridharan/php-autoloader/master/src/autoloader.php


## Usage
### Arguments
* **`$namespace` :** PHP Namspace To Handle Autoload For  
* **`$classmap` :** https://github.com/varunsridharan/php-classmap-generator Generated Classmap File.
* **`$path` :** Full Path to lookup for php files
* **`$options` :** An Array of useful Arguments.
* **`$prepend` :** Option to prepend / append current autoloader with exists autoloaders.

#### `$options` Arguments
```php
  array(
      /**
       * An Array of Class Namespace to Exclude While Checking for current namespace.
       * Eg
       * Main Namespace \Testing\Core
       * Exclude \Testing\Core\Abstracts
       */
      'exclude' => false,
      
      /**
       * Custom Option To Quickly Remap A Class File. 
       * If any class added then it will not search.
       * instead it gets the location from here and loads it.
       * An Array of class and its file location
       */
      'mapping' => array(),
      
      /**
       * Set To True / False.
       */
      'debug'   => false,
  );
```

### Example Folder Stucture
```php
  | - src\
  | -- class1\
  | --- class1.php
  | -- class2\
  | --- class2.php
  | --- class3\
  | ---- class3.php
  | - loader.php
  | - index.php
```
### `loader.php` SourceCode
```php
  $autoloader = new \Varunsridharan\PHP\Autoloader('varun',__DIR__.'/src/',array(
      'mapping' => array(
          'varun\class2\class3\class3' => 'src/class2/class3/class3.php',
      )
  ))
```

### `index.php` SoruceCode
```php
  require __DIR__.'loader.php';
  
  $class1 = new \varun\class1\class1(); // This file is autoloaded based on the namespace 
  $class2 = new \varun\class1\class2(); // This file is autoloaded based on the namespace 
  $class3 = new \varun\class1\class3(); // This file is loaded using the data from remap array
```


---

<!-- START common-footer.mustache  -->
## 📝 Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

[Checkout CHANGELOG.md](https://github.com/varunsridharan/php-autoloader/blob/main/CHANGELOG.md)


## 🤝 Contributing
If you would like to help, please take a look at the list of [issues](https://github.com/varunsridharan/php-autoloader/issues/).


## 📜  License & Conduct
- [**GNU General Public License v3.0**](https://github.com/varunsridharan/php-autoloader/blob/main/LICENSE) © [Varun Sridharan](website)
- [Code of Conduct](https://github.com/varunsridharan/.github/blob/main/CODE_OF_CONDUCT.md)


## 📣 Feedback
- ⭐ This repository if this project helped you! :wink:
- Create An [🔧 Issue](https://github.com/varunsridharan/php-autoloader/issues/) if you need help / found a bug


## 💰 Sponsor
[I][twitter] fell in love with open-source in 2013 and there has been no looking back since! You can read more about me [here][website].
If you, or your company, use any of my projects or like what I’m doing, kindly consider backing me. I'm in this for the long run.

- ☕ How about we get to know each other over coffee? Buy me a cup for just [**$9.99**][buymeacoffee]
- ☕️☕️ How about buying me just 2 cups of coffee each month? You can do that for as little as [**$9.99**][buymeacoffee]
- 🔰         We love bettering open-source projects. Support 1-hour of open-source maintenance for [**$24.99 one-time?**][paypal]
- 🚀         Love open-source tools? Me too! How about supporting one hour of open-source development for just [**$49.99 one-time ?**][paypal]

<!-- Personl Links -->
[paypal]: https://sva.onl/paypal
[buymeacoffee]: https://sva.onl/buymeacoffee
[twitter]: https://sva.onl/twitter/
[website]: https://sva.onl/website/


## Connect & Say 👋
- **Follow** me on [👨‍💻 Github][github] and stay updated on free and open-source software
- **Follow** me on [🐦 Twitter][twitter] to get updates on my latest open source projects
- **Message** me on [📠 Telegram][telegram]
- **Follow** my pet on [Instagram][sofythelabrador] for some _dog-tastic_ updates!

<!-- Personl Links -->
[sofythelabrador]: https://www.instagram.com/sofythelabrador/
[github]: https://sva.onl/github/
[twitter]: https://sva.onl/twitter/
[telegram]: https://sva.onl/telegram/


---

<p align="center">
<i>Built With ♥ By <a href="https://sva.onl/twitter"  target="_blank" rel="noopener noreferrer">Varun Sridharan</a> <a href="https://en.wikipedia.org/wiki/India">
   <img src="https://cdn.svarun.dev/flag-india.jpg" width="20px"/></a> </i> <br/><br/>
   <img src="https://cdn.svarun.dev/codeispoetry.png"/>
</p>

---


<!-- END common-footer.mustache  -->
