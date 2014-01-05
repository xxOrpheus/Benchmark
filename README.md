Benchmark
=========

# A class for creating simple benchmarks.

### Easy usage (>=PHP 5.3.0)
```php
<?php
require 'Benchmark.php';
$benchmark = new Benchmark();

$benchmark->newBenchmark('crypt', function() { crypt('hello world'); }, 1000);
$benchmark->newBenchmark('md5', function() { md5('hello world'); }, 1000);
var_dump($benchmark->results('crypt'));
var_dump($benchmark->results('md5'));
```

### Usage (<PHP 5.3.0)
```php
<?php
require 'Benchmark.php';
$benchmark = new Benchmark();

$benchmark->newBenchmark('crypt');
for($i = 0; $i < 10000; $i++) {
	$benchmark->startIteration('crypt');
	crypt('hello world');
	$benchmark->endIteration('crypt');
}

$benchmark->newBenchmark('md5');
for($i = 0; $i < 10000; $i++) {
  $benchmark->startIteration('md5');
  md5('hello world');
  $benchmark->endIteration('md5');
}

var_dump($benchmark->results('crypt'));
var_dump($benchmark->results('md5'));
```
