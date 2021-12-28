<?php

namespace Drupal\http_client_welcome\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Link;
use Drupal\http_client_manager\Entity\HttpConfigRequest;
use Drupal\http_client_manager\HttpClientInterface;
use Drupal\http_client_manager\HttpServiceApiWrapperFactoryInterface;
use Drupal\http_client_manager\Plugin\HttpServiceApiWrapper\HttpServiceApiWrapperInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class HttpClientWelcomeController.
 *
 * @package Drupal\http_client_welcome\Controller
 */
class HttpClientWelcomeController extends ControllerBase {

  /**
   * JsonPlaceholder Http Client.
   *
   * @var \Drupal\http_client_manager\HttpClientInterface
   */
  protected $httpClient;

  /**
   * The Posts Api Wrapper service.
   *
   * @var \Drupal\http_client_welcome\Plugin\HttpServiceApiWrapper\HttpServiceApiWrapperPosts
   */
  protected $api;

  /**
   * The HTTP Service Api Wrapper Factory service.
   *
   * @var \Drupal\http_client_manager\HttpServiceApiWrapperFactoryInterface
   */
  protected $apiFactory;

   /**
   * {@inheritdoc}
   */
  public function __construct(HttpClientInterface $http_client, HttpServiceApiWrapperInterface $api_wrapper, HttpServiceApiWrapperFactoryInterface $api_wrapper_factory) {
    $this->httpClient = $http_client;
    $this->api = $api_wrapper;
    $this->apiFactory = $api_wrapper_factory;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('welcome_api.http_client'),
      $container->get('http_client_welcome.api_wrapper.posts'),
      $container->get('http_client_manager.api_wrapper.factory')
    );
  }
  
  /**
   * Get Client.
   *
   * @return \Drupal\http_client_manager\HttpClientInterface
   *   The Http Client instance.
   */
  public function getClient() {
    return $this->httpClient;
  }

  /**
   * Find posts.
   *
   * @return array
   *   The service response.
   */
  public function findPosts() {
    $client = $this->getClient();
    $command = "FindPosts";
    $params = [
      'limit' => '10', 
      'sort' => 'desc',
    ];    
    
    // Call method usage.
    $response = $client->call($command, [
      'limit' => '10', 
      'sort' => 'desc',
    ]);
    
    // Twig Template/Style Library.
    $build = [
      '#theme' => 'http_client_welcome_posts_list',
      '#posts' => NULL,
      '#attached' => [     
        'library' => [
          'http_client_welcome/welcome-styles',
        ],
      ],
    ];
    
    // Loop data array.
    $response = $response->toArray();
    foreach ($response as $id => $post) {
      $build['#posts'][] = $this->buildPostResponse($post);
    }

    $build['#posts'][] = $posts;
    return $build;
  }

  /**
   * Build Post response.
   *
   * @param array $post
   *   The Post response item.
   *
   * @return array
   *   A render array of the post.
   */
  protected function buildPostResponse(array $post) {
    $output = [
      'side' => $post['side'],
      'year' => $post['year'],
      'miles' => $post['miles'],
      'gas' => $post['gas'],
    ];
    return $output;
  }

  /**
   * Check Token module.
   */
  protected function checkTokenModule() {
    if (!$this->moduleHandler()->moduleExists('token')) {
      $message = $this->t('Install the Token module in order to use tokens inside your HTTP Config Requests.');
      \Drupal::messenger()->addWarning($message);
    }
  }

}
