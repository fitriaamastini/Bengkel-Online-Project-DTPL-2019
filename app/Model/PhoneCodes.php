<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class PhoneCodes extends Model
{
    public static function getAllPhoneCodes($id = null)
    {
        if (is_null($id)) {
            $phone_codes = DB::select("SELECT country, phone_code FROM phone_codes");
        } else {
            $phone_codes = DB::select("SELECT country, phone_code FROM phone_codes WHERE id = :id ", array(
                'id' => $id
            ));
        }
        
        return $phone_codes;
    }
}
