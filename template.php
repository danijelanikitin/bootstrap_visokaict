<?php

/**
 * @file
 * template.php
 */
/*
* Implementation of hook_theme()
*/
function bootstrap_visokaict_theme() {
  return array(
	'contact_site_form' => array(
					'render element' => 'form',
					'template' => 'contact-site-form',
					'path' => drupal_get_path('theme', 'bootstrap_visokaict').'/templates',
					),
     'user_login_block' => array(
        'template' =>  'user-login-block',
        'path'=> drupal_get_path('theme', 'bootstrap_visokaict').'/templates',
        'render element' => 'form'
     ),  
	);
}


/*
* Implementation of preprocess function for the file contact-site-form.tpl.php
*/
function bootstrap_visokaict_preprocess_contact_site_form(&$vars)
{
	//print_r($vars['form']);
    $vars['form']['actions']['submit']['#value']=t('!icon Send message',array('!icon'=>'<span class="glyphicon glyphicon-send">&nbsp;</span>'));
    $vars['contact'] = drupal_render_children($vars['form']);
    $vars['form_title']=t('Send message');
}
 /**
 * Override or insert variables into the maintenance page template.
 */
function bootstrap_visokaict_preprocess_maintenance_page(&$variables){   
    
  $variables['naslov']=t('Сајт се одржава');
  $variables['poruka']=t('Сајт Високе ICT школе се одржава !!!');
  $variables['slika_putanja']="/".path_to_theme()."/images/site_off_line.png";
}
/*
* Override theme_preprocess_page(&$vars)
*/
function bootstrap_visokaict_preprocess_page(&$vars) {
  drupal_add_js('https://maps.googleapis.com/maps/api/js', 'external');
  
   if($vars['is_front']){
    $vars['title'] = ''; 
    $vars['page']['content']['system_main']['default_message'] = array(); 
  }    
    
  $vars['founder']=t('Оснивач школе је Република Србија.');
  $shield_image=array(
                    'path'=>"/".path_to_theme()."/images/grb-srbije.png",
                    'alt'=>t('Оснивач школе је Република Србија.'),
                    'title'=>t('Оснивач школе је Република Србија.'),
                    'attributes'=>array('class'=>'img-responsive osnivac-img')
  );
  $vars['shield']=theme_image($shield_image);   
  $small_shield_image=array(
                    'path'=>"/".path_to_theme()."/images/logo_visoka_ict_skola_mala.png",
                    'alt'=>t('Оснивач школе је Република Србија.'),
                    'title'=>t('Оснивач школе је Република Србија.'),
                    'attributes'=>array('class'=>'img-responsive')
  ); 
  $vars['small_shield']=theme_image($small_shield_image);   
 
  $block = module_invoke('search', 'block_view', 'search');
  $vars['search_form']=render($block); 
  
  $link_bn_top_link_html='<span class="glyphicon glyphicon-menu-up">&nbsp;</span>';
  $link_bn_top_link_attr=array(
                           'attributes'=>array(
                                          'class'=>'navbar-brand',
                                          'id'=>'backToTopBtn'
                           ),
                           'html'=>TRUE,
                           'external' => TRUE
  );
  $vars['bn_top_link']=l($link_bn_top_link_html,'#top',$link_bn_top_link_attr);    
    
  if(!$vars['logged_in']){
      $block = module_invoke('user', 'block_view', 'login');
      $vars['login_form'] = render($block['content']);
      //$vars['login_form'] = drupal_get_form('user_login_block');
      

      
      $link_bn_login_link_html='<span class="glyphicon glyphicon-log-in">&nbsp;</span>';
      $link_bn_login_link_attr=array(
                               'attributes'=>array(
                                              'class'=>'navbar-brand',
                                              'data-toggle'=>'modal',
                                              'data-target'=>'#modalLogin'
                               ),
                               'html'=>TRUE
      );
     $vars['bn_login_link']=l($link_bn_login_link_html,'%23',$link_bn_login_link_attr);
  }else{
      $link_bn_user_link_html='<span class="glyphicon glyphicon-user">&nbsp;</span>';
      $link_bn_user_link_attr=array(
                               'attributes'=>array(
                                              'class'=>'navbar-brand',
                               ),
                               'html'=>TRUE
      );
      $vars['bn_user_link']=l($link_bn_user_link_html,'user',$link_bn_user_link_attr); 
     
      $link_bn_logout_link_html='<span class="glyphicon glyphicon-log-out">&nbsp;</span>';
      $link_bn_logout_link_attr=array(
                               'attributes'=>array(
                                              'class'=>'navbar-brand',
                               ),
                               'html'=>TRUE
      );
     $vars['bn_logout_link']=l($link_bn_logout_link_html,'user/logout',$link_bn_logout_link_attr);
  }
    
    $en_image=array(
                    'path'=>"/".path_to_theme()."/images/english-site.png",
                    'alt'=>'ICT College of Vocational Studies, founded by the Republic of Serbia',
                    'title'=>'ICT College of Vocational Studies, founded by the Republic of Serbia',
                    'attributes'=>array('width'=>'24px','height'=>'24px')
    );
    
      $link_bn_english_link_html=theme_image($en_image);
      $link_bn_english_link_attr=array(
                               'attributes'=>array(
                                                'class'=>'navbar-brand visible-xs'
                               ),
                               'html'=>TRUE
      );
     $vars['bn_english_link']=l($link_bn_english_link_html,'http://en.ict.edu.rs',$link_bn_english_link_attr);
     $vars['content_column_class']=' class="col-xs-12 col-sm-12 col-md-9"';
}
/**
* Overide hook_form_FORM_ID_alter
*/
function bootstrap_visokaict_form_search_block_form_alter(&$form, &$form_state, $form_id){
      $form['#attributes']['class'][]='navbar-form';
      $form['#attributes']['role']='search';
}

