<?php

namespace Drupal\sp_free_tpl\Annotation;

use Drupal\Component\Annotation\Plugin;

/**
 * Аннотации для плагина PluginMessages.
 *
 * @Annotation
 */
class TplAnnotation extends Plugin {

  /**
   * Id plugin.
   *
   * @var string
   */
  public $id;

  /**
   *  Routes for plugin.
   *
   * @var array
   */
  public $routes = [];

  /**
   * Theme for processing
   *
   * @var string
   */
  public $theme = '';

  /**
   * Twig templates.
   *
   * @var array
   */
  public $templates = [];

  /**
   * Libraries with js and css for include.
   *
   * @var array
   */
  public $libraries = [];

}
