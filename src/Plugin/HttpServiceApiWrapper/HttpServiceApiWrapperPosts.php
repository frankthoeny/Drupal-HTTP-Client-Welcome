<?php

namespace Drupal\http_client_welcome\Plugin\HttpServiceApiWrapper;

use Drupal\http_client_manager\Plugin\HttpServiceApiWrapper\HttpServiceApiWrapperBase;
use Drupal\http_client_welcome\api\Commands\Posts;

/**
 * Class HttpServiceApiWrapperPosts.
 *
 * @package Drupal\http_client_manager\Plugin\HttpServiceApiWrapper
 */
class HttpServiceApiWrapperPosts extends HttpServiceApiWrapperBase {

  /**
   * {@inheritdoc}
   */
  public function getHttpClient() {
    return $this->httpClientFactory->get('welcome_services_yaml');
  }

  /**
   * Find Posts.
   *
   * @return array
   *   An array of posts.
   */
  public function findPosts() {
    return $this->call(Posts::FIND_POSTS)->toArray();
  }

  /**
   * Find Post.
   *
   * @param int $postId
   *   The Post id.
   *
   * @return array
   *   An array representing the Post matching the provided id.
   */
  public function findPost($postId) {
    $args = NULL;
    return $this->call(Posts::FIND_POST, $args)->toArray();
  }
}