/**
 * Override function implementation for bootstrap_search_form_wrapper.
 */
function bootstrap_visokaict_bootstrap_search_form_wrapper($variables) {
  $output = '<div class="input-group">';
  $output .= $variables['element']['#children'];
  $output .= '<span class="input-group-btn">';
  $output .= '<button type="submit" class="btn btn-default">';
  // We can be sure that the font icons exist in CDN.
  if (theme_get_setting('bootstrap_cdn')) {
    $output .= _bootstrap_icon('search');
  }
  else {
    $output .= t('Search');
  }
  $output .= '</button>';
  $output .= '<button type="reset" class="btn btn-btn-primary">';
  $output .= _bootstrap_icon('remove'); 
  $output .= '</button>';    
  $output .= '</span>';    
  $output .= '</div>';
  return $output;
}

/**
 * Override function for the brzi linkovi menu links.
 */
function bootstrap_visokaict_menu_tree__menu_main(&$variables) {
  return '<ul class="nav navbar-nav">' . $variables['tree'] . '</ul>';
}
/**
 * Override function for the brzi linkovi menu links.
 */
function bootstrap_visokaict_menu_tree__sub_main(&$variables) {
  return '<ul>' . $variables['tree'] . '</ul>';
}
/**
 * Override function for the brzi linkovi menu links.
 */
function bootstrap_visokaict_menu_tree__menu_brzi_meni(&$variables) {
  return '<ul class="nav navbar-nav">' . $variables['tree'] . '</ul>';
}

/**
 * Override function for the brzi linkovi menu links.
 */
function bootstrap_visokaict_menu_tree__menu_podsajtovi(&$variables) {
  return '<ul class="nav nav-pills nav-stacked menu-podsajtovi">' . $variables['tree'] . '</ul>';
}

/**
 * Overrides theme_menu_link().
 */
