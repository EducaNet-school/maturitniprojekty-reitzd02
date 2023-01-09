<?php
function bubble_sort($arr) {
    $n = count($arr);
    for ($i = 0; $i < $n; $i++) {
      for ($j = 0; $j < $n - $i - 1; $j++) {
        if ($arr[$j] > $arr[$j + 1]) {
          // Swap elements at indices $j and $j + 1
          $temp = $arr[$j];
          $arr[$j] = $arr[$j + 1];
          $arr[$j + 1] = $temp;
        }
      }
    }
    return $arr;
  }
  
  $sorted_array = bubble_sort([5, 3, 8, 2, 1, 4]);
  print_r($sorted_array);
?>