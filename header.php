<?php
/**
 * The template for displaying the header
 *
 * @package Standard
 * @since 	3.0
 * @version	3.0
 */
?>
<!DOCTYPE html>
<!--[if IE 8 ]><html id="ie8" <?php language_attributes(); ?>><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html <?php language_attributes(); ?>><!--<![endif]-->
	<head>	
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width">
		
		<link rel="profile" href="http://gmpg.org/xfn/11" />
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
		<title><?php wp_title( '' ); ?></title>
		<?php $presentation_options = get_option( 'standard_theme_presentation_options'); ?>
		<?php if( '' != $presentation_options['fav_icon'] ) { ?>
			<link rel="shortcut icon" href="<?php echo $presentation_options['fav_icon']; ?>" />
			<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo $presentation_options['fav_icon']; ?>" />
		<?php } // end if ?>
		<?php global $post; ?>
		<?php if( standard_using_native_seo() && ( ( is_single() || is_page() ) && ( 0 != strlen( trim( ( $google_plus = get_user_meta( $post->post_author, 'google_plus', true ) ) ) ) ) ) ) { ?>
			<?php if( false != standard_is_gplusto_url( $google_plus ) ) { ?>
				<?php $google_plus = standard_get_google_plus_from_gplus( $google_plus ); ?>
			<?php } // end if ?>
			<link rel="author" href="<?php echo trailingslashit( $google_plus ); ?>"/>
		<?php } // end if ?>
		<?php $global_options = get_option( 'standard_theme_global_options' ); ?>
		<?php if( '' != $global_options['google_analytics'] ) { ?>
			<?php if( is_user_logged_in() ) { ?>
				<!-- Google Analytics is restricted only to users who are not logged in. -->
			<?php } else { ?>
				<script type="text/javascript">
					var _gaq = _gaq || [];
					_gaq.push(['_setAccount', '<?php echo $global_options[ 'google_analytics' ] ?>']);
					_gaq.push(['_trackPageview']);
					_gaq.push(['_trackPageLoadTime']);

					<?php if( 0 != strlen( $global_options[ 'google_analytics_domain'] ) ) { ?>
						_gaq.push(['_setDomainName', '<?php echo $global_options[ 'google_analytics_domain' ] ?>']);
					<?php } // end if/else ?>
					
					<?php if( 1 == $global_options[ 'google_analytics_linker'] ) { ?>
						_gaq.push(['_setAllowLinker', true]);
					<?php } // end if/else ?>
					
					(function() {
						var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
						ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
						var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
					})();
				</script>
			<?php } // end if/else ?>
		<?php } // end if ?>
		<?php if( standard_google_custom_search_is_active() ) { ?>
			<?php $gcse = get_option( 'widget_standard-google-custom-search' ); ?>
			<?php $gcse = array_shift( array_values ( $gcse ) ); ?>
			<script type="text/javascript">
			  (function() {
			    var cx = '<?php echo trim( $gcse['gcse_content'] ); ?>';
			    var gcse = document.createElement('script'); gcse.type = 'text/javascript'; gcse.async = true;
			    gcse.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') +
			        '//www.google.com/cse/cse.js?cx=' + cx;
			    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(gcse, s);
			  })();
			</script>
		<?php } // end if ?>
		<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?>>

		<?php if( standard_is_offline() && ! current_user_can( 'manage_options' ) ) { ?>
			<?php get_template_part( 'page', 'offline-mode' ); ?>
			<?php exit; ?>
		<?php } // end if ?>
		
		<?php get_template_part( 'lib/breadcrumbs/standard_breadcrumbs' ); ?>
		
		<?php if( has_nav_menu( 'menu_above_logo' ) ) { ?>
			<div id="menu-above-header" class="menu-navigation navbar navbar-inverse navbar-fixed-top">
				<div class="navbar-inner ">
					<div class="container">
		
						<a class="btn btn-navbar" data-toggle="collapse" data-target=".above-header-nav-collapse">
						  <span class="icon-bar"></span>
						  <span class="icon-bar"></span>
						  <span class="icon-bar"></span>
						</a>
					
						<div class="nav-collapse above-header-nav-collapse pull-right">
							<?php
								wp_nav_menu( 
									array(
										'container_class'	=> 'menu-header-container',
										'theme_location'  	=> 'menu_above_logo',
										'items_wrap'      	=> '<ul id="%1$s" class="nav nav-menu %2$s">%3$s</ul>',
										'fallback_cb'	  	=> null,
										'walker'			=> new Standard_Nav_Walker()
								 	)
								 );
							?>

						</div><!-- /.nav-collapse -->

					</div> <!-- /container -->
				</div><!-- /navbar-inner -->
			</div> <!-- /#menu-above-header -->	
		<?php } // end if ?>
			
        <div class="container">
            <div id="primary-nav" class="row">

                <div class="span2">
                    <a href="#">Event Geeks</a>
                </div> <!-- /.span2 -->
                <div class="span2">
                    <a href="#">Resoures</a>
                </div> <!-- /.span2 -->
                <div class="span4">
                    <a href="#">Logo Here</a>
                </div> <!-- /.span2 -->
                <div class="span2">
                    <a href="#">Network</a>
                </div> <!-- /.span2 -->
                <div class="span2">
                    <a href="#">Geek Jobs</a>
                </div> <!-- /.span2 -->

            </div> <!-- /.row -->
        </div> <!-- /.container -->