function bootstrap_visokaict_menu_link(array $variables) {
global $user;
  $element = $variables['element'];
  $sub_menu = '';
  $output='';
  $print_link=TRUE;
    
    
  if ($element['#below']) {
    // Prevent dropdown functions from being added to management menu so it
    // does not affect the navbar module.
    if (($element['#original_link']['menu_name'] == 'management') && (module_exists('navbar'))) {
      $sub_menu = drupal_render($element['#below']);
    }
    elseif ((!empty($element['#original_link']['depth'])) && ($element['#original_link']['depth'] == 1) && $element['#original_link']['menu_name'] =='main-menu') {
      // Add our own wrapper
      unset($element['#below']['#theme_wrappers']);
      
      $sub_menu = '<ul class="dropdown-menu">' . drupal_render($element['#below']) . '</ul>';
      // Generate as standard dropdown.
      $element['#title'] .= ' <span class="caret"></span>';
      $element['#attributes']['class'][] = 'dropdown dropdown-large';
      $element['#localized_options']['html'] = TRUE;

      // Set dropdown trigger element to # to prevent inadvertant page loading
      // when a submenu link is clicked.
      $element['#localized_options']['attributes']['data-target'] = '#';
      $element['#localized_options']['attributes']['class'][] = 'dropdown-toggle';
      $element['#localized_options']['attributes']['data-toggle'] = 'dropdown';
    } 
    //SECOND LEVEL START
    elseif ((!empty($element['#original_link']['depth'])) && $element['#original_link']['depth']==2 && $element['#original_link']['menu_name'] =='main-menu') {
      // Add our own wrapper.
      unset($element['#below']['#theme_wrappers']);
      
      $sub_menu = '<ul class="dropdown-menu">' . drupal_render($element['#below']) . '</ul>';
      // Generate as standard dropdown.
      $element['#title'] .= ' <span class="caret"></span>';
      $element['#attributes']['class'][] = 'dropdown';
      $element['#localized_options']['html'] = TRUE;
    
      // Set dropdown trigger element to # to prevent inadvertant page loading
      // when a submenu link is clicked.
      $element['#localized_options']['attributes']['data-target'] = '#';
      $element['#localized_options']['attributes']['class'][] = 'dropdown-toggle';
      $element['#localized_options']['attributes']['data-toggle'] = 'dropdown';
        
    } //SECOND LEVEL END  
  }
  // On primary navigation menu, class 'active' is not set on active menu item.
  // @see https://drupal.org/node/1896674

  if (($element['#href'] == $_GET['q'] || ($element['#href'] == '<front>' && drupal_is_front_page())) && (empty($element['#localized_options']['language'])) && $element['#original_link']['menu_name'] =='menu-podsajtovi') {
    $element['#attributes']['class'][] = 'active';
  }    
  
      $output = l($element['#title'], $element['#href'], $element['#localized_options']); 
  

  if($element['#original_link']['menu_name'] =='menu-brzi-meni' && $element['#href']=='user' && $user->uid==0){

        $element['#title']='<span class="glyphicon glyphicon-log-in"></span>&nbsp;'.t('Login');
        $element['#href']='%23';
        $element['#localized_options']['attributes']['data-toggle'] = 'modal';  
        $element['#localized_options']['attributes']['data-target'] = '#modalLogin'; 
        $element['#localized_options']['html'] = TRUE;
      
    $output = l($element['#title'], $element['#href'], $element['#localized_options']);  
  }
  
  if($element['#original_link']['menu_name'] =='menu-brzi-meni' && $element['#href']=='user' && $user->uid!=0){

        $element['#title']='<span class="glyphicon glyphicon-user"></span>&nbsp;'.$element['#title'];
        $element['#localized_options']['html'] = TRUE;
        $output = l($element['#title'], $element['#href'], $element['#localized_options']);  
  }

  if($element['#original_link']['menu_name'] =='menu-brzi-meni' && $element['#href']=='user/logout' && $user->uid!=0){

        $element['#title']='<span class="glyphicon glyphicon-log-out"></span>&nbsp;'.$element['#title'];
        $element['#localized_options']['html'] = TRUE;
      
        $output = l($element['#title'], $element['#href'], $element['#localized_options']);  
  }      
  
  if($element['#original_link']['menu_name'] =='menu-brzi-meni' && $element['#href']=='http://en.ict.edu.rs' && $user->uid==0){
    
    $en_image=array(
                    'path'=>"/".path_to_theme()."/images/english-site.png",
                    'alt'=>'ICT College of Vocational Studies, founded by the Republic of Serbia',
                    'title'=>'ICT College of Vocational Studies, founded by the Republic of Serbia',
                    'attributes'=>array('width'=>'24px','height'=>'24px')
     );  
      
    $element['#title']=theme_image($en_image);
    $element['#localized_options']['attributes']['target']='_blank';
    $element['#localized_options']['attributes']['title']='ICT College of Vocational Studies, founded by the Republic of Serbia';  
    $element['#localized_options']['html'] = TRUE; 
    $output = l($element['#title'], $element['#href'], $element['#localized_options']);  
  }
  
  if($element['#original_link']['menu_name'] =='menu-brzi-meni' && $element['#href']=='http://en.ict.edu.rs' && $user->uid!=0){
    $print_link=FALSE;
  } 
  
  if($element['#original_link']['menu_name'] =='menu-podsajtovi'){
      if ((!empty($element['#original_link']['depth'])) && ($element['#original_link']['depth'] == 1)){
      // Add our own wrapper.
      unset($element['#below']['#theme_wrappers']);
      $sub_menu = drupal_render($element['#below']);
      // Generate as standard dropdown.
      $element['#title'] .= '';
      $element['#attributes']['class'][] = '';
      $element['#localized_options']['html'] = TRUE;

      // Set dropdown trigger element to # to prevent inadvertant page loading
      // when a submenu link is clicked.
      $element['#localized_options']['attributes']['data-target'] = '#';
      $element['#localized_options']['attributes']['class'][] = '';
      $element['#localized_options']['attributes']['data-toggle'] = '';
      }
     $output = l($element['#title'], $element['#href'], $element['#localized_options']); 
     return '<li' . drupal_attributes($element['#attributes']) . '>' . $output  . "</li>\n". $sub_menu;
  }     

  return $print_link ? '<li' . drupal_attributes($element['#attributes']) . '>' . $output . $sub_menu . "</li>\n":'';
}

