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
   * Returns id of the.
   *
   * @param string
   *   Id plugin.
   */
  public function getId();

  /**
   *  Returns templates that will be used.
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
   *  Returns theme name for render.
   *
   * @param array
   *   Theme name for processing request.
   */
  public function themeInfo();

  /**
   *  Returns array with styles and scripts.
   *
   * @param array
   *   Library list.
   */
  public function libraryInfo();

  /**
   *  Returns array with suggestions for html and page template.
   *
   * @param array
   *   Suggestion list.
   *
   */
  public function layoutSuggestionsInfo();

  /**
   * Do clean output styles and scripts or don't?.
   *
   * @param bool
   */
  public function cleanAttachmentsInfo();

}