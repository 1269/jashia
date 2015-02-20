<?php
/*
 Template Name: Home-Page Next
 
*/
?>

<?php get_header(); ?>

			<div id="content">

				<header class="article-header">
					<div id="inner-content" class="wrap cf">
									<h1 class="page-title" style="text-align: center"><?php bloginfo('description'); ?></h1>

					</div>	


								</header>
				<div id="inner-content" class="wrap cf">
						<!-- Start Slider -->
						<div id="slide-wrap">
							<?php 
								$args = array(
									'posts_per_page' => 10,
									'post_status' => 'publish',
									'post__in' => get_option("sticky_posts")
								);
								$fPosts = new WP_Query( $args );
							?>

							<?php if ( $fPosts->have_posts() ) : ?>
								
								<div class="cycle-slideshow" <?php 
								if ( get_theme_mod('simplyread_slider_effect') ) :
									echo 'data-cycle-fx="' . wp_kses_post( get_theme_mod('simplyread_slider_effect') ) . '" data-cycle-tile-count="10"';
								else:
									echo 'data-cycle-fx="scrollHorz"';
								endif;
								?> data-cycle-slides="> div.slides" <?php
								if ( get_theme_mod('simplyread_slider_timeout') ) :
								$slider_timeout = wp_kses_post( get_theme_mod('simplyread_slider_timeout') );
									echo 'data-cycle-timeout="' . $slider_timeout . '000"';
								else:
									echo 'data-cycle-timeout="5000"';
								endif;
								?> data-cycle-prev="#sliderprev" data-cycle-next="#slidernext">


							<?php while ( $fPosts->have_posts() ) : $fPosts->the_post();  ?>

									<div class="slides">

										<div id="post-<?php the_ID(); ?>" <?php post_class('post-theme'); ?>>

											<?php 
												$image_full = simplyread_catch_that_image(); 
												$gallery_full = simplyread_catch_gallery_image_full(); 
											?>
											<?php if ( has_post_thumbnail()) : ?>
												<div class="slide-thumb"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail( "full" ); ?></a></div>
											
											<?php elseif(has_post_format('image') && !empty($image_full)) :  ?>
												<div class="slide-thumb"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php echo $image_full; ?></a></div>
											
											<?php elseif(has_post_format('gallery') && !empty($gallery_full)) : ?>  
												<div class="slide-thumb"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php echo $gallery_full; ?></a></div>
											
											<?php else : ?>
												<div class="slide-noimg"><p><?php _e('No featured image set for this post.', 'simplyread') ?></p></div>
											<?php endif;  ?>

										</div>

										<div class="slide-copy-wrap">
											<div class="slide-copy">
												<h2 class="slide-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'simplyread' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
												<?php the_excerpt(); ?>
											</div>
										</div>

									</div>

							<?php endwhile; ?>

									<div class="slidernav">
										<a id="sliderprev" href="#" title="<?php _e('Previous', 'simplyread'); ?>"><?php _e('&#9664;', 'simplyread'); ?></a>
										<a id="slidernext" href="#" title="<?php _e('Next', 'simplyread'); ?>"><?php _e('&#9654;', 'simplyread'); ?></a>
									</div>

								</div>

							<?php endif; ?>

							<?php wp_reset_postdata(); ?>

						</div> <!-- slider-wrap -->

						<!-- End Slider -->
						<div id="main" class="m-all t-2of3 d-5of7 cf full" role="main">

							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

							<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

								<!-- <p class="byline vcard">
										<?php printf( __( 'Posted <time class="updated" datetime="%1$s" pubdate>%2$s</time> by <span class="author">%3$s</span>', 'simplyread' ), get_the_time('Y-m-j'), get_the_time(get_option('date_format')), get_the_author_link( get_the_author_meta( 'ID' ) )); ?>
								</p> -->

								<section class="entry-content cf" itemprop="articleBody">
									<?php

										the_content();

									
										wp_link_pages( array(
											'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'simplyread' ) . '</span>',
											'after'       => '</div>',
											'link_before' => '<span>',
											'link_after'  => '</span>',
										) );
									?>
								</section>


								

								<?php comments_template(); ?>

							</article>

							<?php endwhile; else : ?>

									<article id="post-not-found" class="hentry cf">
										<header class="article-header">
												<h1><?php _e( 'Oops, Post Not Found!', 'simplyread' ); ?></h1>
												<p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'simplyread' ); ?></p>
										</header>
										
									</article>

							<?php endif; ?>

						</div>

						

				</div>

			</div>


<?php get_footer(); ?>
