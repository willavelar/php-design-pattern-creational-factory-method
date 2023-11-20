## Factory Method

Factory Method is a creational design pattern that provides an interface for creating objects in a superclass, but allows subclasses to alter the type of objects that will be created.

-----

We need to create a log abstraction, which can be changed either to print on the screen or via file.

### The problem

If we do it this way, every time we need to change how logging is done, we will need to change the LogManager class, thus violating SOLID's open/closed concept.

```php
<?php
interface LogWritter
{
    public function write(string $formattedMessage) : void;
}
```
```php
<?php
class StdoutLogWritter implements LogWritter
{
    public function write(string $formattedMessage): void
    {
        fwrite(STDOUT, $formattedMessage);
    }
}
```
```php
<?php
class FileLogWritter implements LogWritter
{
    private $file;
    public function __construct(string $pathFile)
    {
        $this->file = fopen($pathFile, 'a+');
    }

    public function write(string $formattedMessage): void
    {
        fwrite($this->file, $formattedMessage);
    }

    public function __destruct()
    {
        fclose($this->file);
    }
}
```
```php
<?php
class LogManager
{
    public function log(string $severity, string $mesage)
    {
        $logWritter = $this->createLogWritter();

        $today = new \DateTime();
        $formattedMessage = sprintf("[%s][%s]: %s", $today->format('d/m/Y'), $severity, $mesage);

        $logWritter->write($formattedMessage);

    }

    private function createLogWritter() : LogWritter
    {
        return new StdoutLogWritter();
    }
}
```
```php
<?php
$logManager = new LogManager();
$logManager->log('INFO','Testing log manager');
```

### The solution

Now, using the Factory Method pattern, we are able to create classes that will inherit from the FileManager, thus removing the responsibility for changing it, leaving us to just implement it.

```php
<?php
abstract class LogManager
{
    public function log(string $severity, string $mesage)
    {
        $logWritter = $this->createLogWritter();

        $today = new \DateTime();
        $formattedMessage = sprintf("[%s][%s]: %s", $today->format('d/m/Y'), $severity, $mesage);

        $logWritter->write($formattedMessage);

    }

    abstract protected function createLogWritter() : LogWritter;
}
```
```php
<?php
class StdoutLogManager extends LogManager
{
    protected function createLogWritter(): LogWritter
    {
        return new StdoutLogWritter();
    }
}
```
```php
<?php
class FileLogManager extends LogManager
{
    private string $filePath;

    /**
     * @param string $filePath
     */
    public function __construct(string $filePath)
    {
        $this->filePath = $filePath;
    }

    protected function createLogWritter(): LogWritter
    {
        return new FileLogWritter($this->filePath);
    }
}
```
```php
<?php
$logManager = new StdoutLogManager();
$logManager->log('INFO','Testing log manager');

$logManager = new FileLogManager(__DIR__. '/log.log');
$logManager->log('INFO','Testing log manager');
```

-----

### Installation for test

![PHP Version Support](https://img.shields.io/badge/php-7.4%2B-brightgreen.svg?style=flat-square) ![Composer Version Support](https://img.shields.io/badge/composer-2.2.9%2B-brightgreen.svg?style=flat-square)

```bash
composer install
```

```bash
php wrong/test.php
php right/test.php
```