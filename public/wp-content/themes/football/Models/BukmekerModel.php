<?php

class BukmekerModel{
    static private $bukmekers;
    static private $bukmekers_count;
    static private $bukmekers_count_of_subscriptions;

    protected $sql_join_list = '';
    protected $sql_select_list = '';

    public function __construct()
    {
        $this->setSqlQueryString(new Bukmeker());
    }

    protected function setSqlQueryString(Bukmeker $bukmeker){
        global $wpdb;
        $meta_fields = $bukmeker->getPostMetaArray();

        //Create query fields for SQL query
        $i = 1;
        foreach ($meta_fields as $field){
            $this->sql_select_list .= ", meta{$i}.meta_value as {$field['name']}";
            $this->sql_join_list .= "left join {$wpdb->postmeta} as meta{$i} on {$wpdb->posts}.id = meta{$i}.post_id and meta{$i}.meta_key = '{$field['name']}'";
            $i++;
        }
    }

    /**
     * Get all publish Buckmekers from DB and hold results
     */
    function getBuckmekersFromDB()
    {
        global $wpdb;

        $selected_fields = "wp_posts.ID, wp_posts.post_date, wp_posts.post_content, wp_posts.post_title, wp_posts.post_excerpt, wp_posts.post_name, wp_posts.guid, wp_posts.post_type";
        $selected_fields .= $this->sql_select_list;

        $sql = "SELECT {$selected_fields} FROM {$wpdb->posts}
                {$this->sql_join_list}
                where post_type = 'bukmekers' and post_status = 'publish'
                ;";

        self::$bukmekers =  $wpdb->get_results($sql, ARRAY_A);
        $this->countTheTotalNumberOfSubscriptions(self::$bukmekers);
    }

    function getCurrentPostWithMetaForPage($page_id)
    {
        global $wpdb;

        $selected_fields = "wp_posts.ID, wp_posts.post_date, wp_posts.post_content, wp_posts.post_title, wp_posts.post_excerpt, wp_posts.post_name, wp_posts.guid, wp_posts.post_type";
        $selected_fields .= $this->sql_select_list;

        $sql = "SELECT {$selected_fields} FROM {$wpdb->posts}
                {$this->sql_join_list}
                where ID in ({$page_id})
                and post_status = 'publish'
                ;";

        return  $wpdb->get_results($sql, ARRAY_A);
    }

    private function countTheTotalNumberOfSubscriptions($array){
        self::$bukmekers_count =  count($array);

        $count = 0;
        foreach($array as $item){
            $count += $item['bukmekers_users_count'];
        }

        self::$bukmekers_count_of_subscriptions = $count;
    }

    function getBukmekersCount(){
        return self::$bukmekers_count;
    }

    function getBukmekersCountOfSubscriptions(){
        return self::$bukmekers_count_of_subscriptions;
    }

    function getBuckmekers(){
        return self::$bukmekers;
    }

    function getBuckmekersOrderByRate(){
        return $this->sortArray(self::$bukmekers, 'bukmekers_rate');
    }

    function getBuckmekersOrderByUserCount(){
        return $this->sortArray(self::$bukmekers, 'bukmekers_users_count');
    }

    function sortArray($array, $sort_field){

        $temp_array = [];
        foreach($array as $item){
            $temp_array[] = $item[$sort_field];
        }
        array_multisort($temp_array, SORT_DESC, $array);

        return $array;
    }
}