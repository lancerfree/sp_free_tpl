<?php

namespace Drupal\sp_free_tpl\Plugin;

use Drupal\Component\Plugin\PluginInspectionInterface;

/**
 * Interface TplInterface
 *
 * @package Drupal\sp_free_tpl\Plugin
 */
interface TplInterface extends PluginInspectionInterface {

  /**
   * Return id of the.
   *
   * @param string
   *   Id plugin.
   */
  public function getId();

  /**
   *  Return templates that will be used.
   *
   * @param array
   *   Settings for theme - templates twig.
   */
  public function templateInfo();

  /**
   * Return array with route.
   *
   * @param array
   *   Settings for route.
   */
  public function routeInfo();

  /**
   *  Return theme name for render.
   *
   * @param array
   *   Theme name for processing request.
   */
  public function themeInfo();

  /**
   *  Return array with styles and scripts.
   *
   * @param array
   *   Library list.
   */
  public function libraryInfo();

}