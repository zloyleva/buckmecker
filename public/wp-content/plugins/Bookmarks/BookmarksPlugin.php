<?php
require_once 'Bookmark.php';
/*
Plugin Name: Bookmarks Plugin
Plugin URI: http://my-site.org/plugins/Bookmarks/
Description: This is a plugin for bookmark post
Author: ZloyLeva
Version: 1.0
Author URI: http://localhost/
*/

class BookmarksPlugin{

    private $bookmarksListPageName = 'page-bookmarks.php';

    function __construct()
    {
        if( !( $this->isBookmarksListPageExist() || $this->isCreatedNewBookmarksListPage() ) ){
            add_action( 'admin_notices', [$this, 'no_file_notice'] );
        }

        add_action('the_post', [$this, 'add_bookmark_buttons']);
        add_action('init', [$this, 'do_bookmark_verb']);
    }

    function do_bookmark_verb(){
        $bookmark = Bookmark::getInstance();
        $bookmark->bookmarkAction($_POST);
    }

    function add_bookmark_buttons(& $post){
        $bookmark = Bookmark::getInstance();
        $current_user_id = get_current_user_id();

        $button_text = "Bookmark";
        $action = 'set';
        $sign = " <i class='fas fa-bookmark'></i>";
        if($bookmark->isPostBookmarkSetForCurrentUser($post->ID, $current_user_id)){
            $button_text = "UnBookmark";
            $action = 'unset';
            $sign = " <i class='far fa-bookmark'></i>";
        }

        $html = '';
        if($current_user_id){
            $html = "<form action='' method='post' style='order: 3;'>
                        <input type='hidden' name='bookmark' value='{$action}'>
                        <input type='hidden' name='post_id' value='{$post->ID}'>
                        <input type='hidden' name='user_id' value='{$current_user_id}'>
                        <button class='btn btn--block card__btn' >{$button_text} {$sign}</button>
                    </form>";
        }

        $post->post_title = "<div class=\"card__title\">" . $post->post_title . "</div>". $html;
    }

    function no_file_notice(){
        echo   "<div class='error notice'>
                    <p>We can't create {$this->bookmarksListPageName} file. Do it self!</p>
                </div>";
    }

    /**
     * @return bool
     */
    private function isBookmarksListPageExist(){
        return file_exists(get_template_directory().'/'.$this->bookmarksListPageName);
    }

    /**
     * @return bool
     */
    private function isCreatedNewBookmarksListPage(){
        return
            copy(plugin_dir_path( __FILE__ ).$this->bookmarksListPageName,get_template_directory().'/'.$this->bookmarksListPageName)
            && chmod(get_template_directory().'/'.$this->bookmarksListPageName, 0777);
    }

}

new BookmarksPlugin();