/**
 * Override theme_bootstrap_links().
 */
function bootstrap_visokaict_bootstrap_links($variables) {
  $links = $variables['links'];
  $attributes = $variables['attributes'];
  $heading = $variables['heading'];

  global $language_url;
  $output = '';

  if (count($links) > 0) {
    $output = '';
    $output .= '<ul' . drupal_attributes($attributes) . '>';

    // Treat the heading first if it is present to prepend it to the
    // list of links.
    if (!empty($heading)) {
      if (is_string($heading)) {
        // Prepare the array that will be used when the passed heading
        // is a string.
        $heading = array(
          'text' => $heading,
          // Set the default level of the heading.
          'level' => 'li',
        );
      }
      $output .= '<' . $heading['level'];
      if (!empty($heading['class'])) {
        $output .= drupal_attributes(array('class' => $heading['class']));
      }
      $output .= '>' . check_plain($heading['text']) . '</' . $heading['level'] . '>';
    }

    $num_links = count($links);
    $i = 1;

    foreach ($links as $key => $link) {
      $children = array();
      if (isset($link['below'])) {
        $children = $link['below'];
      }
      $attributes = array('class' => array($key));
      // Add first, last and active classes to the list of links.
      if ($i == 1) {
        $attributes['class'][] = 'first';
      }
      if ($i == $num_links) {
        $attributes['class'][] = 'last';
      }
      if (isset($link['href']) && ($link['href'] == $_GET['q'] || ($link['href'] == '<front>' && drupal_is_front_page()))
        && (empty($link['language']) || $link['language']->language == $language_url->language)) {
        $attributes['class'][] = 'active';
      }

      if (count($children) > 0) {
        $attributes['class'][] = 'dropdown';
        $link['attributes']['data-toggle'] = 'dropdown';
        $link['attributes']['class'][] = 'dropdown-toggle';
      }

      if (!isset($link['attributes'])) {
        $link['attributes'] = array();
      }

      $link['attributes'] = array_merge($link['attributes'], $attributes);

      if (count($children) > 0) {
        $link['attributes']['class'][] = 'dropdown';
      }

      $output .= '<li' . drupal_attributes($attributes) . '>';

      if (isset($link['href'])) {
        if (count($children) > 0) {
          $link['html'] = TRUE;
          $link['title'] .= ' <span class="caret"></span>';
          $output .= '<a' . drupal_attributes($link['attributes']) . ' href="#">' . $link['title'] . '</a>';
        }
        else {
          // Pass in $link as $options, they share the same keys.
          $output .= l($link['title'], $link['href'], $link);
        }
      }
      elseif (!empty($link['title'])) {
        // Some links are actually not links, but wrap these with <span> so
        // title and class attributes can be added.
        if (empty($link['html'])) {
          $link['title'] = check_plain($link['title']);
        }
        $span_attributes = '';
        if (isset($link['attributes'])) {
          $span_attributes = drupal_attributes($link['attributes']);
        }
        $output .= '<span' . $span_attributes . '>' . $link['title'] . '</span>';
      }

      $i++;
      if (count($children) > 0) {
        $attributes = array();
        $attributes['class'] = array('dropdown-menu');
        $output .= theme('bootstrap_links', array('links' => $children, 'attributes' => $attributes));
      }
      $output .= "</li>\n";
    }
    $output .= '</ul>';
  }

  return $output;
}


