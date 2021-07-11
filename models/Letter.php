<?php 

class Letter{
    public static function propis($test){
        $delimiter = '/./';
        $coin = ' 00. тыйын';
        if(preg_match($delimiter,$test)){
            $itog = explode('.',$test);
            $test = $itog[0];
            if(array_key_exists(1,$itog)){
                $coin = $itog[1].'0 тыйын';
            }
        }
        $strlen = strlen($test);
            switch($strlen){
                case '1': return self::edinica($test).' сом '.$coin;break;
                case '2': return self::tens($test).' сом '.$coin;break;
                case '3': return self::hundreds($test).' сом '.$coin;break;
                case '4': return self::thousands($test).' сом '.$coin;break;
                case '5': return self::tenThousands($test).' сом '.$coin;break;
                case '6': return self::hundredThousands($test).' сом '.$coin;break;
                case '7': return self::million($test).' сом '.$coin;break;
            }
    }
    public static function edinica($test){
    $number = substr($test,0,1);
    switch($number){
        case '0': return '';break;
        case '1': return 'один';break;
        case '2': return 'два';break;
        case '3': return 'три';break;
        case '4': return 'четыре';break;
        case '5': return 'пять';break;
        case '6': return 'шесть';break;
        case '7': return 'семь';break;
        case '8': return 'восемь';break;
        case '9': return 'девять';break;
    }
}
public static function eleven($numberTens){
    $number = substr($numberTens,0,2);
    switch($number){
        case '00': return '';break; 
        case '10': return 'десять';break; 
        case '11': return 'одинадцать';break; 
        case '12': return 'двенадцать';break; 
        case '13': return 'тринадцать';break; 
        case '14': return 'четырнадцать';break; 
        case '15': return 'пятнадцать';break; 
        case '16': return 'шестнадцать';break; 
        case '17': return 'семнадцать';break; 
        case '18': return 'восемнадцать';break; 
        case '19': return 'девятнадцать';break; 
    }
}


public static function tens($test){
    $number = substr($test,0,1);
    $numberTens = substr($test,0,2);
    $edinica = substr($test,1,1);
    switch($number){
        case '0': return ''.self::edinica($edinica); break;
        case '1': return ''.self::eleven($numberTens); break;
        case '2': return 'двадцать '.self::edinica($edinica); break;
        case '3': return 'тридцать '.self::edinica($edinica); break;
        case '4': return 'сорок '.self::edinica($edinica); break;
        case '5': return 'пятьдесят '.self::edinica($edinica); break;
        case '6': return 'шестьдесят '.self::edinica($edinica); break;
        case '7': return 'семьдесят '.self::edinica($edinica); break;
        case '8': return 'восемьдесят '.self::edinica($edinica); break;
        case '9': return 'девяносто '.self::edinica($edinica); break;
    }
}
public static function hundreds($test){
    $number = substr($test,0,1);
    $numberTens = substr($test,1,2);
    switch($number){
        case '0': return self::tens($numberTens);break;
        case '1': return 'сто '.self::tens($numberTens);break;
        case '2': return 'двести '.self::tens($numberTens);break;
        case '3': return 'триста '.self::tens($numberTens);break;
        case '4': return 'четыреста '.self::tens($numberTens);break;
        case '5': return 'пятьсот '.self::tens($numberTens);break;
        case '6': return 'шестьсот '.self::tens($numberTens);break;
        case '7': return 'семьсот '.self::tens($numberTens);break;
        case '8': return 'восемьсот '.self::tens($numberTens);break;
        case '9': return 'девятьсот '.self::tens($numberTens);break;
    }
}
public static function thousands($test){
    $thousend = substr($test,0,1);
    $hundred = substr($test,1,3);
    switch($thousend){
        case '0': return ' тысяч '.self::hundreds($hundred); break;
        case '1': return 'одна тысяча '.self::hundreds($hundred); break;
        case '2': return 'две тысячи '.self::hundreds($hundred); break;
        case '3': return 'три тысячи '.self::hundreds($hundred); break;
        case '4': return 'четыре тысячи '.self::hundreds($hundred); break;
        case '5': return 'пять тысяч '.self::hundreds($hundred); break;
        case '6': return 'шесть тысяч '.self::hundreds($hundred); break;
        case '7': return 'семь тысяч '.self::hundreds($hundred); break;
        case '8': return 'восемь тысяч '.self::hundreds($hundred); break;
        case '9': return 'девять тысяч '.self::hundreds($hundred); break;
    }
}
public static function tenThousands($test){
    $tenThousands = substr($test,0,1);
    $thousands = substr($test,1,4);
    $hundred = substr($test,2,3);
    switch($tenThousands){
        case '0': return self::thousands($thousands); break;
        case '1': return self::eleven($test).' тысяч '.self::hundreds($hundred); break;
        case '2': return 'двадцать '.self::thousands($thousands); break;
        case '3': return 'тридцать '.self::thousands($thousands); break;
        case '4': return 'сорок '.self::thousands($thousands); break;
        case '5': return 'пятьдесят '.self::thousands($thousands); break;
        case '6': return 'шестьдесят '.self::thousands($thousands); break;
        case '7': return 'семьдесят '.self::thousands($thousands); break;
        case '8': return 'восемьдесят '.self::thousands($thousands); break;
        case '9': return 'девяносто '.self::thousands($thousands); break;
    }
}
public static function hundredThousands($test){
    $hundredThousands = substr($test,0,1);
    $tenThousands = substr($test,1,5);
    switch($hundredThousands){
        case '0': return ''.self::tenThousands($tenThousands);break;
        case '1': return 'сто '.self::tenThousands($tenThousands); break;
        case '2': return 'двести '.self::tenThousands($tenThousands); break;
        case '3': return 'триста '.self::tenThousands($tenThousands); break;
        case '4': return 'четыреста '.self::tenThousands($tenThousands); break;
        case '5': return 'пятьсот '.self::tenThousands($tenThousands); break;
        case '6': return 'шестьсот '.self::tenThousands($tenThousands); break;
        case '7': return 'семьсот '.self::tenThousands($tenThousands); break;
        case '8': return 'восемьсот '.self::tenThousands($tenThousands); break;
        case '9': return 'девятсот '.self::tenThousands($tenThousands); break;
    }
}
public static function million($test){
    $million = substr($test,0,1);
    $checkMillion = substr($test,1,3);
    $hundreds = substr($test,4,3);
    $hundredThousands = substr($test,1,6);
    if($hundredThousands  == 0){
        switch($million){
            case '1': return 'Один миллион';break;
            case '2': return 'Два миллиона';break;
            case '3': return 'Три миллиона';break;
            case '4': return 'Четыре миллиона';break;
            case '5': return 'Пять миллионов';break;
            case '6': return 'Шесть миллионов';break;
            case '7': return 'Семь миллионов';break;
            case '8': return 'Восемь миллионов';break;
            case '9': return 'Девять миллионов';break;
        }
    }elseif($checkMillion == 0){
        switch($million){
            case '1': return 'Один миллион '.self::hundreds($hundreds);break;
            case '2': return 'Два миллиона '.self::hundreds($hundreds);break;
            case '3': return 'Три миллиона '.self::hundreds($hundreds);break;
            case '4': return 'Четыре миллиона '.self::hundreds($hundreds);break;
            case '5': return 'Пять миллионов '.self::hundreds($hundreds);break;
            case '6': return 'Шесть миллионов '.self::hundreds($hundreds);break;
            case '7': return 'Семь миллионов '.self::hundreds($hundreds);break;
            case '8': return 'Восемь миллионов '.self::hundreds($hundreds);break;
            case '9': return 'Девять миллионов '.self::hundreds($hundreds);break;
        }
    } else {
        switch($million){
            case '1': return 'Один миллион '.self::hundredThousands($hundredThousands);break;
            case '2': return 'Два миллиона '.self::hundredThousands($hundredThousands);break;
            case '3': return 'Три миллиона '.self::hundredThousands($hundredThousands);break;
            case '4': return 'Четыре миллиона '.self::hundredThousands($hundredThousands);break;
            case '5': return 'Пять миллионов '.self::hundredThousands($hundredThousands);break;
            case '6': return 'Шесть миллионов '.self::hundredThousands($hundredThousands);break;
            case '7': return 'Семь миллионов '.self::hundredThousands($hundredThousands);break;
            case '8': return 'Восемь миллионов '.hundredThousands($hundredThousands);break;
            case '9': return 'Девять миллионов '.self::hundredThousands($hundredThousands);break;
        }
    }

}
        
}