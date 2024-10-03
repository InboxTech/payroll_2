<?php
    function status()
    {
        return $status = array(
            '1' => 'Active',
            '0' => 'Inactive'
        );
    }

    function generateEmployee()
    {
        $result = \App\Models\User::withTrashed()->orderBy('id', 'DESC')->first();

        if ($result && $result->emp_id != NULL) 
        {
            $lastNumber = (int) substr($result->emp_id, 4);

            $newNumber = $lastNumber + 1;

            return 'emp-' . $newNumber;
        }
        else 
        {
            return 'emp-1';
        }
    }

    function getSettingData($key)
    {
        $data = \App\Models\Setting::select('config_value')->where('config_key', $key)->get()->first();

        if(!empty($data->config_value))
        {
            return $data->config_value;
        }
        else
        {
            return '';
        }
    }

    function getImage($image_path)
    {
        if(isset($image_path) && !empty($image_path))
        {
            $image = asset('storage/'.$image_path);
        }
        else
        {
            $image=asset(config('constant.default_image'));
        }

        return $image;
    }

    function formatIndianNumber($number) {
        $numberString = (string)$number;
        
        $wholeNumber = floor($number);
        $decimalPart = substr($numberString, strpos($numberString, '.') + 1);
        
        $formattedWholeNumber = preg_replace('/(\d+?)(?=(\d\d)+(\d)(?!\d))/', '$1,', $wholeNumber);
        
        if ($decimalPart) {
            return $formattedWholeNumber . '.' . $decimalPart;
        }
        
        return $formattedWholeNumber;
    }

    function int_to_words($number)
    {
        $no = round($number);
        $decimal = round($number - ($no = floor($number)), 2) * 100;
        $digits_length = strlen($no);
        $i = 0;
        $str = array();
        $words = array(
            0 => '',
            1 => 'One',
            2 => 'Two',
            3 => 'Three',
            4 => 'Four',
            5 => 'Five',
            6 => 'Six',
            7 => 'Seven',
            8 => 'Eight',
            9 => 'Nine',
            10 => 'Ten',
            11 => 'Eleven',
            12 => 'Twelve',
            13 => 'Thirteen',
            14 => 'Fourteen',
            15 => 'Fifteen',
            16 => 'Sixteen',
            17 => 'Seventeen',
            18 => 'Eighteen',
            19 => 'Nineteen',
            20 => 'Twenty',
            30 => 'Thirty',
            40 => 'Forty',
            50 => 'Fifty',
            60 => 'Sixty',
            70 => 'Seventy',
            80 => 'Eighty',
            90 => 'Ninety');

        $digits = array('', 'Hundred', 'Thousand', 'Lakh', 'Crore');

        while ($i < $digits_length)
        {
            $divider = ($i == 2) ? 10 : 100;
            $number = floor($no % $divider);
            $no = floor($no / $divider);
            $i += $divider == 10 ? 1 : 2;
            if ($number)
            {
                $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
                $str [] = ($number < 21) ? $words[$number] . ' ' . $digits[$counter] . $plural : $words[floor($number / 10) * 10] . ' ' . $words[$number % 10] . ' ' . $digits[$counter] . $plural;
            }
            else
            {
                $str [] = null;
            }
        }

        $Rupees = implode(' ', array_reverse($str));
        $paise = ($decimal) ? " And ".($words[$decimal - $decimal%10]) ." " .($words[$decimal%10]) . " Paise " : '';
        return ($Rupees ?  $Rupees. ' Rupees ' : '') . $paise . " Only";
    }