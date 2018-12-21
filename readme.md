# PHP Autoloader
Lightweight PSR-4 PHP Autoloader Class. 

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
* **`$basepath` :** Where To Lookup For Files.
* **`$remaps` :** Custom Array of Full Classname And File Path.

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
    'varun\class2\class3\class3' => 'src/class2/class3/class3.php',
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
[![DigitalOcean](https://vsp.ams3.cdn.digitaloceanspaces.com/cdn/DO_Logo_Horizontal_Blue.png)](https://s.svarun.in/Ef)
