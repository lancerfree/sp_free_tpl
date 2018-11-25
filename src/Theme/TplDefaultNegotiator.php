<?php

namespace Drupal\sp_free_tpl\Theme;

use Drupal\Core\Routing\RouteMatchInterface;
use Drupal\Core\Theme\ThemeNegotiatorInterface;
use Drupal\Core\Path\PathMatcherInterface;

/**
 * Sets theme for specific plugin.
 */
class TplDefaultNegotiator implements ThemeNegotiatorInterface {

  /**
   * @var \Drupal\Core\Path\PathMatcherInterface
   */
  protected $pathMatcher;

  /**
   * Name of plugin to handle.
   *
   * @var null
   */
  protected $plugin_id = NULL;

  /**
   * TplDefaultNegotiator constructor.
   *
   * @param \Drupal\Core\Path\PathMatcherInterface $pathMatcher
   */
  public function __construct(PathMatcherInterface $pathMatcher) {
    $this->pathMatcher = $pathMatcher;
  }

  /**
   * {@inheritdoc}
   */
  public function applies(RouteMatchInterface $routeMatch) {
    //  $apply = !empty($routeMatch->route->defaults['sp_free_tpl_plugin_id']);
    $route_object = $routeMatch->getRouteObject();
    if (!$route_object) {
      return FALSE;
    }
    $defaults = $route_object->getDefaults();
    if (!$defaults) {
      return FALSE;
    }
    //main features for apply
    if (!empty($defaults["sp_free_tpl_plugin_id"])) {
      $this->plugin_id = $defaults["sp_free_tpl_plugin_id"];
      return TRUE;
    }
   return FALSE;
  }

  /**
   * {@inheritdoc}
   */
  public function determineActiveTheme(RouteMatchInterface $routeMatch) {
    $plugin_service = \Drupal::service('plugin.manager.sp_free_tpl');
    $plugin_instance = $plugin_service->createInstance($this->plugin_id);
    $theme_name = $plugin_instance->getTheme();
    return $theme_name;
  }

}