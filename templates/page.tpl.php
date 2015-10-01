<?php
/**
 * @file
 * Default theme implementation to display a single Drupal page.
 *
 * The doctype, html, head and body tags are not in this template. Instead they
 * can be found in the html.tpl.php template in this directory.
 *
 * Available variables:
 *
 * General utility variables:
 * - $base_path: The base URL path of the Drupal installation. At the very
 *   least, this will always default to /.
 * - $directory: The directory the template is located in, e.g. modules/system
 *   or themes/bartik.
 * - $is_front: TRUE if the current page is the front page.
 * - $logged_in: TRUE if the user is registered and signed in.
 * - $is_admin: TRUE if the user has permission to access administration pages.
 *
 * Site identity:
 * - $front_page: The URL of the front page. Use this instead of $base_path,
 *   when linking to the front page. This includes the language domain or
 *   prefix.
 * - $logo: The path to the logo image, as defined in theme configuration.
 * - $site_name: The name of the site, empty when display has been disabled
 *   in theme settings.
 * - $site_slogan: The slogan of the site, empty when display has been disabled
 *   in theme settings.
 *
 * Navigation:
 * - $main_menu (array): An array containing the Main menu links for the
 *   site, if they have been configured.
 * - $secondary_menu (array): An array containing the Secondary menu links for
 *   the site, if they have been configured.
 * - $breadcrumb: The breadcrumb trail for the current page.
 *
 * Page content (in order of occurrence in the default page.tpl.php):
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title: The page title, for use in the actual HTML content.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 * - $messages: HTML for status and error messages. Should be displayed
 *   prominently.
 * - $tabs (array): Tabs linking to any sub-pages beneath the current page
 *   (e.g., the view and edit tabs when displaying a node).
 * - $action_links (array): Actions local to the page, such as 'Add menu' on the
 *   menu administration interface.
 * - $feed_icons: A string of all feed icons for the current page.
 * - $node: The node object, if there is an automatically-loaded node
 *   associated with the page, and the node ID is the second argument
 *   in the page's path (e.g. node/12345 and node/12345/revisions, but not
 *   comment/reply/12345).
 *
 * Regions:
 * - $page['help']: Dynamic help text, mostly for admin pages.
 * - $page['highlighted']: Items for the highlighted content region.
 * - $page['content']: The main content of the current page.
 * - $page['sidebar_first']: Items for the first sidebar.
 * - $page['sidebar_second']: Items for the second sidebar.
 * - $page['header']: Items for the header region.
 * - $page['footer']: Items for the footer region.
 *
 * @see bootstrap_preprocess_page()
 * @see template_preprocess()
 * @see template_preprocess_page()
 * @see bootstrap_process_page()
 * @see template_process()
 * @see html.tpl.php
 *
 * @ingroup themeable
 */
?>
<nav class="navbar navbar-default navbar-top fast-menu hidden-xs" role="navigation">
    <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                   <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#fast-navigation">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div class="collapse navbar-collapse" id="fast-navigation">
                   <?php print render($page['fast_navigation']); ?>
                </div>
    </div>
</nav>
<header id="banner" role="banner" class="ict-site-header header-bg hidden-xs">
  <div class="container">
   <div class="row">
      <div class="col-xs-1 col-sm-1 col-lg-1 col-md-1 no-padding">
         <?php if ($logo): ?>
              <a class="logo navbar-btn pull-left" href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>">
                <img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>" />
              </a>
          <?php endif; ?>
      </div><!-- Logo -->
      <div class="col-xs-10 col-sm-8 col-lg-8 col-md-8">
        <?php if (!empty($site_name)): ?>
            <h1>
            <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>"><?php print $site_name; ?></a>
            </h1>
            <div class="hidden-xs">
               <?php if (!empty($site_slogan)): ?>
                  <p><?php print $site_slogan; ?></p>
                <?php endif; ?>
                <?php if(!empty($founder)): ?>
                   <p>
                   <?php print $shield; ?>
                   <?php print $founder; ?>
                   </p> 
               <?php endif; ?>
                </div> 
        <?php endif; ?>  
      </div><!-- Site name -->
      <div class="col-xs-3 col-sm-3 col-lg-3 col-md-3 top2em">
          <ul class="social-network social-circle">
                        <!--<li><a href="#" class="icoRss" title="Rss"><i class="fa fa-rss"></i></a></li>-->
                        <li><a href="#" class="icoFacebook" title="Facebook"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#" class="icoTwitter" title="Twitter"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#" class="icoGoogle" title="Google +"><i class="fa fa-google-plus"></i></a></li>
                        <li><a href="#" class="icoYouTube" title="YouTube"><i class="fa fa-youtube"></i></a></li>
           </ul>
      </div><!-- Soc-icons -->
      <div class="col-xs-12 visible-xs padding-founder">
         <?php if(!empty($founder)): ?>
            <div class="col-xs-2 no-padding">
               <?php print $shield; ?>
            </div>
            <div class="col-xs-10 no-padding">
                <?php print $founder; ?>
            </div> 
          <?php endif; ?>       
      </div><!-- Founder -->

      </div><!--#row end -->
  </div>
