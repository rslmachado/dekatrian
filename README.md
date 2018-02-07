# Calendário Dekatrian
![Dekatrian](img/dekatrian.jpg)

## Sobre o Calendário
O **[Calendário Dekatrian](http://dekatrian.com)** é uma proposta criada pelo **[Roberto "Pena" Spinelli](https://twitter.com/Peninha_13)** como uma opção planejada ao caótico [Calendário gregoriano](https://pt.wikipedia.org/wiki/Calend%C3%A1rio_gregoriano), que apesar de diversas modificações e "correções" ainda remete ao [Calendário Romano](https://pt.wikipedia.org/wiki/Calend%C3%A1rio_romano).

Muito se evoluiu desde o Calendário Romano, passamos de adicionar um mês a cada 2 anos (Mercedonius o mês intercalar) para 1 dia a cada 4 anos (29 de Fevereiro dos anos bissextos), mas durante o processo foram sendo acumulandos resquícios históricos que hoje já não fazem sentido, como o mês "Dezembro" que remete a época que os anos possuíam apenas 10 meses e que hoje é o mês 12, ou os meses _Julho_ e _Agosto_ que foram rebatizado em homenagem aos imperadores _Julius Caesar_ e _Augusto_ perdendo seu sentido original, entre outros.  
 Além das nomeclaturas ainda existem as irregularidades dos ciclos, com os meses não tendo a mesma quantidade de dias e semanas não se encaixando dentro dos meses.
 
 Para começar solucinar esses problemas foi proposto o **Dekatrian**, um novo calendário que foi desenvolvido para trazer um pouco de ordem ao caos.
 
___
Para saber mais, acesse o post [Dekatrian – Um calendário minimamente decente](http://www.deviante.com.br/noticias/dekatrian-um-calendario-minimamente-decente/) onde o Pena explica sobre a criação do calendário e para entender o funcionamento dos cliclos veja [Desafios de um calendário: Os ciclos](http://www.deviante.com.br/noticias/desafios-de-um-calendario-os-ciclos/).

Ouça também o [Scicast #106: Tempo](http://www.deviante.com.br/podcasts/scicast/106-tempo/) para saber sobre outras formas de medições de tempo.

>**Não meçam o tempo com uma regua torta.** --_PENA, Roberto. Scicast #106: Tempo (65 min.)_

## Sobre a biblioteca
A proposta é juntar codigos em diversas linguagens para a utilização do calendário.  
Todas oferecem as seguintes possibilidades de formatação.

### Formatando Data
O formato da data permite determinar como a data será exibida. A seqüência de formato é um modelo em que várias partes da data são combinadas (usando os "caracteres de formato") para gerar uma data no formato especificado.

Por exemplo, o formato:  
```j F Y```  
cria uma data como:  
```8 Lunan 2017```

Aqui está o que cada caractere de string de formatação acima representa:  
* ```j``` = Dia do Mês.
* ```F``` = Nome completo do mês.
* ```Y``` = Ano no formato de 4 dígitos.

Aqui está uma tabela dos itens aceitos.

<table>
  <tr>
    <th colspan="3">Dia do Mês</th>
  </tr>
  <tr>
    <td>d</td>
    <td>Numérico, com zeros</td>
    <td>01–31</td>
  </tr>
  <tr>
    <td>j</td>
    <td>Numérico, sem zeros</td>
    <td>1–31</td>
  </tr>
  <tr>
     <th colspan="3"></th>
  </tr>
  <tr>
    <th colspan="3">Mês</th>
  </tr>
  <tr>
    <td>m</td>
    <td>Numérico, com zeros</td>
    <td>01–12</td>
  </tr>
  <tr>
      <td>n</td>
      <td>Numérico, sem zeros</td>
      <td>1–12</td></tr>
      <tr><td>F</td>
      <td>Completo em texto</td>
      <td>Aurorian – Nixian (Anachronian, Sinchronian)</td></tr>
  <tr>
      <td>M</td>
      <td>Três letras</td>
      <td>Aur – Nix</td>
  </tr>
  <tr>
     <th colspan="3"></th>
  </tr>
  <tr>
    <th colspan="3">Ano</th>
  </tr>
  <tr>
      <td>Y</td>
      <td>Numérico, 4 dígitos</td>
      <td>Ex.: 1999, 2003</td>
  </tr>
  <tr>
      <td>y</td>
      <td>Numérico, 2 dígitos</td>
      <td>Ex.: 99, 03</td>
  </tr>
  <tr>
     <th colspan="3"></th>
  </tr>
  <tr>
      <th style="background:#eee" colspan="3">Casos especiais</th>
  </tr>
  <tr>
      <td>G</td>
      <td>Data em formato gregoriano</td>
      <td>Ex.: 26/10/2017</td>
  </tr>
  <tr>
      <td>?</td>
      <td>Exibição condicional em dias "Fora do tempo"<br><small>Ignora um caractere nos dias "Fora do tempo", por exemplo, não exibir o número do dia junto com os nomes <strong>Anachronian</strong> ou <strong>Sinchronian</strong></small></td>
      <td>Ex.: Anachronian 2017</td>
  </tr>
</table>

## Exemplos
Alguns exemplos de formatação de data:
* ```?d F Y``` - Anachronian 2017
* ```j F Y``` - 2 Sinchronian 2016
* ```d\m\Y``` - 02\00\2016
* ```d\m\Y (G)``` - 18\11\2017 (26/10/2017)

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
