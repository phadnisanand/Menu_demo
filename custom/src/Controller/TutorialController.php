<?php
 
namespace Drupal\custom\Controller;
 
use Drupal\Core\Controller\ControllerBase;
 
/**
 * Controller: /tutorial/*.
 */
class TutorialController extends ControllerBase {
  /**
   * Controller: index page.
   */
  public function index() {
    return [
      '#type' => 'markup',
      '#markup' => $this->t('This is the tutorial index.'),
    ];
  }
 
  /**
   * Controller: Druplicon page.
   */
  public function subPageForDruplicon() {
    return [
      '#type' => 'markup',
      '#markup' => $this->t('Oh, Druplicon! I know you.'),
    ];
  }
 
  /**
   * Controller: page for anyone who isn't Druplicon.
   */
  public function subPageWithParameter($name) {
    return [
      '#type' => 'markup',
      '#markup' => $this->t('Hello, @name', ['@name' => $name]),
    ];
  }
}