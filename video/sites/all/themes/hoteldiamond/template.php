<?php
/**
 * Override or insert variables into the page template.
 */
function compareWeight($a, $b)
{
    return @strcmp($b['settings']['weight'], @$a['settings']['weight']);
}
/**
 * Override or insert variables into the page template.
 */
function hoteldiamond_preprocess_page(&$variables)
{
    if (isset($vars['main_menu'])) {
        $vars['main_menu'] = theme('links__system_main_menu', array(
            'links' => $vars['main_menu'],
            'attributes' => array(
                'class' => array(
                    'links',
                    'main-menu',
                    'clearfix'
                )
            ),
            'heading' => array(
                'text' => t('Main menu'),
                'level' => 'h2',
                'class' => array(
                    'element-invisible'
                )
            )
        ));
    } else {
        $vars['main_menu'] = FALSE;
    }
    if (isset($vars['secondary_menu'])) {
        $vars['secondary_menu'] = theme('links__system_secondary_menu', array(
            'links' => $vars['secondary_menu'],
            'attributes' => array(
                'class' => array(
                    'links',
                    'secondary-menu',
                    'clearfix'
                )
            ),
            'heading' => array(
                'text' => t('Secondary menu'),
                'level' => 'h2',
                'class' => array(
                    'element-invisible'
                )
            )
        ));
    } else {
        $vars['secondary_menu'] = FALSE;
    }
	
    if (theme_get_setting('slider-show', 'hoteldiamond') == "rev") {
		
		include 'js/rs-plugin/RevolutionSlider.build.inc';
	}
	
}



   
$mapStatus   = theme_get_setting('contact-map-status', 'hoteldiamond');
$mapContent  = theme_get_setting('contact-map', 'hoteldiamond');
$contact_map = '<div id="#contact-map-wrap"><googlemap>' . $mapContent . '</googlemap></div>';

  $mapCode = '   
   $("googlemap").each(function(){                        
    var embed ="<iframe width=\'100%\' height=\'360px\' frameborder=\'0\' scrolling=\'no\'  marginheight=\'0\' marginwidth=\'0\'  src=\'https://maps.google.com/maps?&amp;q="+ encodeURIComponent( $(this).text() ) +"&output=embed&z='.theme_get_setting('contact-map-zoom', 'hoteldiamond').'\'></iframe>";
                                $(this).html(embed);                            
   });   ';
   
   drupal_add_js($mapCode, array('type' => 'inline','scope' => 'footer'));
   
/**
 * Implements hook_html_head_alter().
 * This will overwrite the default meta character type tag with HTML5 version.
 */
function hoteldiamond_html_head_alter(&$head_elements)
{
    $head_elements['system_meta_content_type']['#attributes'] = array(
        'charset' => 'utf-8'
    );
}
/**
 * Remove unused css styles 
 */
function hoteldiamond_css_alter(&$css)
{
    unset($css[drupal_get_path('module', 'aggregator') . '/aggregator.css']);
    unset($css[drupal_get_path('module', 'comment') . '/comment.css']);
    unset($css[drupal_get_path('module', 'field') . '/theme/field.css']);
    unset($css[drupal_get_path('module', 'filter') . '/filter.css']);
    unset($css[drupal_get_path('module', 'forum') . '/forum.css']);
    unset($css[drupal_get_path('module', 'locale') . '/locale.css']);
    unset($css[drupal_get_path('module', 'node') . '/node.css']);
    unset($css[drupal_get_path('module', 'poll') . '/poll.css']);
    unset($css[drupal_get_path('module', 'search') . '/search.css']);
    unset($css[drupal_get_path('module', 'system') . '/system.css']);
    unset($css[drupal_get_path('module', 'system') . '/system.behavior.css']);
    unset($css[drupal_get_path('module', 'user') . '/user.css']);
    unset($css['sites/all/modules/ctools/css/ctools.css']);
    unset($css['sites/all/modules/views/css/views.css']);
    unset($css['sites/all/modules/simplenews/simplenews.css']);
}

