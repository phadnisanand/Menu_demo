<?php
 
namespace Drupal\custom\Form;
 
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\AlertCommand;
use Drupal\Core\Ajax\InvokeCommand;
use Drupal\Core\Ajax\UpdateBuildIdCommand;
 
/**
 * Form: simple submit-form for tutorial.
 */
class TutorialForm extends FormBase {
 
  /**
   * {@inheritDoc}
   *
   * From FormInterface, via FormBase.
   */
  public function getFormId() {
    return 'd8api_tutorial_form';
  }
 
  /**
   * {@inheritDoc}
   *
   * From FormInterface, via FormBase.
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['phone'] = [
      '#type' => 'tel',
      '#title' => $this->t('Your telephone number'),
    ];
    $form['go'] = [
      '#type' => 'submit',
      '#value' => $this->t('Go'),
      '#ajax' => [
        'callback' => 'Drupal\custom\Form\TutorialForm::respondToAjax',
        'event' => 'click',
        'progress' => ['type' => 'throbber', 'message' => NULL],
      ],
    ];
 
    return $form;
  }
 
 
  public function submitForm(array &$form, FormStateInterface $form_state) {
    drupal_set_message(
      $this->t('Ringing @phone', ['@phone' => $form_state->getValue('phone')])
    );
  }
  
   public static function respondToAjax(array $form, FormStateInterface $form_state) {
    $response = new AjaxResponse();
    $message = 'Your phone number is ' . $form_state->getValue('phone');
    $submit_selector = 'form:has(input[name=form_build_id][value='
      . $form['#build_id'] . '])';
    $response->addCommand(new AlertCommand($message));
    $response->addCommand(new UpdateBuildIdCommand($form['#build_id_old'], $form['#build_id']));
    $response->addCommand(new InvokeCommand($submit_selector, 'submit'));
    return $response;
  }
  
}