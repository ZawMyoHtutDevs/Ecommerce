<?php

use App\Models\Currency;

function currency(){
    $categories_data = Currency::where('status', '=', '1')->first();
    return($categories_data);
}