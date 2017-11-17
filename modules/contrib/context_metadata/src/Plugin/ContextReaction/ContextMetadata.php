<?php

namespace Drupal\context_metadata\Plugin\ContextReaction;

use Drupal\context\ContextReactionPluginBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a content reaction that adds a Metadata.
 *
 * @ContextReaction(
 *   id = "context_metadata",
 *   label = @Translation("Context Metadata")
 * )
 */
class ContextMetadata extends ContextReactionPluginBase {

  /**
   * {@inheritdoc}
   */
  public function buildConfigurationForm(array $form, FormStateInterface $form_state) {
    $form['metadata_title'] = array(
      '#title' => $this->t('Meta Title'),
      '#description' => $this->t('Title goes here'),
      '#type' => 'textfield',
      '#maxlength' => 256,
      '#default_value' => $this->getConfiguration()['metadata_title'],
    );

    $form['metadata_description'] = array(
      '#title' => $this->t('Meta Description'),
      '#description' => $this->t('Meta Description'),
      '#type' => 'textfield',
      '#maxlength' => 400,
      '#default_value' => $this->getConfiguration()['metadata_description'],
    );

    $form['metadata_keywords'] = array(
      '#title' => $this->t('Meta Keywords'),
      '#description' => $this->t('Meta Keywords'),
      '#type' => 'textfield',
      '#maxlength' => 400,
      '#default_value' => $this->getConfiguration()['metadata_keywords'],
    );

    $form['metadata_canonical_url'] = array(
      '#title' => $this->t('Canonical URL'),
      '#description' => $this->t('Canonical URL'),
      '#type' => 'textfield',
      '#maxlength' => 400,
      '#default_value' => $this->getConfiguration()['metadata_canonical_url'],
    );

    // TODO: Add this once we have other metadata working.
    /*$form['metadata_h1_title'] = array(
      '#title' => $this->t('H1 tag'),
      '#description' => $this->t('Overrides the H1 title'),
      '#type' => 'textfield',
      '#maxlength' => 400,
      '#default_value' => $this->getConfiguration()['metadata_h1_title'],
    );*/

    // TODO: Add this once we have other metadata working.
    /*$form['metadata_robots'] = array(
      '#title' => $this->t('Robots'),
      '#description' => $this->t('Robots'),
      '#type' => 'textfield',
      '#maxlength' => 400,
      '#default_value' => $this->getConfiguration()['metadata_robots'],
    );*/

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitConfigurationForm(array &$form, FormStateInterface $form_state) {
    $this->setConfiguration([
      'metadata_title' => $form_state->getValue('metadata_title'),
      'metadata_description' => $form_state->getValue('metadata_description'),
      'metadata_keywords' => $form_state->getValue('metadata_keywords'),
      'metadata_canonical_url' => $form_state->getValue('metadata_canonical_url'),
      // TODO: 'metadata_h1_title' => $form_state->getValue('metadata_h1_title'),
      // TODO: 'metadata_robots' => $form_state->getValue('metadata_robots'),
    ]);
  }

  /**
   * {@inheritdoc}
   */
  public function summary() {
    return $this->getConfiguration()['context_metadata'];
  }

  /**
   * {@inheritdoc}
   */
  public function defaultConfiguration() {
    return parent::defaultConfiguration() + [
      'metadata_title' => '',
      'metadata_description' => '',
      'metadata_keywords' => '',
      'metadata_canonical_url' => '',
      // TODO: 'metadata_h1_title' => '',
      // TODO: 'metadata_robots' => '',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function execute(array &$vars = []) {
    $config = $this->getConfiguration();
    return $config;
  }

}
