<?php

if (! function_exists('setting')){
    function setting(string $name){
        return \App\Models\Setting::where('name', $name)->first()->value;
    }
}