function hoteldiamond_form_alter(&$form, &$form_state, $form_id)
{
    if ($form_id == 'search_block_form') {
        $form['search_block_form']['#title']                     = t('Search'); // Change the text on the label element
        $form['search_block_form']['#title_display']             = 'invisible'; // Toggle label visibilty
        $form['search_block_form']['#size']                      = 16; // define size of the textfield
        $form['search_block_form']['#default_value']             = t('Search'); // Set a default value for the textfield
        $form['actions']['submit']['#value']                     = t('GO!'); // Change the text on the submit button
        $form['actions']['submit']                               = array(
            '#type' => 'image_button',
            '#src' => base_path() . path_to_theme() . '/images/search-button.png'
        );
        $form['actions']['submit']['#attributes']['alt']         = t('Search');
        // Add extra attributes to the text box
        $form['search_block_form']['#attributes']['onblur']      = "if (this.value == '') {this.value = '".t("Search")."';}";
        $form['search_block_form']['#attributes']['onfocus']     = "if (this.value == '".t("Search")."') {this.value = '';}";
        // Prevent user from searching the default text
        $form['#attributes']['onsubmit']                         = "if(this.search_block_form.value=='".t("Search")."'){ alert('".t("Please enter a search")."'); return false; }";
        // Alternative (HTML5) placeholder attribute instead of using the javascript
        $form['search_block_form']['#attributes']['placeholder'] = t('Search');
        // Adds a wrapper div to the whole form
    }
    if ($form_id == 'contact_site_form') {
        $contactForm = "<div class='contact-items-wrap'>";
        $contactForm .= "<h4 class='lead'>" . t('Get in touch');
        "</h4>";
        $contactForm .= "<p>" . theme_get_setting('contact-text', 'hoteldiamond') . "</p>";
        $contactForm .= "<h4 class='lead'>" . t('The Office');
        "</h4>";
        $contactForm .= "<ul class='contact-items'>
			<li><i class='icon-location'></i> <strong>" . t('Address: ') . "</strong>" . theme_get_setting('contact-map', 'hoteldiamond') . "</li>
			<li><i class='icon-phone'></i> <strong>" . t('Phone: ') . "</strong>" . theme_get_setting('contact-phone', 'hoteldiamond') . "</li>
			<li><i class='icon-mail'></i> <strong>" . t('Email: ') . "</strong><a href='mailto:" . theme_get_setting('contact-email', 'hoteldiamond') . "'>" . theme_get_setting('contact-email', 'hoteldiamond') . "</a></li>
	
							</ul>";
        $contactForm .= "</div>";
        $form['#prefix'] = $contactForm;
    }
}
function hoteldiamond_menu_item_link($link)
{
    if (empty($link['localized_options'])) {
        $link['localized_options'] = array();
    }
    $link_options         = $link['localized_options'];
    $link_options['html'] = TRUE;
    if ($link['menu_name'] == "primary-links") {
        $link['title'] .= '<span class="description">' . $link['description'] . '</span>';
    }
    return l('<span>' . $link['title'] . '</span>', $link['href'], $link_options);
}
/**
 * Duplicate of theme_menu_local_tasks() but adds clearfix to tabs.
 */
function hoteldiamond_menu_local_tasks(&$variables)
{
    $output = '';
    if (!empty($variables['primary'])) {
        $variables['primary']['#prefix'] = '<h2 class="element-invisible">' . t('Primary tabs') . '</h2>';
        $variables['primary']['#prefix'] .= '<ul class="tabs primary clearfix">';
        $variables['primary']['#suffix'] = '</ul>';
        $output .= drupal_render($variables['primary']);
    }
    if (!empty($variables['secondary'])) {
        $variables['secondary']['#prefix'] = '<h2 class="element-invisible">' . t('Secondary tabs') . '</h2>';
        $variables['secondary']['#prefix'] .= '<ul class="tabs secondary clearfix">';
        $variables['secondary']['#suffix'] = '</ul>';
        $output .= drupal_render($variables['secondary']);
    }
    return $output;
}
/**
 * Override or insert variables into the node template.
 */
