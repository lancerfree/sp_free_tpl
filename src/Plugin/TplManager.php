<?php

namespace Drupal\sp_free_tpl\Plugin;

use Drupal\Component\Plugin\Factory\DefaultFactory;
use Drupal\Core\Cache\CacheBackendInterface;
use Drupal\Core\Extension\ModuleHandlerInterface;
use Drupal\Core\Plugin\DefaultPluginManager;

/**
 * Service TplManager.
 */
class TplManager extends DefaultPluginManager {

  /**
   * {@inheritdoc}
   */
  public function __construct(\Traversable $namespaces, CacheBackendInterface $cache_backend, ModuleHandlerInterface $module_handler) {
    parent::__construct(
      'Plugin/TplPlugins',
      $namespaces,
      $module_handler,
      'Drupal\sp_free_tpl\Plugin\TplInterface',
      'Drupal\sp_free_tpl\Annotation\TplAnnotation'
    );
    $this->setCacheBackend($cache_backend, 'sp_free_tpl');
    $this->factory = new DefaultFactory($this->getDiscovery());
  }

}