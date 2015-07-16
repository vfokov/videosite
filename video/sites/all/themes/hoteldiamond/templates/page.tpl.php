<br />
<div id="layout-mode" class="<?php print theme_get_setting('layout_mode', 'hoteldiamond');?> " >
  <div id="header" class="container">
    <div id="header_line" class="container header_line"> 
      <!-- features top -->
      <div class="row">
        <div class="six colmns left"><?php print render($page['topbar_left']); ?></div>
        <div class="six columns right">
          <?php print render($page['topbar_right']); ?>
            <?php if (theme_get_setting('contact-phone-status','hoteldiamond') == "1"): ?>
          <li class="right" style="margin-top: 3px;"><i class='icon-phone'></i> <?php print theme_get_setting('contact-phone','hoteldiamond'); ?></li>
          <?php endif; ?>
          
           <div class="social_icons">
          <ul>
           <?php if (theme_get_setting('facebook_username', 'hoteldiamond')): ?>
            <li class="right" style="margin-top: 3px;"><a href="http://www.facebook.com/<?php echo check_plain(theme_get_setting('facebook_username', 'hoteldiamond')); ?>" target="_blank" rel="me"><img src="<?php print base_path() . drupal_get_path('theme', 'hoteldiamond') . '/images/facebook.png'; ?>" alt="Facebook"/></a></li>
            <?php endif; ?>
            <?php if (theme_get_setting('twitter_username', 'hoteldiamond')): ?>
            <li class="right" style="margin-top: 3px;"><a href="http://www.twitter.com/<?php echo check_plain(theme_get_setting('twitter_username', 'hoteldiamond')); ?>" target="_blank" rel="me"><img src="<?php print base_path() . drupal_get_path('theme', 'hoteldiamond') . '/images/twitter.png'; ?>" alt="Twitter"/></a></li>
            <?php endif; ?>
			<?php if (theme_get_setting('linkedin', 'hoteldiamond')): ?>
            <li class="right"><a href="<?php echo check_plain(theme_get_setting('linkedin', 'hoteldiamond')); ?>" target="_blank" rel="me"><img src="<?php print base_path() . drupal_get_path('theme', 'hoteldiamond') . '/images/linkedin.png'; ?>" alt="linkedin"/></a></li>
            <?php endif; ?>
            <?php if (theme_get_setting('googleplus_username', 'hoteldiamond')): ?>
            <li class="right" style="margin-top: 3px;"><a href="https://plus.google.com/<?php echo check_plain(theme_get_setting('googleplus_username', 'hoteldiamond')); ?>" target="_blank" rel="me"><img src="<?php print base_path() . drupal_get_path('theme', 'hoteldiamond') . '/images/googleplus.png'; ?>" alt="Twitter"/></a></li>
            <?php endif; ?>
            <?php if (theme_get_setting('youtube_username', 'hoteldiamond')): ?>
            <li class="right" style="margin-top: 3px;"><a href="<?php echo check_plain(theme_get_setting('youtube_username', 'hoteldiamond')); ?>" target="_blank" rel="me"><img src="<?php print base_path() . drupal_get_path('theme', 'hoteldiamond') . '/images/youtube.png'; ?>" alt="YouTube"/></a></li>
            <?php endif; ?>
            <?php if (theme_get_setting('rss', 'hoteldiamond')): ?>
            <li class="right" style="margin-top: 3px;"><a href="<?php echo check_plain(theme_get_setting('rss', 'hoteldiamond')); ?>" target="_blank" rel="me"><img src="<?php print base_path() . drupal_get_path('theme', 'hoteldiamond') . '/images/feed.png'; ?>" alt="RSS"/></a></li>
            <?php endif; ?>
            </ul>
            </div>
            
          </div>
      </div>
      <!-- end .features top --> 
    </div>
    <div class="row" id="header">
      <div id="logo" class="four columns logo"> 
        <!-- logo & slogan -->
        <?php if ($logo): ?>
        <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>"><img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>" /></a>
        <?php endif; ?>
        <!-- end. logo & slogan -->
        <?php if ($site_slogan): ?>
        <div class="site_slogan"><?php print $site_slogan; ?></div>
        <?php endif; ?>
      </div>
      
      <div class="eight columns">
      <nav id="navigation" role="navigation">
        <div id="main-menu">
          <?php 
            if (module_exists('i18n_menu')) {
              $main_menu_tree = i18n_menu_translated_tree(variable_get('menu_main_links_source', 'main-menu'));
            } else {
              $main_menu_tree = menu_tree(variable_get('menu_main_links_source', 'main-menu'));
            }
            print drupal_render($main_menu_tree);
          ?>
        </div>
      </nav>
      </div>
      
    </div>
  </div>
  <?php if(drupal_is_front_page()): ?>
  <?php if (theme_get_setting('slider-show', 'hoteldiamond') == "rev"): ?>
  <?php print render($page['revslider']); ?>
  <?php endif; ?>
  <?php if (theme_get_setting('slider-show', 'hoteldiamond') == "pan"): ?>
  <?php print render($page['slider']); ?>
  <?php endif; ?>
  <?php if (theme_get_setting('slider-show', 'hoteldiamond') == "ref"): ?>
  <?php print render($page['slider_r']); ?>
  <?php endif; ?>
  <?php endif; ?>
  <?php print $messages; ?>
  <?php if(!drupal_is_front_page()): ?>
  <div id="pre-content">
    <div class="row"> 
      <!--start breadcrumb -->
      <?php if (theme_get_setting('breadcrumb_title', 'hoteldiamond') == 1): ?>
      <div id="breadcrumb"><?php print $breadcrumb; ?></div>
      <?php endif; ?>
      <!-- end breadcrumb -->
      <?php if ($title): ?>
      <div class="page-title"><?php print $title; ?></div>
      <?php endif; ?>
    </div>
    <div class="pre-content-overlay"></div>
  </div>
  <?php print variable_get("RenderContactMap"); ?>
  <div id="content-wrap" class="row"> <?php print render($title_prefix); ?>
    <?php if (!empty($tabs['#primary'])): ?>
    <div class="tabs-wrapper clearfix"><?php print render($tabs); ?></div>
    <?php endif; ?>
    <?php print render($page['help']); ?>
    <?php if ($action_links): ?>
    <ul class="action-links">
      <?php print render($action_links); ?>
    </ul>
    <?php endif; ?>
    <?php if(theme_get_setting('sidebar_mode', 'hoteldiamond')=="fullWidth"): ?>
    <div id="content" class="twelve columns"><?php print render($page['content']); ?></div>
    <?php else: ?>
    <?php if ($page['sidebar']): ?>
    <div id="content" class="nine columns"> <?php print render($page['content']); ?> </div>
    <div id="sidebar" class="three columns"><?php print render($page['sidebar']); ?></div>
    <?php else: ?>
    <div id="content" class="twelve columns"><?php print render($page['content']); ?></div>
    <?php endif; ?>
    <?php endif; ?>
  </div>
  <?php endif; ?>
  <?php if ($page['content_top']): ?>
  <div id="content-top">
    <div class="row">
      <div><?php print render($page['content_top']); ?></div>
    </div>
  </div>
  <?php endif; ?>
  <?php if ($page['box1'] || $page['box2'] || $page['box3']): ?>
  <div id="boxes">
    <div class="row">
      <div class="six columns"><?php print render($page['box1']); ?></div>
      <div class="three columns"><?php print render($page['box2']); ?></div>
      <div class="three columns"><?php print render($page['box3']); ?></div>
    </div>
  </div>
  
  <?php endif; ?>
  <?php if ($page['content_bottom']): ?>
  <div id="content-bottom">
    <div class="row">
      <div><?php print render($page['content_bottom']); ?></div>
    </div>
  </div>
  <?php endif; ?>
  <?php if ($page['content_bottom_left'] || $page['content_bottom_right']): ?>
  <div id="content-bottom-left-right">
    <div class="row">
      <div class="six columns"><?php print render($page['content_bottom_left']); ?></div>
      <div class="six columns"><?php print render($page['content_bottom_right']); ?></div>
    </div>
  </div>
  <?php endif; ?>
  
  <?php if ($page['prefooter_first']): ?>
  <div id="prefooter-first">
    <div class="row">
      <div id="prefooter-content"><?php print render($page['prefooter_first']); ?></div>
    </div>
  </div>
  <?php endif; ?>
  <?php if ($page['prefooter_second']): ?>
  <div id="prefooter-second">
    <div class="row">
      <div id="prefooter-content"><?php print render($page['prefooter_second']); ?></div>
    </div>
  </div>
  <?php endif; ?>
  <div id="footer">
    <div id="background-footer-overlay">
      <div class="row">
        <div class="twelve columns">
          <?php if ($page['footer_first']): ?>
          <div id="footer_first" class="four columns"><?php print render($page['footer_first']); ?></div>
          <?php endif; ?>
          <?php if ($page['footer_second']): ?>
          <div id="footer_first" class="four columns"><?php print render($page['footer_second']); ?></div>
          <?php endif; ?>
          <?php if ($page['footer_third']): ?>
          <div id="footer_first" class="four columns"><?php print render($page['footer_third']); ?></div>
          <?php endif; ?>
        </div>
      </div>
      <div class="footer-overlay"></div>
    </div>
  </div>
<?php if ($page['copyright']): ?>
<div class="copyright" id="copyright">
<div class="row">
  <div class="twelve columns"> <?php print render($page['copyright']); ?> </div>
</div>
</div>



<?php endif; ?>

</div><br>
