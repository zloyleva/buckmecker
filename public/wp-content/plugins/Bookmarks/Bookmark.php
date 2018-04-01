<?php
class Bookmark{

    private static $bookmarkInstance = null;

    function __construct()
    {
    }

    static function getInstance(){
        if(self::$bookmarkInstance === null){
            self::$bookmarkInstance = new self();
        }
        return self::$bookmarkInstance;
    }

    /**
     * @param $post_id
     * @param $user_id
     * @return array|null|object
     */
    public function getPostBookmarkForCurrentUser($post_id, $user_id){
        global $wpdb;
        $sql = "SELECT * FROM {$wpdb->postmeta} where post_id = {$post_id} and meta_key = '_bookmarks' and meta_value = {$user_id};";
        return  $wpdb->get_results($sql, ARRAY_A);
    }

    /**
     * @param $post_id
     * @param $user_id
     * @return bool
     */
    public function isPostBookmarkSetForCurrentUser($post_id, $user_id){
        $get_meta = $this->getPostBookmarkForCurrentUser($post_id, $user_id);

        if(count($get_meta) == 1 && $get_meta[0]['meta_key'] == '_bookmarks' && (int) $get_meta[0]['meta_value'] == $user_id){
            return true;
        }
        return false;
    }

    /**
     * @param $data
     * @return bool
     */
    public function bookmarkAction($data){
        $args = ['bookmark', 'post_id', 'user_id'];

        if($this->isGetHasFields($data, $args) && $this->validIds($data['post_id'], $data['user_id'])){

            switch ($data['bookmark']){
                case 'set':
                    add_post_meta( $data['post_id'], '_bookmarks', $data['user_id'] );
                    break;
                case 'unset':
                    delete_post_meta( $data['post_id'], '_bookmarks', $data['user_id'] );
                    break;
            }
            return true;
        }
        return false;
    }

    /**
     * @param $data
     * @param $args
     * @return bool
     */
    private function isGetHasFields($data, $args){
        foreach ($args as $arg){
            if ( ! isset($data[$arg]) ) return false;
        }
        return true;
    }

    /**
     * @param array ...$ids
     * @return bool
     */
    private function validIds(...$ids){
        foreach ($ids as $id){
            if(! $id > 0 ) return false;
        }
        return true;
    }

}