function bootstrap_visokaict_preprocess_user_login_block(&$vars) {
 // $vars['form']['#action']='/front?destination=front';    
  $vars['form']['actions']['submit']['#attributes']=array('class' => array('btn','btn-primary','btn-login'));
  $vars['form']['name']['#attributes']['placeholder']=array('Enter username');
  $vars['form']['pass']['#attributes']['placeholder']=array('Enter password');
  $vars['name'] = render($vars['form']['name']);
  $vars['pass'] = render($vars['form']['pass']);
  $vars['remember_me']= render($vars['form']['remember_me']);   
  $vars['submit'] = render($vars['form']['actions']['submit']);
  $vars['rendered'] = drupal_render_children($vars['form']);
  $vars['btn_close']=t('Close');    
}

/**
 * Override bootstrap_preprocess_block().
 */
function bootstrap_visokaict_preprocess_block(&$variables) {
  // Use a bare template for the page's main content.
  if ($variables['block_html_id'] == 'block-system-main') {
    $variables['theme_hook_suggestions'][] = 'block__no_wrapper';
  }
  $variables['title_attributes_array']['class'][] = 'block-title';
  $variables['is_panel']=FALSE;
  $variables['panel_footer']=FALSE;
  $region=$variables['block']->region;
    
   if($region=='sidebar_second'){
       $variables['is_panel']=TRUE;
       $variables['title_attributes_array']['class'][] ='panel-title';
       $variables['classes_array'][]='panel';
       $variables['classes_array'][]='panel-default';
    }
    if($variables['block_html_id'] =='block-views-view-obavestenja-block'){
       $variables['classes_array'][]='panel-obavestenja';
       $variables['panel_footer']=TRUE;
       $variables['is_panel']=TRUE;    
    $variables['footer_content']='<ul class="nav nav-pills"><li role="presentation"><a class="btn btn-more" target="_blank" href="/studiranje/obavestenja_opsta">'.t('Остала обавештења').'</a></li><li role="presentation"><a href="/rss/obavestenja_opsta/rss.xml" class="btn btn-more btn-rss" title="Rss"><i class="fa fa-rss"></i></a> </li></ul>
';

    }
    if($region=='page_row_one' || $region=='page_row_two'){
        
        if(strpos($variables['block_html_id'],'view-dinamicki')!==false){
             $variables['classes_array'][]='col-xs-12 col-sm-6 col-lg-3 col-md-3 view-dinamicki'; 
        }else{
             $variables['classes_array'][]='col-xs-12 col-sm-6 col-lg-3 col-md-3';
        }
        $variables['classes_array'][]='panel-default';
        $variables['is_panel']=TRUE;
        $variables['title_attributes_array']['class'][] ='panel-title';
        
    }
}

