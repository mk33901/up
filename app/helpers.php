<?php

function currency($amount, $prefix = 'R&nbsp;')
{
        return $prefix . money_format('%.2n', $amount);
}