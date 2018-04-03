<?php

abstract class Taxonomy{

    protected $taxonomy_type = '';
    protected $taxonomy_labels = [];
    protected $taxonomy_args_array = [];
    protected $post_types_array = [];

    function __construct()
    {
        add_action('init', [$this, 'register_new_taxonomy']);
        $this->taxonomy_args_array['labels'] = $this->taxonomy_labels;
    }

    /**
     * Register custom taxonomy type
     */
    function register_new_taxonomy(){
        register_taxonomy(
            $this->taxonomy_type,
            $this->post_types_array,
            $this->taxonomy_args_array
        );
    }
}