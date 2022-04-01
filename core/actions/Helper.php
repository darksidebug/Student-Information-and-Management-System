<?php

class Helper{

    public static function OptionSelected($option, $value)
    {
        return $option == $value ? 'selected' : '';
    }
}

?>