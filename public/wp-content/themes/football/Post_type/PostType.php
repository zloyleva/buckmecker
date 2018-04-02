<?php

abstract class PostType{

    protected $post_type = '';
    protected $post_labels = [];
    protected $post_args_array = [];

    function __construct()
    {
        add_action('init', [$this, 'register_post_types']);
        $this->post_args_array['labels'] = $this->post_labels;
    }

    /**
     * Register custom post type
     */
    function register_post_types(){
        register_post_type(
            $this->post_type,
            $this->post_args_array
        );
    }
}