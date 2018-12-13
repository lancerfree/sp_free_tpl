<?php

namespace Drupal\sp_free_tpl\Plugin;

use Drupal\Component\Plugin\PluginBase;
use Drupal\Core\StringTranslation\StringTranslationTrait;

/**
 * Class TplPluginBase.
 */
abstract class TplPluginBase extends PluginBase implements TplInterface {

  use StringTranslationTrait;

  /**
   * Name this module.
   */
  const module_name = 'sp_free_tpl';

  /**
   * Path to parent folder relative drupal root.
   *
   * @var string
   */
  protected $pathParentRoot;

  /**
   * Path to parent folder relative module.
   *
   * @var
   */
  protected $pathParentModule;

  /**
   * Name Class or filename.
   *
   * @var string
   */
  protected $pluginFileName;

  /**
   * Path relative module to resources.
   *
   * @var string
   */
  protected $libraryResourcePath;

  /**
   * Path relative drupal root to resources.
   *
   * @var string
   */
  protected $templateResourcePath;

  /**
   * Path to host module.
   *
   * @var string
   */
  protected $modulePath;

  /**
   * TplPluginBase constructor.
   *
   * @param array $configuration
   * @param string $plugin_id
   * @param mixed $plugin_definition
   *
   * @throws
   */
  public function __construct(array $configuration, string $plugin_id, array $plugin_definition) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    if (!isset($this->pathParentModule)) {
      // will be created all properties there
      $this->buildPathProperty((new \ReflectionClass(static::class))->getFileName());
    }
  }

  /**
   * Returns plugin file name.
   *
   * @return string
   */
  public function getPluginFileName() {
    return $this->pluginFileName;
  }

  /**
   * Returns path to parent folder relative drupal root.
   *
   * @return string
   */
  public function getPathRelativeRoot() {
    return $this->pathParentRoot;
  }

  /**
   * Returns path to resource folder relative module.
   *
   * @return mixed
   */
  public function getLibrariesPath() {
    return $this->libraryResourcePath;
  }

  /**
   * Returns path to templates folder relative drupal root.
   *
   * @return mixed
   */
  public function getTemplatesPath() {
    return $this->templateResourcePath;
  }

  /**
   * Returns path to host module.
   *
   * @return string
   */
  public function getModulePath() {
    return $this->modulePath;
  }

  /**
   * Builds all paths once for specific plugin.
   *
   * @param $caller_path
   *
   * @throws \Exception
   * @throws \ReflectionException
   */
  private function buildPathProperty($caller_path) {
    $caller_path = (new \ReflectionClass(static::class))->getFileName();
    $root_part = DRUPAL_ROOT;
    $root_part_len = strlen($root_part);
    $ps_root_part = strpos($caller_path, $root_part);
    $module_part = '/' . static::module_name . '/';
    $module_part_len = strlen($module_part);
    $ps_module_part = strpos($caller_path, $module_part);
    $pos_last_slash = strrpos($caller_path, '/');
    $this->pluginFileName = substr($caller_path, $pos_last_slash + 1, -4);
    if ($ps_root_part === FALSE) {
      throw new \Exception("Plugin path must have drupal root in the path!");
    }
    if ($ps_module_part === FALSE) {
      throw new \Exception("Plugin path must have module name in the path!");
    }
    $pos_after_occurance_root = $ps_root_part + $root_part_len + 1;
    $this->pathParentRoot = substr($caller_path, $pos_after_occurance_root, $pos_last_slash - $pos_after_occurance_root);
    $pos_after_occurance_module = $ps_module_part + $module_part_len;
    $this->pathParentModule = substr($caller_path, $pos_after_occurance_module, $pos_last_slash - $pos_after_occurance_module );
    $this->libraryResourcePath = $this->pathParentModule . '/' . $this->pluginFileName;
    $this->templateResourcePath = $this->pathParentRoot . '/' . $this->pluginFileName;
    // Without last slash.
    $this->modulePath = substr($caller_path, $pos_after_occurance_root, $pos_after_occurance_module - $pos_after_occurance_root - 1);

  }

  /**
   * Returns id plugin.
   *
   * @return string
   */
  public function getId() {
    return $this->pluginDefinition['id'];
  }

  /**
   * Gets theme for current route.
   *
   * @return string
   */
  public function getTheme() {
    $method_theme = $this->themeInfo();
    if ($method_theme) {
      return $method_theme;
    }
    $annotation_theme = $this->getCustomDefinition('theme');
    return $annotation_theme;
  }

  /**
   * Gets merged routes from annotation and methods.
   *
   * @return array
   */
  public function getRoutes() {
    $annotation_routes = $this->getCustomDefinition('routes');
    $method_routes = $this->routeInfo();
    $result_routes = $annotation_routes + $method_routes;
    return $result_routes;
  }

  /**
   * Gets merged routes from annotation and methods.
   *
   * @return array
   */
  public function getLibraries() {
    $annotation_libraries = $this->getCustomDefinition('libraries');
    $method_libraries = $this->libraryInfo();
    $result_libraries = $annotation_libraries + $method_libraries;
    return $result_libraries;
  }

  /**
   * @param $def_name
   *   Name property.
   *
   * @return mixed
   */
  public function getCustomDefinition($def_name) {
    return $this->pluginDefinition[$def_name];
  }

  /**
   * Gets array prepared for hook_theme function.
   *
   * @return array|mixed
   */
  public function getTemplates() {
    $annotate_templates = $this->getCustomDefinition('templates');
    $method_templates = $this->templateInfo();
    $result_templates = $annotate_templates + $method_templates;
    foreach ($result_templates AS $rt_key => &$rt_value) {

      $rt_value['path'] = $this->getTemplatesPath();
      if(!empty($rt_value['folder_name'])){
        $rt_value['path'] .='/'.$rt_value['folder_name'];
      }
    }
    return $result_templates;
  }

  /**
   * {@inheritdoc}
   */
  public function routeInfo() {
    return [];
  }

  /**
   * {@inheritdoc}
   */
  public function libraryInfo() {
    return [];
  }

  /**
   * {@inheritdoc}
   */
  public function templateInfo() {
    return [];
  }

  /**
   * {@inheritdoc}
   */
  public function themeInfo() {
    return [];
  }

  /**
   * {@inheritdoc}
   */
  public function layoutSuggestionsInfo() {
    return [];
  }

  /**
   * {@inheritdoc}
   */
  public function cleanAttachmentsInfo() {
    return FALSE;
  }

}
