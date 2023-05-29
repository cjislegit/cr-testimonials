<?php get_header();?>
<div class="cr-testimonials-archive">
    <header class="page-header">
        <?php the_archive_title('<h1 class="page-title">', '</h1>')?>
    </header>
    <?php
$testimonials = new WP_Query(
    array(
        'post_type' => 'cr-testimonials',
        'posts_per_page' => -1,
        'post_status' => 'publish',
    )
);

if ($testimonials->have_posts()):
    while ($testimonials->have_posts()):
        $testimonials->the_post();

        $url_meta = get_post_meta(get_the_ID(), 'cr_testimonials_user_url', true);
        $occupation_meta = get_post_meta(get_the_ID(), 'cr_testimonials_occupation', true);
        $company_meta = get_post_meta(get_the_ID(), 'cr_testimonials_company', true);

        ?>
    <article id="post-<?php the_ID();?>" <?php post_class();?>>
        <div class="testimonial-item">
            <div class="title">
                <h2><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
            </div>
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
wp_reset_postdata();
endif;
?>
</div>
<?php get_footer();?>