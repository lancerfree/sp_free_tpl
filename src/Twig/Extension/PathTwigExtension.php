<?php


namespace Drupal\sp_free_tpl\Twig\Extension;


class PathTwigExtension extends \Twig_Extension {


  /**
   * {@inheritdoc}
   */
  public function getFunctions() {
    $functions = [];

    $functions[] = new \Twig_SimpleFunction('pdir', [$this,"parentDir"]);

    return $functions;
  }

  /**
   *  Remove words in twig extensions
   *
   * @param string
   *    String for  remove words
   * @return array
   *   Array with words to remove
   */
   public function parentDir($path, int $level = 2) {
    $return_path = '';
    $ars = explode('/',$path);
    for($i=1;$i<=$level;$i++){
     array_pop($ars);
    }

    if($ars){
      $return_path = implode('/',$ars);
    }


    return $return_path;
  }

  public function getName() {
    return 'sp_free_tpl.parent_dir_name';
  }


}