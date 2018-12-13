<?php

namespace Drupal\sp_free_tpl\Plugin\TplPlugins;

use \Drupal\sp_free_tpl\Plugin\TplPluginBase;
use Symfony\Component\HttpFoundation\Response;

/**
 * @TplAnnotation(
 *   id="sp_free_tpl_example_polo360",
 * )
 */
class ExamplePolo360 extends TplPluginBase {

  /**
   * {@inheritdoc}
   */
  public function templateInfo() {
    // get paths info from parent  methods.
    $path_to_resource_folder = $this-> getTemplatesPath();
    $path_module = $this-> getModulePath();
    $path_libs = $path_module . '/libraries';

    $tpl_list = [
      'articles',
      'contacts',
      'footer',
      'header',
      'home',
      'slide_show',
      'polo360__html',
    ];

    $theme = [];
    // Access to resource path.
    foreach ($tpl_list as $tl_value) {
      $theme[$tl_value]['variables']['resource_path'] = $path_to_resource_folder;
    }
    // Needed for add library.
    $theme['home']['variables']['libraries_path'] = $path_libs;

    return $theme;
  }

  /**
   * {@inheritdoc}
   */
  public function routeInfo() {
    return [
      'sp_free_tpl_polo360' => [
        'templates/polo360',
        ['_title' => 'Polo360']
      ],
    ];
  }

  /**
   * Route callback.
   *
   * @param string $param_name
   *
   * @return array|Response
   */
  function layoutSuggestionsInfo() {
    // Overide html page
    return [
      'html'=> 'polo360__html'
    ];
  }

  /**
   * Route callback.
   *
   * @param string $param_name
   *
   * @return array|Response
   */
  public function getPluginContent($param_name = '') {
    $page = ['#theme' => 'home'];

    $html_content = \Drupal::service('renderer')->render($page);
    $response = new Response();
    $response->setContent($html_content);

    return $response;
  }



}