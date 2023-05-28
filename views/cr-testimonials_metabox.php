<?php

$occupation = get_post_meta($post->ID, 'cr_testimonials_occupation', true);
$company = get_post_meta($post->ID, 'cr_testimonials_company', true);
$user_url = get_post_meta($post->ID, 'cr_testimonials_user_url', true);

?>

<table class="form-table cr-testimonials-metabox">
    <input type="hidden" name="cr_testimonials_nonce" value="<?php echo wp_create_nonce("cr_testimonials_nonce"); ?>">
    <tr>
        <th>
            <label for="cr_testimonials_occupation"><?php esc_html_e('User occupation', 'cr-testimonials');?></label>
        </th>
        <td>
            <input type="text" name="cr_testimonials_occupation" id="cr_testimonials_occupation"
                class="regular-text occupation"
                value="<?php echo (isset($occupation)) ? esc_html($occupation) : ''; ?>">
        </td>
    </tr>
    <tr>
        <th>
            <label for="cr_testimonials_company"><?php esc_html_e('User company', 'cr-testimonials');?></label>
        </th>
        <td>
            <input type="text" name="cr_testimonials_company" id="cr_testimonials_company" class="regular-text company"
                value="<?php echo (isset($company)) ? esc_html($company) : ''; ?>">
        </td>
    </tr>
    <tr>
        <th>
            <label for="cr_testimonials_user_url"><?php esc_html_e('User URL', 'cr-testimonials');?></label>
        </th>
        <td>
            <input type=" url" name="cr_testimonials_user_url" id="cr_testimonials_user_url"
                class="regular-text user-url" value="<?php echo (isset($user_url)) ? esc_url($user_url) : ''; ?>">
        </td>
    </tr>
</table>