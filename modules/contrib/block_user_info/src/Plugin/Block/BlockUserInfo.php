<?php

namespace Drupal\block_user\Plugin\Block;

use Drupal\Core\Link;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Session\AccountProxyInterface;
use Drupal\Core\Routing\CurrentRouteMatch;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Entity\EntityTypeManager;
use Drupal\Core\Entity\EntityDisplayRepositoryInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides a block to display 'Site branding' elements.
 *
 * @Block(
 *   id = "block_user_info",
 *   admin_label = @Translation("User Info Block")
 * )
 */
class BlockUserInfo extends BlockBase implements ContainerFactoryPluginInterface {

  /**
   * Stores an entity type manager instance.
   *
   * @var \Drupal\Core\Entity\EntityTypeManager
   */
  protected $entityTypeManager;

  /**
   * The entity storage for User entity type.
   *
   * @var \Drupal\Core\Entity\EntityStorageInterface;
   */
  protected $userStorage;

  /**
   * Stores an user view builder instance.
   *
   * @var \Drupal\Core\Entity\EntityViewBuilderInterface
   */
  protected $userViewBuilder;

  /**
   * Stores the current request.
   *
   * @var \Drupal\Core\Routing\CurrentRouteMatch
   */
  protected $routeMatch;

  /**
   * Stores the current node.
   *
   * @var \Drupal\node\Entity\Node
   */
  protected $currentNode;

  /**
   * Stores the current logged in user or anonymous account.
   *
   * @var \Drupal\Core\Session\AccountProxyInterface
   */
  protected $currentAccount;

  /**
   * Stores the current user.
   *
   * @var \Drupal\user\Entity\User
   */
  protected $currentUser;

  /**
   * Stores the default view mode to be used in render array.
   *
   * @var string
   */
  protected $defaultViewMode = 'compact';

