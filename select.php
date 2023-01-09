<?php
function selection_sort($arr) {
    for ($i = 0; $i < count($arr); $i++) {
      $min_index = $i;
      for ($j = $i + 1; $j < count($arr); $j++) {
        if ($arr[$j] < $arr[$min_index]) {
          $min_index = $j;
        }
      }
      if ($min_index != $i) {
        list($arr[$i], $arr[$min_index]) = [$arr[$min_index], $arr[$i]];
      }
    }

    return $arr;
  }

  $arr = [3, 2, 1, 5, 4];
  print_r(selection_sort($arr));
?>