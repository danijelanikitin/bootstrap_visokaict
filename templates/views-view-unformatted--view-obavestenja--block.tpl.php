<?php

/**
 * @file
 * Default simple view template to display a list of rows.
 *
 * @ingroup views_templates
 */

?>
<?php if (!empty($title)): ?>
   <?php print $title; ?>
<?php endif; ?>
<div id="block-<?php print $id_carousel; ?>" class="carousel slide" data-ride="carousel">
<div class="carousel-inner" role="listbox">
<?php foreach ($rows as $id => $row): ?>
  <div<?php if ($classes_array[$id]) { print ' class="' . $classes_array[$id] .'"';  } ?>>
    <?php print $row; ?>
  </div>    
<?php endforeach; ?>
    </div>
    </div>
<?php if (!empty($title)): ?>
  </div>
<?php endif; ?>