function hoteldiamond_preprocess_node(&$variables)
{
    $node = $variables['node'];
    if ($variables['view_mode'] == 'full' && node_is_page($variables['node'])) {
        $variables['classes_array'][] = 'node-full';
    }
    $variables['date']         = format_date($node->created);
    $variables['created_date'] = format_date($node->created, 'custom', 'd M Y');
    $variables['created_date'] = sscanf($variables['created_date'], '%d %s %d');
}
function hoteldiamond_page_alter($page)
{
    // <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
    $viewport = array(
        '#type' => 'html_tag',
        '#tag' => 'meta',
        '#attributes' => array(
            'name' => 'viewport',
            'content' => 'width=device-width, initial-scale=1, maximum-scale=1'
        )
    );
    drupal_add_html_head($viewport, 'viewport');
}
/**
 * Breadcrumb.
 */
function hoteldiamond_breadcrumb($variables)
{
    $breadcrumb  = $variables['breadcrumb'];
    $crumb_arrow = '<span class="crumbs-arrow"> &raquo </span>';
    if (!empty($breadcrumb)) {
        $arr_crumbs = array();
        array_push($arr_crumbs, '<span class="crumbs">' . implode($crumb_arrow, $breadcrumb) . '</span>');
        $output     = '<h2 class="element-invisible">' . t('You are here') . '</h2>';
        $array_size = count($arr_crumbs);
        for ($i = 0; $i < $array_size; $i++) {
            if ($i == $array_size - 1) {
                // Menu link title may override the content title
                (menu_get_active_title()) ? $current_crumb = menu_get_active_title() : $current_crumb = drupal_get_title();
                // If current page is 'Edit Page'
                if (substr(drupal_get_title(), 0, 18) == '<em>Edit Page</em>') {
                    $current_crumb = 'Edit';
                }
                $output .= $arr_crumbs[$i] . '<span class="crumbs-current">' . $crumb_arrow . $current_crumb . '</span>';
                break;
            }
            $output .= $arr_crumbs[$i];
        }
        return '<div class="breadcrumb">' . @$output . '</div>';
    }
}
/**
 * phptemplate_preprocess
 *
 */
function phptemplate_preprocess_node(&$vars)
{
    $vars['template_files'][] = 'node-' . $vars['nid'];
    return $vars;
}
//Show render contact map
if (current_path() == "contact" && $mapStatus == "1") {
    variable_set("RenderContactMap", $contact_map);
} else {
    variable_del("RenderContactMap");
}
/**
 * Theme RTL Mode
 *
 */
