<?php

$args = array(
    'base'         => '%_%',
    'format'       => '?page=%#%',
    'total'        => $championship->getTotalPageCount(),
    'current'      => $current_page,
    'end_size'     => 1,
    'mid_size'     => 1,
    'prev_next'    => false,
    'type'         => 'list',
    'add_args'     => False,
    'add_fragment' => '',
);

echo paginate_links( $args );
