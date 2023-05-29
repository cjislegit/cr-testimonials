<?php

//All widgets have to extend wp_widget
class CR_Testimonials_Widget extends WP_Widget
{
    //Must incude public construct method
    public function __construct()
    {
        $widget_options = array(
            'description' => __('Your most beloved testimonials', 'cr-testimonials'),
        );
        //Must have a construct from the parent class
        parent::__construct(
            //Base ID for the widget. Optional
            'cr-testimonials',
            //Name of the widget
            'CR Testimonials',
            //Widget options. Optional
            $widget_options
        );

        //Registers widget
        add_action(
            'widgets_init', function () {
                register_widget('CR_Testimonials_Widget');
            }
        );

        if (is_active_widget(false, false, $this->id_base)) {
            add_action('wp_enqueue_scripts', array($this, 'enqueue'));
        }
    }

    public function enqueue()
    {
        wp_enqueue_style(
            'cr-testimonials-style-css',
            CR_TESTIMONIALS_URL . 'assets/css/frontend.css',
            array(),
            CR_TESTIMONIALS_VERSION,
            'all'
        );
    }

    //Must have function called form, takes an instance which is an array that containes the widgets form fields stored in the db
    public function form($instance)
    {
        $title = isset($instance['title']) ? $instance['title'] : '';
        $number = isset($instance['number']) ? (int) $instance['number'] : 5;
        $image = isset($instance['image']) ? (bool) $instance['image'] : false;
        $occupation = isset($instance['occupation']) ? (bool) $instance['occupation'] : false;
        $company = isset($instance['company']) ? (bool) $instance['company'] : false;

        ?>

<p>
    <label for="<?=$this->get_field_id('title');?>"><?php esc_html_e('Title', 'cr-testimonials');?>:</label>
    <input type="text" class="widefat" id="<?=$this->get_field_id('title');?>"
        name="<?=$this->get_field_name('title');?>" value="<?=esc_attr($title)?>">
</p>

<p>
    <label
        for="<?=$this->get_field_id('number');?>"><?php esc_html_e('Number of testimonials to show', 'cr-testimonials');?>:</label>
    <input type="number" class="tiny-text" id="<?=$this->get_field_id('number');?>" step="1" min="1" size="3"
        name="<?=$this->get_field_name('number');?>" value="<?=esc_attr($number)?>">
</p>

<p>
    <input type="checkbox" class="checkbox" id="<?=$this->get_field_id('image');?>"
        name="<?=$this->get_field_name('image');?>" <?php checked($image)?>>
    <label
        for="<?=$this->get_field_id('image');?>"><?php esc_html_e('Display user image?', 'cr-testimonials');?>:</label>
</p>

<p>
    <input type="checkbox" class="checkbox" id="<?=$this->get_field_id('occupation');?>"
        name="<?=$this->get_field_name('occupation');?>" <?php checked($occupation)?>>
    <label
        for="<?=$this->get_field_id('occupation');?>"><?php esc_html_e('Display occupation?', 'cr-testimonials');?>:</label>
</p>

<p>
    <input type="checkbox" class="checkbox" id="<?=$this->get_field_id('company');?>"
        name="<?=$this->get_field_name('company');?>" <?php checked($company)?>>
    <label
        for="<?=$this->get_field_id('company');?>"><?php esc_html_e('Display company?', 'cr-testimonials');?>:</label>
</p>

<?php
}

    //Must have function called widget which shows the content in the front end. Takes 2 args, one is args which contains the html mark up of the widget and the other is instance same as in form
    public function widget($args, $instance)
    {
        $default_title = 'CR Testimionials';
        $title = !empty($instance['title']) ? $instance['title'] : $default_title;
        $number = !empty($instance['number']) ? $instance['number'] : 5;
        $image = isset($instance['image']) ? $instance['image'] : false;
        $occupation = isset($instance['occupation']) ? $instance['occupation'] : false;
        $company = isset($instance['company']) ? $instance['company'] : false;

        echo $args['before_widget'];
        echo $args['before_title'] . $title . $args['after_title'];
        require CR_TESTIMONIALS_PATH . 'views/cr-testimonials_widget.php';
        echo $args['after_widget'];
    }

    //Must have function called update. It updates the information whenever the save button is clicked. It takes the old instance and a new instance
    public function update($new_instance, $old_instance)
    {
        $instance = $old_instance;
        $instance['title'] = sanitize_text_field($new_instance['title']);
        $instance['number'] = (int) $new_instance['number'];
        $instance['image'] = !empty($new_instance['image']) ? 1 : 0;
        $instance['occupation'] = !empty($new_instance['occupation']) ? 1 : 0;
        $instance['company'] = !empty($new_instance['company']) ? 1 : 0;
        return $instance;
    }
}