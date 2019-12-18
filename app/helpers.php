<?php
function getPriceAfterReduce($price, $reduction_level = 0)
{
  return $reduction_level < 100 ? 
    $price * (1 - ($reduction_level / 100)) : 
    $price - $reduction_level;
}