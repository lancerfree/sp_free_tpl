<?php

namespace Drupal\sp_free_tpl\Routing;

use Drupal\Core\Routing\RouteSubscriberBase;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;
use Drupal\Core\Routing\RoutingEvents;

/**
 * Adds routes to the route collection.
 */
class TplRouteSubscriber extends RouteSubscriberBase {

  /**
   * {@inheritdoc}
   */
  public static function getSubscribedEvents() {
    $events = parent::getSubscribedEvents();
    $events[RoutingEvents::ALTER] = ['onAlterRoutes', -300];
    return $events;
  }

  /**
   * {@inheritdoc}
   */
  protected function alterRoutes(RouteCollection $collection) {
    $plugin_service = \Drupal::service('plugin.manager.sp_free_tpl');
    //Call all plugins
    $plugin_definitions = $plugin_service->getDefinitions();
    foreach ($plugin_definitions AS $plugin_id => $plugin_info) {
      $plugin_instance = $plugin_service->createInstance($plugin_id);

      /* @var \Drupal\sp_free_tpl\Plugin\TplPluginBase $plugin_instance */
      $router_values = $plugin_instance->getRoutes();
      //Sets for all routes default configuration
      foreach ($router_values AS $rv_key => $rv_value) {
        $path = $rv_value[0];
        $defaults = [
          '_title' => 'Default title',
          '_controller' => '\Drupal\sp_free_tpl\Controller\TplDefaultController::getContent',
          'sp_free_tpl_plugin_id' => $plugin_id,
        ];
        //but we can overide defaults in the plugin
        $defaults = array_merge($defaults, !empty($rv_value[1]) ? $rv_value[1] : []);

        $requirements = [
          '_access' => 'TRUE',
        ];

        $requirements = array_merge($requirements, !empty($rv_value[2]) ? $rv_value[2] : []);

        $route = new Route($path, $defaults, $requirements);
        $collection->add($rv_key, $route);
      }
    }
  }

}