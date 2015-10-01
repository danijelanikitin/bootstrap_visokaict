<?php

/**
 * @file
 * Default theme implementation to display a single Drupal page while offline.
 *
 * All the available variables are mirrored in html.tpl.php and page.tpl.php.
 * Some may be blank but they are provided for consistency.
 *
 * @see template_preprocess()
 * @see template_preprocess_maintenance_page()
 *
 * @ingroup themeable
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php print $language->language ?>" lang="<?php print $language->language ?>" dir="<?php print $language->dir ?>">

<head>
  <title><?php print $head_title; ?></title>
  <?php print $head; ?>
  <?php print $styles; ?>
  <?php print $scripts; ?>
</head>
<body class="<?php print $classes; ?>">
  <header id="navbar" role="banner" class="navbar navbar-static-top navbar-default">
  <div class="container">
    <div class="navbar-header">
	  <div id="logo" class="pull-left">
      <?php if ($logo): ?>
      <a class="logo navbar-btn" href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>">
        <img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>" class="image-responsive" />
      </a>
      <?php endif; ?>
       </div>
	<div id="name-slogan">	
      <?php if (!empty($site_name)): ?>
	  	
      <a class="name navbar-brand" href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>"><?php print $site_name; ?></a>
      <?php endif; ?>
      <?php if (!empty($site_slogan)): ?>
      <p class="lead"><?php print $site_slogan; ?></p>
    <?php endif; ?>
     </div>
      <!-- .btn-navbar is used as the toggle for collapsed navbar content -->
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>

  </div>
</header>
<!-- Main navigation START -->
<?php if (!empty($primary_nav)): ?>
<div class="main-navigation container">
   <div class="navbar-collapse collapse">
        <nav role="navigation">
            <?php print render($primary_nav); ?>
        </nav>
      </div>
</div>
<!-- Main navigation END -->
<?php endif; ?>
<div class="main-container container">
  <header role="banner" id="page-header">
    <?php print render($page['header']); ?>
  </header> <!-- /#page-header -->

  <div class="row">

    <section class="col-sm-12">
      
		<div class="highlighted jumbotron">
			<h1><?php print $naslov; ?></h1>
				<div class="media">
                 <a class="pull-left" href="#">
                 <img class="media-object" src="<?php print $slika_putanja; ?>"/>
                 </a>
				  <div class="media-body">
					<?php print $content; ?>
				  </div>
				</div> 
		<p>&nbsp;</p>
		 <p class="pull-right"><a class="btn btn-danger" role="button"><?php print $poruka; ?></a></p>	
			<p>&nbsp;</p>
		</div>
			
    </section>

  </div>
</div>
<footer class="footer">
	<div class="container">
		<div class="region region-footer">
    <section id="block-block-1" class="block block-block contextual-links-region clearfix">
  <p>Средња техничка ПТТ школа, Здравка Челара 16, Београд</p>

</section> <!-- /.block -->
  </div>
    </div>
</footer>

</body>
</html>
