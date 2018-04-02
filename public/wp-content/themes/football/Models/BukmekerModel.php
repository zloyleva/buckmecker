<?php

class BukmekerModel{
    static private $bukmekers;
    static private $bukmekers_count;
    static private $bukmekers_count_of_subscriptions;

    /**
     * Get all publish Buckmekers from DB and hold results
     */
    static function getBuckmekersFromDB()
    {
        global $wpdb;

        $sql = "SELECT {$wpdb->prefix}posts.ID, {$wpdb->prefix}posts.post_title, {$wpdb->prefix}posts.post_name, {$wpdb->prefix}posts.guid, meta1.meta_value as bukmekers_rate, meta2.meta_value as bukmekers_review_url, meta3.meta_value as bukmekers_users_count 
                FROM {$wpdb->dbname}.{$wpdb->prefix}posts
                left join {$wpdb->dbname}.{$wpdb->prefix}postmeta as meta1 
                  on {$wpdb->prefix}posts.id = meta1.post_id and meta1.meta_key = 'bukmekers_rate'
                left join {$wpdb->dbname}.{$wpdb->prefix}postmeta as meta2 
                  on {$wpdb->prefix}posts.id = meta2.post_id and meta2.meta_key = 'bukmekers_review_url'
                left join {$wpdb->dbname}.{$wpdb->prefix}postmeta as meta3 
                  on {$wpdb->prefix}posts.id = meta3.post_id and meta3.meta_key = 'bukmekers_users_count'
                where post_type = 'bukmekers' and post_status = 'publish'
                ;";

        self::$bukmekers =  $wpdb->get_results($sql, ARRAY_A);
        self::countTheTotalNumberOfSubscriptions(self::$bukmekers);
    }

    private static function countTheTotalNumberOfSubscriptions($array){
        self::$bukmekers_count =  count($array);

        $count = 0;
        foreach($array as $item){
            $count += $item['bukmekers_users_count'];
        }

        self::$bukmekers_count_of_subscriptions = $count;
    }

    static function getBukmekersCount(){
        return self::$bukmekers_count;
    }

    static function getBukmekersCountOfSubscriptions(){
        return self::$bukmekers_count_of_subscriptions;
    }

    static function getBuckmekers(){
        return self::$bukmekers;
    }

    static function getBuckmekersOrderByRate(){
        return self::sortArray(self::$bukmekers, 'bukmekers_rate');
    }

    static function getBuckmekersOrderByUserCount(){
        return self::sortArray(self::$bukmekers, 'bukmekers_users_count');
    }

    static function sortArray($array, $sort_field){

        $temp_array = [];
        foreach($array as $item){
            $temp_array[] = $item[$sort_field];
        }
        array_multisort($temp_array, SORT_DESC, $array);

        return $array;
    }
}