<?php

namespace Drupal\vajra_revisions\Controller;

use Drupal\Component\Utility\Xss;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Datetime\DateFormatterInterface;
use Drupal\Core\DependencyInjection\ContainerInjectionInterface;
use Drupal\Core\Render\RendererInterface;
use Drupal\Core\Url;
use Drupal\node\NodeStorageInterface;
use Drupal\node\NodeTypeInterface;
use Drupal\node\NodeInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Cache\CacheableDependencyInterface;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityManagerInterface;
use Drupal\Core\Entity\RevisionableInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Language\LanguageManagerInterface;

/**
 * Returns responses for Node routes.
 */
class RevisionsController extends ControllerBase implements ContainerInjectionInterface {

  /**
   * The date formatter service.
   *
   * @var \Drupal\Core\Datetime\DateFormatterInterface
   */
  protected $dateFormatter;

  /**
   * The renderer service.
   *
   * @var \Drupal\Core\Render\RendererInterface
   */
  protected $renderer;

  /**
   * Constructs a NodeController object.
   *
   * @param \Drupal\Core\Datetime\DateFormatterInterface $date_formatter
   *   The date formatter service.
   * @param \Drupal\Core\Render\RendererInterface $renderer
   *   The renderer service.
   */
  public function __construct(DateFormatterInterface $date_formatter, RendererInterface $renderer) {
    $this->dateFormatter = $date_formatter;
    $this->renderer = $renderer;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('date.formatter'),
      $container->get('renderer')
    );
  }


  /**
   * Generates an overview table of older revisions of a node.
   *
   * @param \Drupal\node\NodeInterface $node
   *   A node object.
   *
   * @return array
   *   An array as expected by drupal_render().
   */
  public function revisionOverview($content_type = null,$uid = null, $start_date = null, $end_date = null) {
    $param = \Drupal::request()->query->all();

    $content_type = $param['content_type'];
    $uid = $param['uid'];
    $start_date = $param['start_date'];
    $end_date = $param['end_date'];

   
    // get field data from that user
    //$user_id= $user->get('uid')->value;

    //$nodes =  \Drupal\node\Entity\Node::loadMultiple();
     
     // Getting Nodes with pagination and in sorting order
     $condition = [];
    
    // Setting the Content Type
    if(isset($content_type) && $content_type!='none')
    {
      $condition = array('type' => $content_type);  
    }
    // Setting the Users Id
    if(isset($uid) && $uid!='none' && is_numeric($uid)) {
      $condition = array('uid' => $uid);  
    }

   
    $nids = \Drupal::entityQuery('node')
             ->sort('nid', 'DESC')
              ->pager(4);

    if(!empty($condition)) {
        foreach ($condition as $key => $value) {
          //$value = explode(',',$value));
          $nids->condition($key,$value);
      }
    }
    if(isset($start_date) && $start_date !=null && isset($end_date) && $end_date !=null) {
        
        $start_date = strtotime($start_date);
        $end_date = strtotime($end_date);
        
         $nids->condition('created',$start_date,'>=');
         $nids->condition('created',$end_date,'<=');
    }
      
    $nids =   $nids->execute();
    //var_dump($nids);exit();

    $nodes = \Drupal::entityTypeManager()
      ->getStorage('node')
      ->loadMultiple($nids);


    // loads all nodes from db

    $row_count = 0;
    $rows = [];

    $form =  \Drupal::formBuilder()->getForm('Drupal\vajra_revisions\Form\RevisionForm');
    $build['filter'] = $form;

    $build['#title'] =  $this->t('Revisions List for All Nodes');
    foreach ($nodes as $node) {

      $account = $this->currentUser();
      $langcode = $node->language()->getId();
      $langname = $node->language()->getName();
      $languages = $node->getTranslationLanguages();
      $has_translations = (count($languages) > 1);
      $node_storage = $this->entityManager()->getStorage('node');
      $type = $node->getType();

      $header = [$this->t('Title'),$this->t('Created By'),$this->t('Operations')];

      $revert_permission = (($account->hasPermission("revert $type revisions") || $account->hasPermission('revert all revisions') || $account->hasPermission('administer nodes')) && $node->access('update'));
      $delete_permission = (($account->hasPermission("delete $type revisions") || $account->hasPermission('delete all revisions') || $account->hasPermission('administer nodes')) && $node->access('delete'));


      $default_revision = $node->getRevisionId();

      foreach ($this->getRevisionIds($node, $node_storage) as $vid) {

        /** @var \Drupal\node\NodeInterface $revision */
        $revision = $node_storage->loadRevision($vid);
        // Only show revisions that are affected by the language that is being
        // displayed.

        if ($revision->hasTranslation($langcode) && $revision->getTranslation($langcode)->isRevisionTranslationAffected()) {
          $username = [
            '#theme' => 'username',
            '#account' => $revision->getRevisionUser(),
          ];

          // Use revision link to link to revisions that are not active.
          $date = $this->dateFormatter->format($revision->revision_timestamp->value, 'short');

          if ($vid != $node->getRevisionId()) {
            $link = $this->l($date, new Url('entity.node.revision', ['node' => $node->id(), 'node_revision' => $vid]));
          }
          else {
            $link = $node->link($date);
          }

          $row = [];

          $name = $this->renderer->renderPlain($username);
          $row[] = [
            'data' => [
              '#prefix' => '<em>',
              '#markup' => $node->getTitle() ,
              '#suffix' => '</em>',
            ],
          ];
          $row[] = [
            'data' => [
              '#prefix' => '<em>',
              '#markup' => $name,
              '#suffix' => '</em>',
            ],
          ];

          if ($vid == $default_revision) {
            $row[] = [
              'data' => [
                '#prefix' => '<em>',
                '#markup' => $this->t('Current revision'),
                '#suffix' => '</em>',
              ],
            ];

            $rows[$row_count++] = [
              'data' => $row,
              'class' => ['revision-current'],
            ];
          }
          else {
            $links = [];
            if ($revert_permission) {
              $links['revert'] = [
                'title' => $vid < $node->getRevisionId() ? $this->t('Revert') : $this->t('Set as current revision'),
                'url' => $has_translations ?
                  Url::fromRoute('node.revision_revert_translation_confirm', ['node' => $node->id(), 'node_revision' => $vid, 'langcode' => $langcode]) :
                  Url::fromRoute('node.revision_revert_confirm', ['node' => $node->id(), 'node_revision' => $vid]),
              ];
            }

            if ($delete_permission) {
              $links['delete'] = [
                'title' => $this->t('Delete'),
                'url' => Url::fromRoute('node.revision_delete_confirm', ['node' => $node->id(), 'node_revision' => $vid]),
              ];
            }

            $row[] = [
              'data' => [
                '#type' => 'operations',
                '#links' => $links,
              ],
            ];

            $rows[$row_count++] = $row;
          }
        }
      }
    }

    $build['node_revisions_table'] = [
      '#theme' => 'table',
      '#rows' => $rows,
      '#header' => $header,
      '#attributes' => ['class' => 'node-revision-table'],
    ];

    //$build['pager'] = ['#theme' => 'pager', '#quantity' => '5'];
   
   $build['pager'] = array(
      '#type' => 'pager',
      '#weight' => 10,
    );

    return $build;

  }

  /**
   * Gets a list of node revision IDs for a specific node.
   *
   * @param \Drupal\node\NodeInterface $node
   *   The node entity.
   * @param \Drupal\node\NodeStorageInterface $node_storage
   *   The node storage handler.
   *
   * @return int[]
   *   Node revision IDs (in descending order).
   */
  protected function getRevisionIds(NodeInterface $node, NodeStorageInterface $node_storage) {
    $result = $node_storage->getQuery()
      ->allRevisions()
      ->condition($node->getEntityType()->getKey('id'), $node->id())
      ->sort($node->getEntityType()->getKey('revision'), 'DESC')
      ->pager(50)
      ->execute();
    return array_keys($result);
  }

}
