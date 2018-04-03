<?php

class ChampionshipModel{

    protected $total_posts_number;
    protected $championships_post;
    protected $per_page = 6;
    protected $sql_join_list = '';
    protected $sql_select_list = '';

    function __construct()
    {
        $this->total_posts_number = $this->getPostsTotalCount();

        $this->setSqlQueryString(new Championship());
    }

    protected function setSqlQueryString(Championship $championship){
        global $wpdb;
        $meta_fields = $championship->getPostMetaArray();

        //Create query fields for SQL query
        $i = 1;
        foreach ($meta_fields as $field){
            $this->sql_select_list .= ", meta{$i}.meta_value as {$field['name']}";
            $this->sql_join_list .= "left join {$wpdb->postmeta} as meta{$i} on {$wpdb->posts}.id = meta{$i}.post_id and meta{$i}.meta_key = '{$field['name']}'";
            $i++;
        }
    }

    /**
     * @return mixed
     */
    protected function getPostsTotalCount()
    {
        global $wpdb;

        $sql = "SELECT count(*) as total_posts FROM {$wpdb->posts}
                where ID in 
                    (SELECT object_id FROM {$wpdb->term_relationships} where term_taxonomy_id in 
                      (SELECT term_taxonomy_id FROM {$wpdb->term_taxonomy} where taxonomy = 'championships_taxonomy') 
                    )
                and post_status = 'publish'
                ;";
        $result = $wpdb->get_results($sql, ARRAY_A);
        return $result[0]['total_posts'];
    }

    /**
     * @return float
     */
    public function getTotalPageCount(){
        return ceil($this->total_posts_number/$this->per_page);
    }

    /**
     * @param $page_number
     * @return array|null|object
     */
    function getPostsWithMetaForPage($page_number)
    {
        global $wpdb;

        $selected_fields = "wp_posts.ID, wp_posts.post_date, wp_posts.post_content, wp_posts.post_title, wp_posts.post_excerpt, wp_posts.post_name, wp_posts.guid, wp_posts.post_type";
        $selected_fields .= $this->sql_select_list;

        $sql = "SELECT {$selected_fields} FROM {$wpdb->posts}
                {$this->sql_join_list}
                where ID in 
                    (SELECT object_id FROM {$wpdb->term_relationships} where term_taxonomy_id in 
                      (SELECT term_taxonomy_id FROM {$wpdb->term_taxonomy} where taxonomy = 'championships_taxonomy') 
                    )
                and post_status = 'publish'
                {$this->getLimiAndOffset($page_number)}
                ;";

        return  $wpdb->get_results($sql, ARRAY_A);
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

    /**
     * @param $page_number
     * @return string
     */
    protected function getLimiAndOffset($page_number){
        if($page_number<0){
            return '';
        }
        $offset = ($page_number-1) * $this->per_page;
        return "LIMIT {$this->per_page} OFFSET {$offset}";
    }

    /**
     * @param $post_id
     */
    public function updateChampionsPageViewsCount($post_id){
        global $wpdb;
        $sql = "SELECT * FROM {$wpdb->postmeta} where post_id = {$post_id} and meta_key = 'championships_prognoz_views';";
        $result = $wpdb->get_results($sql, ARRAY_A);

        if(is_array($result) && count($result) && $result[0]['meta_value'] > -1){
            //+1
            $sql = "UPDATE {$wpdb->postmeta} SET meta_value=meta_value+1 WHERE meta_id={$result[0]['meta_id']};";
            $wpdb->query($sql);
        }else{
            //set 1
            $sql = "INSERT INTO {$wpdb->postmeta} (post_id,meta_key,meta_value) VALUES($post_id,'championships_prognoz_views',1);";
            $wpdb->query($sql);
        }
    }

}