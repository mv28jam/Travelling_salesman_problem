# Travelling_salesman_problem / Задача коммивояжера
Travelling salesman problem TCP 
- greedy closest algorithm
- flat style and real earth
- not optimal way
- circle way

Задача коммивояжера
- решение методом ближайшего
- варианты расчёта для Земли реальной сферической
- вариант расчёта для плоскоземельцев
- не оптимальный путь
- возвращение в исходную точку 

## php 7.1 
- void do not return null
- typization

## Example
```php
//Example of use 
//create
$way= (new TravellProblem)->init();
//set style flat Earth
$way->setCountFlat();
//set points
//Exception here 
$way->setPoints(['k'=>[1,2], [5,10], 't'=>[4,4], [5,16]]);
//count and get result
var_dump($way->go());
/*
array(2) {
  [0] =>
  string(9) "k/t/0/1/k"
  [1] =>
  double(36.762038412088)
}
*/
//other format
var_dump($way->getResultAsIs());
/*
array(2) {
  [0] =>
  array(5) {
    [0] =>
    string(1) "k"
    [1] =>
    string(1) "t"
    [2] =>
    int(0)
    [3] =>
    int(1)
    [4] =>
    string(1) "k"
  }
  [1] =>
  array(4) {
    [0] =>
    double(5.3851648071345)
    [1] =>
    double(10.816653826392)
    [2] =>
    double(6)
    [3] =>
    double(14.560219778561)
  }
}
*/
```
