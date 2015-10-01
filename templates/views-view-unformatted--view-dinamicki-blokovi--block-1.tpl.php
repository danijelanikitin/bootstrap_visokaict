<?php

/**
 * @file
 * Default simple view template to display a list of rows.
 *
 * @ingroup views_templates
 * view preporucujemo
 */
$i=0;
$j=0;
?>
<div class="carousel-inner container">
<?php foreach ($rows as $id => $row): ?>
 <?php $active= $j==0 ? "active" : ""; ?>
    <div class="item <?php print $active." ";  if ($classes_array[$id]) { print $classes_array[$id];} ?>">
        <?php print $row; ?>
      <?php $j++; ?>
    </div>
<?php endforeach; ?>
</div>
<ol class="carousel-indicators">
<?php foreach ($rows as $id => $row): ?>
<?php $active=($i==0) ? "class='active'":""; ?>	
   <li data-target="#carousel-preporucujemo-generic" data-slide-to="<?php print $i; ?>" <?php print $active;  ?> ></li>
<?php $i++; ?>
<?php endforeach; ?>
</ol>