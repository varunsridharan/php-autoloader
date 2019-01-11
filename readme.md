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
## Sponsored By
[![DigitalOcean](https://vsp.ams3.cdn.digitaloceanspaces.com/cdn/DO_Logo_Horizontal_Blue-small.png)](https://s.svarun.in/Ef)
[![JetBrains](https://vsp.ams3.cdn.digitaloceanspaces.com/cdn/phpstorm-small.png?v3)](https://www.jetbrains.com)
