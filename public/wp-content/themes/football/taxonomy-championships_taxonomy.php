<pre>
<?php
/**
 * Created by PhpStorm.
 * User: oleh
 * Date: 16.03.18
 * Time: 21:02
 */

$queried_object = get_queried_object();

echo "taxonomy-{$queried_object->name}";
echo "taxonomy-{$queried_object->term_id}";