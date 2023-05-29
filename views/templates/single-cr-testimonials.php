<?php get_header();?>
<div class="cr-testimonials-single">
    <header class="entry-header">
        <?php the_title('<h1 class="entry-title">', '</h1>')?>
    </header>
    <?php
while (have_posts()):
    the_post();

    $url_meta = get_post_meta(get_the_ID(), 'cr_testimonials_user_url', true);
    $occupation_meta = get_post_meta(get_the_ID(), 'cr_testimonials_occupation', true);
    $company_meta = get_post_meta(get_the_ID(), 'cr_testimonials_company', true);

    ?>
	    <article id="post-<?php the_ID();?>" <?php post_class();?>>
	        <div class="testimonial-item">
	            <div class="content">
	                <div class="thumb">
	                    <?php
    if (has_post_thumbnail()) {
        the_post_thumbnail(array(200, 200), array('class' => 'img-flluid'));
    }
    ?>
	                </div>
	                <?php the_content();?>
	            </div>
	            <div class="meta">
	                <span class="occupation">
	                    <?=esc_html($occupation_meta);?>
	                </span>
	                <span class="company">
	                    <a href="<?=esc_attr($url_meta)?>"><?=esc_html($company_meta);?></a>
	                </span>
	            </div>
	        </div>
	    </article>
	    <?php

endwhile;
?>
</div>
<?php get_footer();?>