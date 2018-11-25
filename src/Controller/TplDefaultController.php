<?php

namespace Drupal\sp_free_tpl\Controller;

use Symfony\Component\HttpFoundation\Request;
use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\sp_free_tpl\Plugin\TplManager;

/**
 * Class TplDefaultController
 */
class TplDefaultController extends ControllerBase {

  /**
   * Plugin Manager.
   *
   * @var \Drupal\sp_free_tpl\Plugin\TplManager
   */
  protected $plugin_service;

  /**
   * Route callback.
   *
   * @param string $sp_free_tpl_plugin_id
   *   Plugin id for current route.
   * @param string $method_name
   *   Method name for current route.
   * @param string $param_name
   *   Name for some difference.
   *
   * @return mixed
   */
  public function getContent(
    $sp_free_tpl_plugin_id = '',
    $method_name = 'getPluginContent',
    $param_name = ''
  ) {
    $plugin_instance = $this->plugin_service->createInstance($sp_free_tpl_plugin_id);
    $content = $plugin_instance->$method_name($param_name);
    return $content;
  }

  /**
   * Depemdency injection implements.
   *
   * @param \Symfony\Component\DependencyInjection\ContainerInterface $container
   *
   * @return static
   */
  public static function create(ContainerInterface $container) {
    /** @var TplManager $service */
    $service = $container->get('plugin.manager.sp_free_tpl');
    return new static($service);
  }

  /**
   * TplDefaultController constructor.
   *
   * @param \Drupal\sp_free_tpl\Plugin\TplManager $service
   */
  public function __construct(TplManager $service) {
    $this->plugin_service = $service;
  }

}
