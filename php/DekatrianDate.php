<?php
class DekatrianDate {
    private $day;
    private $year;
    private $month;
    private $isOutTime;
    private $gregorian_date;
    private $gregorian_format;
    private $format;

    const monthName = ["Aurorian", "Borean", "Coronian", "Driadan", "Electran", "Faian", "Gaian", "Hermetian", "Irisian", "Kaosian", "Lunan", "Maian", "Nixian"];
    const outTimeName = ["Anachronian", "Sinchronian"];

    public function DekatrianDate($format = 'd\m\Y', $gregorian_date = null, $gregorian_format = 'd/m/Y') {
        $date = strtotime(isset($gregorian_date) ? $gregorian_date : date('c'));
        $leapYear = date('L', $date) + 1;

        $this->gregorian_date = date($gregorian_format, $date);
        $this->gregorian_format = $gregorian_format;
        $this->format = $format;

        $dayNumber = date('z', $date);
        $this->year = date('Y', $date);
        $this->month = (int)($dayNumber / 28);
        $this->day = (int)($dayNumber % 28) + 1;

        if($dayNumber < $leapYear)
            $this->month--;
        else
          $this->day -= $leapYear;

        $this->isOutTime = $this->month < 0;
    }

    public function format($format){
        $arr = array();
        $s = isset($format) ? $format : $this->format;

        for ($i = 0; $i < strlen($s); $i++) {
           switch ($s[$i]) {
              case "d":
                 $arr[] = sprintf("%02d", $this->day);
              break;
              case "j":
                 $arr[] = $this->day;
              break;
              case "m":
                 $arr[] = sprintf("%02d", ($this->month+1));
              break;
              case "n":
                 $arr[] = ($this->month+1);
              break;
              case "F":
                 $arr[] = $this->isOutTime ? DekatrianDate::outTimeName[$this->day-1] : DekatrianDate::monthName[$this->month];
              break;
              case "M":
                 $arr[] = substr(($this->isOutTime ? DekatrianDate::outTimeName[$this->day-1] : DekatrianDate::monthName[$this->month]), 0, 3);
              break;
              case "y":
                 $arr[] = substr($this->year, -2);
              break;
              case "Y":
                 $arr[] = $this->year;
              break;
              case "G":
                 $arr[] = $this->gregorian_date;
              break;
              case "?":
                $this->isOutTime ? $i++ : '';
              break;
              default:
                 $arr[] = $s[$i];
           }
        }
        return implode('', $arr);
    }

    public static function createFromFormat($format, $time){
        $arr = array();
        $s = $format;
        $index = 0;
        for ($i = 0; $i < strlen($s); $i++) {
           switch ($s[$i]) {
              case "d":
              case "m":
              case "y":
                $arr[$s[$i]] = substr($time, $index, 2);
                $index +=2;
              break;
              case "Y":
                $arr[$s[$i]] = substr($time, $index, 4);
                $index +=4;
                break;
              default:
                $index++;
           }
        }

        $year = isset($arr['Y']) ? $arr['Y'] : (isset($arr['y']) ? $arr['y'] : date('Y'));
        $day = (isset($arr['d']) ? $arr['d'] : date('d'));
        $month = (isset($arr['m']) ? $arr['m'] : date('m'));
        $dayNumber = $day + ($month * 28);
        
        if($month > 0)
          $dayNumber -= 27 - date('L', mktime(0, 0, 0, 1, 1, $year));
        
        return new DekatrianDate('d\m\Y', date('Y-m-d', mktime(0, 0, 0, 1, $dayNumber, $year)));
    }

    public function __toString(){
        return $this->format($this->format);
    }
}