
### PHP
```php 
string DekatrianDate([ string $format [, string $gregorian_date [, string $gregorian_format]]] )
``` 
```php
<?php

// Exibe alguma coisa como: 09\02\2018 (07/02/2018)
echo new DekatrianDate('d\m\Y (G)');

// Exibe: 7 Nixian 2019
echo new DekatrianDate('j F Y', '2019-12-10');

$data = new DekatrianDate('d\m\Y', '2020-01-01', 'F, d Y');
// Exibe: 01\00\2020
echo $data; 
// Exibe: 01 Anachronian 2020 - January, 01 2020
echo $data->format('d F Y - G'); 
// Exibe: Anachronian 2020
echo $data->format('?d? F Y'); 

//Inicializa a partir de uma data dekatrian
$data = DekatrianDate::createFromFormat('d\m\Y', '02\01\2018');
// Exibe: 02\01\2018 03/01/2018
echo $data->format('d\m\Y G');
?>
```