//global $language ; $lang_name = $language->language ;
//
//if($lang_name == "ar" || $lang_name == "he"){
//	drupal_add_css(drupal_get_path('theme','hoteldiamond').'/css/style-rtl.css');
//}else{
//	drupal_add_css(drupal_get_path('theme','hoteldiamond').'/css/style-rtl-off.css');
//}
//
$body_font_color               = theme_get_setting('body_font_color', 'hoteldiamond');
$body_font_link_color          = theme_get_setting('body_font_link_color', 'hoteldiamond');
$body_font_link_color_hover    = theme_get_setting('body_font_link_color_hover', 'hoteldiamond');
$heading_font_color            = theme_get_setting('heading_font_color', 'hoteldiamond');
$style_page_title_color        = theme_get_setting('style_page_title_color', 'hoteldiamond');
$style_page_title_bgcolor      = theme_get_setting('style_page_title_bgcolor', 'hoteldiamond');
$style_breadcrumb_font_color   = theme_get_setting('style_breadcrumb_font_color', 'hoteldiamond');
$style_menu_color              = theme_get_setting('style_menu_color', 'hoteldiamond');
$style_menu_color_hover        = theme_get_setting('style_menu_color_hover', 'hoteldiamond');
$style_menu_font               = theme_get_setting('style_menu_font', 'hoteldiamond');
$style_footer_top_border_color = theme_get_setting('style_footer_top_border_color', 'hoteldiamond');
$style_footer_bgcolor          = theme_get_setting('style_footer_bgcolor', 'hoteldiamond');
$style_footer_font_color       = theme_get_setting('style_footer_font_color', 'hoteldiamond');
$style_option                  = "
.badge.light a, .label.light a {color:" . $style_page_title_bgcolor . ";}
a {color:" . $body_font_link_color . "; }
a:hover {color:" . $body_font_link_color_hover . "; }
body {color:" . $body_font_color . ";}
h1, h2, h3, h4, h5, h6, h1 a, h2 a, h3 a, h4 a, h5 a, h6 a {color:" . $heading_font_color . ";}
.page-title, .breadcrumb a:hover, .breadcrumb .crumbs-current {color:" . $style_page_title_color . ";}
.pre-content-overlay{background-color:" . $style_page_title_bgcolor . ";}
.breadcrumb a, .crumbs, .breadcrumb .crumbs-arrow, #breadcrumb .nolink {color:" . $style_breadcrumb_font_color . ";}

#navigation a {color:" . $style_menu_color . ";}
#navigation #main-menu > ul ul li {background-color:" . $style_menu_color . ";}
#navigation #main-menu > ul > li > a.active-trail, #navigation a.active{ background-color: " . $style_menu_color . ";   color:" . $style_menu_font . "; ; }
#navigation #main-menu > ul ul li > a:hover{background-color:" . $style_menu_color_hover . ";}
#navigation #main-menu > ul > li > a.active {color:" . $style_menu_font . ";}
#navigation #main-menu > ul ul a {color:" . $style_menu_font . ";}
#navigation .nolink {color:" . $style_menu_color . ";}
@media only screen and (max-width: 767px) { #navigation {background-color:" . $style_menu_color . ";} #navigation .selector option {background-color:" . $style_menu_color . ";
    -webkit-appearance: none;
    padding: 10px 40px;
    border: none;
    border-bottom:1px solid rgba(0,0,0,0.1);
	color:" . $style_menu_font . ";
  }  
  .contact-items-wrap {float:left; width:100%; margin-right:25px; padding-top:15px;}
  #contact-site-form {float:left; width:100%; }
}
@media only screen and (min-width: 480px) and (max-width: 767px) {#navigation {background-color:" . $style_menu_color . ";} 
.contact-items-wrap {float:left; width:100%; margin-right:25px; padding-top:15px;}
#navigation .selector option {background-color:" . $style_menu_color . ";
    -webkit-appearance: none;
    padding: 10px 40px;
    border: none;
    border-bottom:1px solid rgba(0,0,0,0.1);
	color:" . $style_menu_font . ";
  }
}
#background-footer-overlay {background-color:" . $style_footer_bgcolor . ";}
#footer , #footer  h1,#footer  h2,#footer  h3,#footer  h4,#footer  h5,#footer  h6,#footer  h1 a,#footer  h2 a,#footer  h3 a,#footer  h4 a,#footer  h5 a,#footer  h6 a,#footer a {color:" . $style_footer_font_color . ";}
#footer { border-top: 5px solid " . $style_footer_top_border_color . ";}
";
#navigation #main-menu > ul ul li > a:hover{background-color:#1AA1DA; border-bottom:0px;}
$body_font                     = theme_get_setting('body_font', 'hoteldiamond');
$heading_font                  = theme_get_setting('heading_font', 'hoteldiamond');
$menu_font                     = theme_get_setting('menu_font', 'hoteldiamond');
$body_font_family              = '@import url(http://fonts.googleapis.com/css?family=' . str_replace(' ', '+', $body_font) . ':100,200,300,400,500,600,700&subset=latin,cyrillic,latin-ext,vietnamese,greek,greek-ext,cyrillic-ext);';
$heading_font_family           = '@import url(http://fonts.googleapis.com/css?family=' . str_replace(' ', '+', $heading_font) . ':100,200,300,400,500,600,700&subset=latin,cyrillic,latin-ext,vietnamese,greek,greek-ext,cyrillic-ext);';
$menu_font_family              = '@import url(http://fonts.googleapis.com/css?family=' . str_replace(' ', '+', $menu_font) . ':100,200,300,400,500,600,700&subset=latin,cyrillic,latin-ext,vietnamese,greek,greek-ext,cyrillic-ext);';
$fonts                         = "body {font-family: " . $body_font . "; }
		 .ie9 { font-family: " . $body_font . "; }
		 .ie9 * { font-family: " . $body_font . "; }
		 p, .field input, .form-text, .form-textarea, .field input[type='*'], .field textarea, .field.prepend .adjoined, .field.append .adjoined, .btn, .skiplink,.tabs .tab-nav > li > a, .alert, .ch-info h3, .ch-info p a,  {font-family: " . $body_font . "; }
		 h1, h2, h3, h4, h5, h6 {font-family: " . $heading_font . "; }
		 #navigation {font-family: " . $menu_font . ";}";

    $header_line = " #header_line { background-color: " . theme_get_setting('style_header_top_color', 'hoteldiamond') . ";}";

