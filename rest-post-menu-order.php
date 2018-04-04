<?php
/*
 * Created on Apr 3, 2018
 * Plugin Name: REST menu order
 * Description: Adds support for quering menu_order from all post types 
 * Version: 1.0.0
 * Author: Metatavu Oy
 */

  defined ( 'ABSPATH' ) || die ( 'No script kiddies please!' );
  
  add_action('rest_api_init', function () {
    register_rest_route('menuorder/v1', '/posts/(?P<id>\d+)', [
      'methods' => 'GET',
      'callback' => function ($data) {
        $postId = intval($data["id"]);
        if (!$postId) {
          return null;
        }

        $post = get_post($postId);
        if ($post && $post->post_status === "publish") {
          return [
            "menu_order" => $post->menu_order
          ];
        }

        return null;
      }
    ]);

  });

?>