</header>
<nav class="navbar navbar-default  navbar-static primary-menu" role="navigation">
    <div class="container">
        <div class="navbar-header header-bg">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".js-navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand visible-xs" href="#">
                 <?php if(!empty($small_shield)): ?>
                    <?php print $small_shield; ?>
                 <?php endif; ?>
              </a>
               <p class="navbar-text visible-xs white-text lead"><?php print $title; ?></p>
        </div><!-- dugme za glavni meni -->
        <div class="collapse navbar-collapse js-navbar-collapse" id="bs-example-navbar-collapse-1">
             <?php if (!empty($primary_nav)): ?>
                <?php print render($primary_nav); ?>
             <?php endif; ?>
             <?php if(!empty($search_form)): ?>
                 <?php print $search_form; ?>
             <?php endif;?>
        </div>
    </div>
</nav>
<div class="main-container container">

  <header role="banner" id="page-header">
  

    <?php print render($page['header']); ?>
  </header> <!-- /#page-header -->

  <div class="row">

    <?php if (!empty($page['sidebar_first'])): ?>
      <aside class="col-sm-3" role="complementary">
        <?php print render($page['sidebar_first']); ?>
      </aside>  <!-- /#sidebar-first -->
    <?php endif; ?>

    <section<?php print $content_column_class; ?>>
      <?php if (!empty($page['highlighted'])): ?>
        <div class="highlighted jumbotron"><?php print render($page['highlighted']); ?></div>
      <?php endif; ?>
      <?php if (!empty($breadcrumb)): print $breadcrumb; endif;?>
      <a id="main-content"></a>
      <?php print render($title_prefix); ?>
      <?php if (!empty($title)): ?>
        <h1 class="page-header"><?php print $title; ?></h1>
      <?php endif; ?>
      <?php print render($title_suffix); ?>
      <?php print $messages; ?>
      <?php if (!empty($tabs)): ?>
        <?php print render($tabs); ?>
      <?php endif; ?>
      <?php if (!empty($page['help'])): ?>
        <?php print render($page['help']); ?>
      <?php endif; ?>
      <?php if (!empty($action_links)): ?>
        <ul class="action-links"><?php print render($action_links); ?></ul>
      <?php endif; ?>
      <?php print render($page['content']); ?>
    </section>

    <?php if (!empty($page['sidebar_second'])): ?>
      <aside class="col-sm-3" role="complementary">
        <?php print render($page['sidebar_second']); ?>
      </aside>  <!-- /#sidebar-second -->
    <?php endif; ?>
  </div>
  <?php if($is_front): ?>
   <?php if (!empty($page['page_row_one'])): ?>
      <div class="row">
        <?php print render($page['page_row_one']); ?>
      </div>  <!-- /#page_row_one -->
   <?php endif; ?>
   <?php if (!empty($page['page_row_two'])): ?>
      <div class="row">
        <?php print render($page['page_row_two']); ?>
      </div>  <!-- /#page_row_two -->
   <?php endif; ?>
  <?php endif; ?>
  <?php if (!empty($page['page_banner'])): ?>
      <div class="row">
        <?php print render($page['page_banner']); ?>
      </div>  <!-- /#page_bottom -->
     <?php endif; ?>
</div><!-- #main-container-->

<footer class="footer">
   <div class="container">
      <?php print render($page['footer']); ?>
  </div>
</footer>
<!-- Bottom Navigation START -->
    <nav class="navbar navbar-default navbar-fixed-bottom fast-menu visible-xs" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
               <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bottom-navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <?php print $bn_top_link; ?>
                <?php if(isset($bn_user_link) && !empty($bn_user_link)): ?>
                     <?php print $bn_user_link; ?>
                <?php endif; ?>
                <?php if(isset($bn_logout_link) && !empty($bn_logout_link)): ?>
                     <?php print $bn_logout_link; ?>                     
                <?php endif; ?>
                <?php if(isset($bn_login_link) && !empty($bn_login_link)): ?>
                     <?php print $bn_login_link; ?>
                <?php endif; ?>
                <?php print $bn_english_link; ?>               
                <!--<a class="navbar-brand" href="#top" id ="backToTopBtn">
                    <span class="glyphicon glyphicon-menu-up">&nbsp;</span>
                </a>
                <a class="navbar-brand ulogovan" href="#top">
                    <span class="glyphicon glyphicon-user">&nbsp;</span>
                </a>
                <a class="navbar-brand ulogovan" href="#top">
                    <span class="glyphicon glyphicon-log-out">&nbsp;</span>
                </a>
                <a href="#" data-toggle="modal" data-target="#modalLogin" class="navbar-brand anonimus">
                  <span class="glyphicon glyphicon-log-in">&nbsp;</span>
                </a>
                <a class="navbar-brand visible-xs" href="#">
                 <img src="images/english-site.png" width="24" height="24"/>
                 </a>-->
            </div>
            <div class="collapse navbar-collapse" id="bottom-navbar-collapse">
                   <?php print render($page['fast_navigation']); ?>               
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav><!-- Navigation end -->
<!-- Bottom Navigation END -->
<!-- Modal placeholder START -->
<?php if(isset($login_form) && !empty($login_form)): ?>
    <?php print $login_form; ?>
<?php endif; ?>

<!-- Modal placeholder END -->
