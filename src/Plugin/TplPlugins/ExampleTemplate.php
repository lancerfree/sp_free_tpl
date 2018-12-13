<?php

namespace Drupal\sp_free_tpl\Plugin\TplPlugins;

use \Drupal\sp_free_tpl\Plugin\TplPluginBase;

/**
 * @TplAnnotation(
 *   id="sp_free_tpl_example_template",
 *   routes={
 *     "sp_free_tpl_example_template"={
 *       "example/template",
 *       {"_title"="Example Template"}
 *     }
 *   }
 * )
 */
class ExampleTemplate extends TplPluginBase {

  /**
   * {@inheritdoc}
   */
  public function templateInfo() {
    $theme = [];

    $theme['example-template'] = [
      'variables' => [
        'hello_message' => NULL,
      ],
    ];

    return $theme;
  }

  /**
   * {@inheritdoc}
   */
  public function themeInfo() {
    return '';
  }


  /**
   * Route callback.
   *
   * @param string $param_name
   *
   * @return array
   */
  public function getPluginContent($param_name = '') {

    return [
      '#theme' => 'example-template',
      '#hello_message' => $this->t('Hello world!')
    ];
  }

}