  /**
   * Stores a list of existing view mode for user entity.
   *
   * @var array
   */
  protected $userViewModes;

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('entity_type.manager'),
      $container->get('entity_display.repository'),
      $container->get('current_user'),
      $container->get('current_route_match')
    );
  }

  /**
   * Creates a BLockUserInfo instance.
   *
   * @param array $configuration
   *   A configuration array containing information about the plugin instance.
   * @param string $plugin_id
   *   The plugin_id for the plugin instance.
   * @param mixed $plugin_definition
   *   The plugin implementation definition.  
   * @param \Drupal\Core\Entity\EntityTypeManager $entity_type_manager
   *   An instance of the entity type manager.
   * @param \Drupal\Core\Session\AccountProxyInterface $current_account
   *   An instance of the current logged in user or anonymous account.
   * @param \Drupal\Core\Routing\CurrentRouteMatch $current_route_match
   *   The current request.
   */
  public function __construct(
    array $configuration,
    $plugin_id,
    $plugin_definition,
    EntityTypeManager $entity_type_manager,
    EntityDisplayRepositoryInterface $entity_display_repository,
    AccountProxyInterface $current_account,
    CurrentRouteMatch $current_route_match
  ) {
    // Get default values.
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    
    // Get user entity tools.
    $this->entityTypeManager = $entity_type_manager;
    $this->userStorage = $entity_type_manager->getStorage('user');
    $this->userViewBuilder = $this->entityTypeManager->getViewBuilder('user');
    $this->userViewModes = $entity_display_repository->getViewModeOptions('user');

    // Get current node.
    $this->routeMatch = $current_route_match;
    $this->currentNode = $this->routeMatch->getParameter('node');

    // Get user info.
    $this->currentAccount = $current_account;
    $this->currentUser = $this->userStorage->load($this->currentAccount->id());
  }

  /**
   * {@inheritdoc}
   */
  public function defaultConfiguration() {
    return [
      'label_display' => TRUE,
      'target' => 'current',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function blockForm($form, FormStateInterface $form_state) {
    $form = parent::blockForm($form, $form_state);

    // Prepare form texts.
    $url_add_view_mode = Link::createFromRoute(
      $this->t('add a new view mode here'),
      'entity.entity_view_mode.add_form',
      ['entity_type_id' => 'user']
    );
    $url_account_display = Link::createFromRoute(
      $this->t('edit displayed fields there'),
      'entity.entity_view_display.user.default'
    );
    $description = $this->t('Select which display mode this block should use.');
    $help = $this->t('You can') . ' ' . $url_add_view_mode->toString() . ' ' . $this->t('and') . ' ' . $url_account_display->toString();

    // Load referenced users entities.
    $user_default_value = $this->getReferencedUsers();

    // Build form.
    $form['userinfo'] = array(
      '#type' => 'fieldset',
      '#title' => $this->t('Settings'),
    );
    $form['userinfo']['view_mode'] = array(
      '#type' => 'select',
      '#options' => $this->userViewModes,
      '#title' => $this->t('Select a display mode'),
      '#description' => $description . '<br />' . $help,
      '#default_value' => isset($this->configuration['view_mode']) ? $this->configuration['view_mode'] : $this->defaultViewMode,
    );
    $form['userinfo']['target'] = array(
      '#type' => 'radios',
      '#options' => [
        'current' => 'Current user',
        'author' => 'Node author',
        'users' => 'Specific user(s)',
      ],
      '#title' => $this->t("Select user(s) to be retrieved"),
      '#default_value' => isset($this->configuration['target']) ? $this->configuration['target'] : FALSE,
    );
    $form['userinfo']['user'] = array(
      '#type' => 'entity_autocomplete',
      '#target_type' => 'user',
      '#selection_settings' => ['include_anonymous' => FALSE],
      '#default_value' => $user_default_value ? $user_default_value : NULL,
      '#tags' => TRUE,
      '#title' => $this->t('Targeted user'),
      '#description' => $this->t("Select which user(s) profile this block should display."),
      '#states' => array(
        'visible' => array(
          array(
            array(':input[name="settings[userinfo][target]"]' => array('value' => 'users')),
            'or',
            array(':input[name="settings[userinfo][target]"]' => array('value' => 'multiple')),
          ),
        ),
        'required' => array(
          array(
            array(':input[name="settings[userinfo][target]"]' => array('value' => 'users')),
            'or',
            array(':input[name="settings[userinfo][target]"]' => array('value' => 'multiple')),
          ),
        ),
      ),
    );
    $form['extra']['class'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Custom CSS class'),
      '#description' => $this->t('Use this field to add extra CSS classes to this block.'),
      '#default_value' => isset($this->configuration['class']) ? $this->configuration['class'] : NULL,
    );
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state) {
    // Save configurations keys/values.
    $userinfo = $form_state->getValue('userinfo');
    // Empty the entity_autcomplete field.
    if (isset($userinfo['target']) && $userinfo['target'] != 'users') {
      $userinfo['user'] = NULL;
    }
    foreach ($userinfo as $key => $value) {
      $this->configuration[$key] = $value;
    }

    // Save extra configurations keys/values.
    $extra = $form_state->getValue('extra');
    foreach ($extra as $key => $value) {
      $this->configuration[$key] = $value;
    }
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    $build = [];
    $users = [];

    // Get correct users.
    switch ($this->configuration['target']) {
      case 'current':
        $users[] = $this->currentUser;
        break;

      case 'author':
        $users[] = $this->getNodeAuthor();
        break;

      case 'users':
        // Replace $users array.
        $users = $this->getReferencedUsers();
        break;
    }

    // Get viewmode.
    $view_mode = isset($this->configuration['view_mode']) ? $this->configuration['view_mode'] : $this->defaultViewMode;

    // Populate renderable array.
    foreach ($users as $user) {
      if ($user) {
        $build[] = $this->userViewBuilder->view($user, $view_mode);
      }
    }

    // Set correct cache contexts and tags.
    $this->setCacheContexts($build);
    $this->setCacheTags($build);

    // Add extra CSS class.
    if (isset($this->configuration['class'])) {
      $build['#attributes']['class'][] = $this->configuration['class'];
    }

    return $build;
  }

  /**
   * Load referenced users.
   *
   * @return bool|array
   *   An array of loaded user entities.
   */
  protected function getReferencedUsers() {
    $uids = [];
    if (!isset($this->configuration['user'])) {
      $uids[] = (int) $this->currentUser->id();
    }
    else {
      foreach ($this->configuration['user'] as $ref) {
        if (isset($ref['target_id'])) {
          $uids[] = (int) $ref['target_id'];
        }
      }
    }
    return $this->userStorage->loadMultiple($uids);
  }

  /**
   * Load current node's author.
   *
   * @return bool|array
   *   An array a loaded user entity.
   */
  protected function getNodeAuthor() {
    $node = $this->currentNode;
    $uid = $node ? $node->getOwnerId() : FALSE;
    return $uid ? $this->userStorage->load($uid) : FALSE;
  }

  /**
   * Set correct cache contexts.
   *
   * @param array $build
   *   A renderable array passed by reference.
   */
  protected function setCacheContexts(array &$build) {
    switch ($this->configuration['target']) {
      case 'author':
        $build['#cache']['contexts'][] = 'url.path';
        break;

      default:
        $build['#cache']['contexts'][] = 'user';
        break;
    }
  }

  /**
   * Set correct cache tags.
   *
   * @param array $build
   *   A renderable array passed by reference.
   */
  protected function setCacheTags(array &$build) {
    switch ($this->configuration['target']) {
      case 'author':
        $nid = (NULL != $this->currentNode) ? $this->currentNode->id() : FALSE;
        if ($nid) {
          $build['#cache']['tags'][] = 'node:' . $nid;
        }
        break;

      default:
        $uid = (NULL != $this->currentUser) ? $this->currentUser->id() : FALSE;
        if ($uid) {
          $build['#cache']['tags'] = ['user:' . $uid];
        }
        break;
    }
  }

}