$layout_background         = theme_get_setting('layout_background', 'hoteldiamond');
$layout_background_color   = theme_get_setting('layout_background_color', 'hoteldiamond');
$layout_background_pattern = theme_get_setting('layout_background_pattern', 'hoteldiamond');
$site_bg_preview_img       = theme_get_setting('site_bg_preview', 'hoteldiamond');
$site_bg_preview           = "";
if (theme_get_setting('layout_mode', 'hoteldiamond') == 'boxed') {
    if ($layout_background == "layout_color") {
        $site_bg_preview = " body {background-color: " . $layout_background_color . ";}";
    }
    if ($layout_background == "layout_pattern") {
		 $site_bg_preview = "body {background-image: url('" . base_path() . drupal_get_path('theme', 'hoteldiamond') . '/images/patterns/' . $layout_background_pattern . ".png'); background-repeat: repeat;}";
    }
 if ($layout_background == "layout_image") {
     $site_bg_preview = "body {
	background: url('/" . substr( base_path(), 1) . substr($site_bg_preview_img, 1) . "') no-repeat center center fixed; 
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
 
		filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src='" . substr($site_bg_preview_img, 1) . "', sizingMethod='scale'); 
		-ms-filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src='" . substr($site_bg_preview_img, 1) . "', sizingMethod='scale');  }";
    }
    $other = ".copyright{background:none !important;} .panelSlider ul:hover li {width: 76px;} .panelSlider ul li:hover {width: 702px;} .panelSlider li {width: 201px;}";
} else {
    $other = ".panelSlider ul:hover li {width: 10%;} .panelSlider ul li:hover {width: 700px;} .panelSlider li {width: 15%;} #header  {margin-top:0px;} ";
}
$sitebarMode = "";
$sidebar     = theme_get_setting('sidebar_mode', 'hoteldiamond');
if ($sidebar == 'left') {
    $sitebarMode = "#sidebar {float:left; margin-left:0px;} #content {float:right; margin-right:0px;}";
}
if ($sidebar == 'right') {
    $sitebarMode = "#sidebar {float:right; margin-right:0px;} #content {float:left; margin-left:0px;}";
}
if ($sidebar == 'fullWidth') {
    $sitebarMode = "#content {float:left; margin-left:0px;}";
}
$style = $fonts;
$style .= $style_option;
$style .= $header_line;
$style .= $site_bg_preview;
$style .= $sitebarMode;
$style .= $other;
variable_set("themestyle", $body_font_family . $heading_font_family . $menu_font_family . $style);