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
    }

    //Must have function called form, takes an instance which is an array that containes the widgets form fields stored in the db
    public function form($instance)
    {
        # code...
    }

    //Must have function called widget which shows the content in the front end. Takes 2 args, one is args which contains the html mark up of the widget and the other is instance same as in form
    public function widget($args, $instance)
    {
        # code...
    }

    //Must have function called update. It updates the information whenever the save button is clicked. It takes the old instance and a new instance
    public function update($new_instance, $old_instance)
    {
        # code...
    }
}
