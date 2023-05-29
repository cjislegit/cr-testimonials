<?php
$testimonials = new WP_Query(
    array(
        'post_type' => 'cr-testimonials',
        'posts_per_page' => $number,
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
<div class="testimonial-item">
    <div class="title">
        <h3><?php the_title();?></h3>
    </div>
    <div class="content">
        <?php if ($image): ?>
        <div class="thumb">
            <?php
        if (has_post_thumbnail()) {
            the_post_thumbnail(array(70, 70));
        }
        ?>
        </div>
        <?php endif;?>
        <?php the_content();?>
    </div>
    <div class="meta">
        <?php if ($occupation): ?>
        <span class="occupation">
            <?=esc_html($occupation_meta);?>
        </span>
        <?php endif;?>
        <?php if ($company): ?>
        <span class="company">
            <a href="<?=esc_attr($url_meta)?>"><?=esc_html($company_meta);?></a>
        </span>
        <?php endif;?>
    </div>
</div>
<?php

endwhile;
wp_reset_postdata();
endif;
?>
<a
    href="<?= get_post_type_archive_link('cr-testimonials'); ?>"><?= esc_html_e('Show More Testimonials', 'cr-testimonials'); ?></a>