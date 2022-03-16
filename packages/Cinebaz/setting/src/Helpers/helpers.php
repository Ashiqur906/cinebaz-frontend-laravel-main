<?php

use App\Models\Category;
use App\Models\Genre;
use App\Models\Setting;
use Harimayco\Menu\Facades\Menu;
use App\Models\OrderDetails;

if (!function_exists('cz_setting')) {
    function cz_setting($key)
    {
        $data = Setting::where(['key' => $key])->get()->first();
        if ($data) {

            if ($data->type == 'image') {

                return asset($data->value);
            } else {
                return $data->value;
            }
        }
 
        return '';
    }
}
if (!function_exists('cz_allsetting')) {
    function cz_allsetting()
    {
        $data = cache()->remember('my-setting', 60 * 60 * 1, function () {
            return Setting::get();
        });
        $array = [];
        if ($data->count() > 0) {
            foreach ($data as $key => $valu) {
                $array[$valu->key] = $valu->value;
            }
        }
        return $array;
    }
}
