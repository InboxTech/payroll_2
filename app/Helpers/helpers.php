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
        $result = \App\Models\User::orderBy('id', 'DESC')->first();

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