/**
 * Override bootstrap_process_block().
 */
function bootstrap_visokaict_process_block(&$variables) {
  // Drupal 7 should use a $title variable instead of $block->subject.
  $variables['title'] = $variables['block']->subject;
}

function bootstrap_visokaict_preprocess_views_view(&$vars){ 
    if (isset($vars['view']->name)){ 
        $function = 'bootstrap_visokaict_preprocess_views_view__'.$vars['view']->name; 
        if (function_exists($function)){ 
            $function($vars); 
        } 
    } 
}

function bootstrap_visokaict_preprocess_views_view__view_obavestenja(&$vars){ 
    if($vars['display_id'] == 'block'){ 
         //print_r($vars['rows']);
        $tid=25; //taxonomy ID for Obavestenja
        //$term = taxonomy_term_load($tid);
        //$name = $term->name;
        $categories=taxonomy_get_children($tid);
        $links=array(
               26=>array('url'=>'/studiranje/obavestenja_opsta','rss'=>'/rss/obavestenja_opsta/rss.xml'),
               27=>array('url'=>'/studiranje/obavestenja_o_nastavi','rss'=>'/rss/obavestenja_nastava/rss.xml')
        );
        ksort($categories);
        $vars['categories']=$categories;
        $vars['obavestenja_link']='obavestenja-'.$tid.'-';
        $vars['active_element']=26;
        $vars['links']=$links;
    } 
} 
/**
 * Implements hook_preprocess_views_view_unformatted().
 */
function bootstrap_visokaict_preprocess_views_view_unformatted(&$vars) {
    if($vars['view']->name=='view_obavestenja' && $vars['view']->current_display == 'block'){
        //print_r($vars['view']);
        $tids=array_map('trim',explode(',',$vars['title']));
        
        sort($tids);
        $active=in_array(26,$tids) ? 'active':'';
        $vars['id_carousel']=in_array(26,$tids) ? 'carousel-26' : 'carousel-27';
        $title=' <div role="tabpanel" class="tab-pane '.$active.'" id="obavestenja-'.implode('-',$tids).'">';
        $vars['title']=$title;
    
        $keys = array_keys($vars['classes_array']);
        $vars['classes_array'][$keys[0]].=' active';
        $rows=$vars['rows'];
        $num_items=4;
        $vars['rows']=array();
        $new_rows=array_chunk($rows,$num_items,TRUE);
              
        foreach($new_rows as $nr){
            $tmp_keys=array_keys($nr);
            $first_key=$tmp_keys[0];
            $vars['rows'][$first_key]=implode('',$nr);
        }
        
    }
}


/*
* Override of function theme_preprocess_image_style()
*
function bootstrap_visokaict_preprocess_image_style(&$vars) {
    if($vars['style_name'] == 'glavna_vest'){
            $vars['attributes']['class'][] = 'img-responsive';
        }
}
*/
/*
*
function THEME_preprocess_field(&$variables) {
    if($variables['element']['#field_name'] == 'field_photo'){
        foreach($variables['items'] as $key => $item){
            $variables['items'][ $key ]['#item']['attributes']['class'][] = 'img-responsive'; // http://getbootstrap.com/css/#overview-responsive-images
        }
    }
}
*/