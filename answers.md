# Invest Forward - API Developer Test

Invest Forward is a holistic financial advice platform that aims to assist 
customers in treating their money as a first class citizen in their lives, 
instead of just a tool to do things. To achieve this, we have many different
connections, and require unique answers to very disparate problems. 

## Section One - Syntax (30 minutes)

1. Explain the difference between the `===` and `==` operands. When would you
use both?

```
=== is a strict compare, the type must match. For example `true === true` would pass `but 1 === '1'` would not pass

== is the "truthy" operator, it is less strict. '1' == 1, true = '1', true = 1 and other madness

```
2. Describe what `continue;` does in the following code sample: 
```php
for ($i = 0; $i < 5; ++$i) {
    if ($i == 2)
    continue;
    print "$i , ";
}
```
```
It does not print $i when $i is equal to 2
```

3. What is the fastest way to traverse over an array: for, foreach, or while? 
Why?
Write a function to benchmark your results.
```
If we're talking pure traversal I suspect that `for` is the fastest, but if we're traversing to use the array elements then I suspect
that `foreach` is the fastest
```

```
<?php
// test #1 pure travesal
$a = [];
$k = 0;
while ($k < 30000000) {
    $a[] = 'some value';
    ++$k;
}
$st = microtime(true);

for ($k = 0; $k < count($a); ++$k) {
}
$et = round(microtime(true) - $st, 2);
echo $et . "\n";



<?php
// test #2 with assignment
$a = [];
$k = 0;
while ($k < 30000000) {
    $a[] = 'some value';
    ++$k;
}
$st = microtime(true);

for ($k = 0; $k < count($a); ++$k) {
    $v = $a[$k];
}
$et = round(microtime(true) - $st, 2);
echo $et . "\n";



<?php
// test #3 foreach assignment
$a = [];
$k = 0;
while ($k < 30000000) {
    $a[] = 'some value';
    ++$k;
}
$st = microtime(true);

foreach ($a as $v) {
}
$et = round(microtime(true) - $st, 2);
echo $et . "\n";



<?php
// test #4 while assignment
$a = [];
$k = 0;
while ($k < 30000000) {
    $a[] = 'some value';
    ++$k;
}
$st = microtime(true);
$k = 0;
$c = count($a);
while ($k < $c) {
    $v = $a[$k];
    ++$k;
}
$et = round(microtime(true) - $st, 2);
echo $et . "\n";

```
4. Given the array: `[13, 24, 91, 120, 41, 76, 91, 46, 71, 101, 259, 12, 41, 28, 73, 33, 58]`, 
using Laravel collections, return an array that contains the following keys and their 
corresponding values: `'mean', 'median', 'mode', 'standardDeviation'`.

```
$return = [];

$collection = collect([13, 24, 91, 120, 41, 76, 91, 46, 71, 101, 259, 12, 41, 28, 73, 33, 58,1]);

$collection = collect([13, 24, 91, 120, 41, 76, 91, 46, 71, 101, 259, 12, 41, 28, 73, 33, 58]);
$collection = collect([13, 24, 13, 91, 5, 120, 41, 76]);

//$collection = collect([13, 4, 91,]);


$sorted = $collection->toArray();
sort($sorted, SORT_NUMERIC);


if (count($sorted) % 2 === 0) {
    $k = count($sorted) / 2;
    $median = ($sorted[$k-1] + $sorted[$k])/2;
} else {
    $key = floor(count($sorted)/2);
    $median = $sorted[$key];
}


if (count($sorted) == 3) {
    $median = $sorted[1];
}
if (count($sorted) == 2) {
    $median = $collection->avg();
}
if (count($sorted) == 1) {
    $median = $sorted[0];
}
if (count($sorted) < 0) {
    $median = null;
}

$values = array_count_values($sorted);
arsort($values);
$modes  = array_keys($values, current($values), true);

if (count($values) === count($sorted)) {
    $mode = null;
} else if (count($modes) === 1) {
    $mode = $modes[0];
} else {
    $mode = $modes;
}

$return['sorted'] = $sorted;
$return['avg'] = $collection->avg();
$return['median'] = $median;
$return['mode'] = $mode;
$return['sd']= sd($sorted);

function sd($x)
{
    $summation = 0;
    $values = 0;
    $ex2 = 0;
    foreach ($x as $value) {
        if (is_numeric($value)) {
            $summation = $summation + $value;
            $values++;
        }
    }
    $mean = $summation / $values;
    foreach ($x as $value) {
        if (is_numeric($value)) {
            $ex2 = $ex2 + ($value * $value);
        }
    }
    $rawsd = ($ex2 / $values) - ($mean * $mean);
    $sd = sqrt($rawsd);
    return $sd;
    
}
    
print_r($return);


```
## Section Two - Code (Up to 4 hours)

5. Using Laravel, design a restful API that allows a customer to create, edit, 
delete and display notes. Notes should be able to be tagged also. Make sure to
account for security and authentication. All routes must be testable also.
Bonus: write a simple documentation page for the public endpoints.

### Notes and afterthoughts

Any questions you have, please send an email to [me.](mailto:testhelp@investforward.com)