<?php

namespace Drupal\sp_free_tpl\Plugin\TplPlugins;

use \Drupal\sp_free_tpl\Plugin\TplPluginBase;
use Symfony\Component\HttpFoundation\Response;

/**
 * @TplAnnotation(
 *   id="sp_free_tpl_free_air_template",
 * )
 */
class AirOnePage extends TplPluginBase {

  /**
   * {@inheritdoc}
   */
  public function templateInfo() {
    $path_to_resource_folder = $this->getTemplatesPath();

    $tpl_list = [
      'html__air',
      'page__air',
      'header_air' => 'header_air',
      'footer_air' => 'footer_air',
      'slider_air' => 'slider_air',
    ];

    $theme = [];
    // Access to resource path.
    foreach ($tpl_list as $index => $tl_value) {
      if (is_int($index)) {
        $template_called = $tl_value;
      }
      else {
        $template_called = $index;
        $theme[$template_called]['template'] = $tl_value;
      }

      $theme[$template_called]['folder_name'] = 'templates';
      $theme[$template_called]['variables']['resource'] = $path_to_resource_folder;
    }

    $theme['html__air']['base hook'] = 'html';
    $theme['page__air']['base hook'] = 'page';

    return $theme;
  }

  /**
   * {@inheritdoc}
   */
  public function routeInfo() {
    return [
      'sp_free_tpl_free_air_template' => [
        'templates/free-air-template',
        ['_title' => 'Free Air Template'],
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
  public function getPluginContent($param_name = '') {
    $content = [];
    $content['#children'] = $this->t('Some text dad');
    $content['#cache']['max-age'] = 0;
    $content['#attached']['library'][] = 'sp_free_tpl/air-one-page';
    return $content;
  }

  /**
   * Returns an array of destination fields.
   */
  public function libraryInfo() {
    $lib_folder = $this->getLibrariesPath();

    $libraries = [];
    $libraries['air-one-page'] = [
      'version' => '1.x',
      'js' => [
        // Core
        $lib_folder . '/vendor/jquery.min.js' => ['minified' => TRUE,],
        $lib_folder . '/vendor/jquery-migrate.min.js' => ['minified' => TRUE,],
        $lib_folder . '/vendor/bootstrap/js/bootstrap.min.js' => ['minified' => TRUE,],
        // Plugins
        $lib_folder . '/vendor/jquery.easing.js' => ['minified' => TRUE,],
        $lib_folder . '/vendor/jquery.back-to-top.js' => ['minified' => TRUE,],
        $lib_folder . '/vendor/jquery.smooth-scroll.js' => ['minified' => TRUE,],
        $lib_folder . '/vendor/jquery.wow.min.js' => ['minified' => TRUE,],
        $lib_folder . '/vendor/swiper/js/swiper.jquery.min.js' => ['minified' => TRUE,],
        $lib_folder . '/vendor/magnific-popup/jquery.magnific-popup.min.js' => ['minified' => TRUE,],
        $lib_folder . '/vendor/masonry/jquery.masonry.pkgd.min.js' => ['minified' => TRUE,],
        $lib_folder . '/vendor/masonry/imagesloaded.pkgd.min.js' => ['minified' => TRUE,],
        'https://maps.googleapis.com/maps/api/js?key=AIzaSyBsXUGTFS09pLVdsYEE9YrO2y4IAncAO2U&amp;callback=initMap' => [
          'type' => 'external',
          'minified' => TRUE,
          'attributes' => [
            'async' => "async",
            'defer' => "defer",
          ],
        ],
        // Custom
        $lib_folder . '/js/layout.min.js' => ['minified' => TRUE,],
        $lib_folder . '/js/components/wow.min.js' => ['minified' => TRUE,],
        $lib_folder . '/js/components/swiper.min.js' => ['minified' => TRUE,],
        $lib_folder . '/js/components/maginific-popup.min.js' => ['minified' => TRUE,],
        $lib_folder . '/js/components/masonry.min.js' => ['minified' => TRUE,],
        $lib_folder . '/js/components/gmap.min.js' => ['minified' => TRUE,],

      ],
      'css' => [
        'base' => [
          // Core
          'http://fonts.googleapis.com/css?family=Hind:300,400,500,600,700' => [
            'type' => 'external',
            'minified' => 'true',
          ],
          $lib_folder . '/vendor/simple-line-icons/css/simple-line-icons.css' => [],
          $lib_folder . '/vendor/bootstrap/css/bootstrap.min.css' => ['minified' => 'true'],
          // Plugins
          $lib_folder . '/css/animate.css' => [],
          $lib_folder . '/vendor/swiper/css/swiper.min.css' => ['minified' => 'true'],
          $lib_folder . '/vendor/magnific-popup/magnific-popup.css' => [],
        ],
        'theme' => [
          $lib_folder . '/css/layout.min.css' => ['minified' => 'true'],
        ],
      ],
    ];

    return $libraries;
  }

  /**
   * {@inheritdoc}
   */
  function layoutSuggestionsInfo() {
    // Overide html and page templates.
    return [
      'html' => 'html__air',
      'page' => 'page__air',
    ];
  }

  /**
   * {@inheritdoc}
   */
  function cleanAttachmentsInfo() {
    // Native Drupal scripts are not needed.
    return TRUE;
  }

}