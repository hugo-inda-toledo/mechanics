<?php
namespace App\Crud\Action;

use Crud\Action\BaseAction;
use Crud\Traits\FindMethodTrait;
use Crud\Traits\SerializeTrait;
use Crud\Traits\ViewTrait;
use Crud\Traits\ViewVarTrait;

/**
 * Handles 'Index' Crud actions
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 */
class CustomAction extends BaseAction
{

    use FindMethodTrait;
    use SerializeTrait;
    use ViewTrait;
    use ViewVarTrait;

    /**
     * Default settings for 'index' actions
     *
     * @var array
     */
    protected $_defaultConfig = [
        'enabled' => true,
        'scope' => 'table',
        'findMethod' => 'all',
        'view' => null,
        'viewVar' => null,
        'serialize' => [],
        'api' => [
            'success' => [
                'code' => 200
            ],
            'error' => [
                'code' => 400
            ]
        ]
    ];


    protected function _notFound(Subject $subject)
    {
        $subject->set(['success' => false]);
        $this->_trigger('recordNotFound', $subject);

        $message = $this->message('recordNotFound');
        $exceptionClass = $message['class'];
        throw new $exceptionClass($message['text'], $message['code']);
    }


    protected function _findRecord(Subject $subject)
    {
        $repository = $this->_table();

        $query = $repository->find($this->findMethod());
        //$query->where([current($query->aliasField($repository->primaryKey())) => $id]);

        $subject->set([
            'repository' => $repository,
            'query' => $query
        ]);

        $this->_trigger('beforeFind', $subject);
        $entity = $subject->query->first();

        if (!$entity) {
            return $this->_notFound($id, $subject);
        }

        $subject->set(['entity' => $entity, 'success' => true]);
        $this->_trigger('afterFind', $subject);

        return $entity;
    }

    /**
     * Generic handler for all HTTP verbs
     *
     * @return void
     */
    protected function _handle()
    {

      $query = $this->_table()->find($this->findMethod());
      $items = $this->_controller()->paginate($query);

        // $query = $this->_table()->find($this->findMethod());
        // $subject = $this->_subject(['success' => true, 'query' => $query]);
        //
        // $this->_trigger('beforePaginate', $subject);
        // $items = $this->_controller()->paginate($subject->query);
        // $subject->set(['entities' => $items]);
        //
        // $this->_trigger('afterPaginate', $subject);
        // $this->_trigger('beforeRender', $subject);

        //$subject = $this->_subject();
        //$subject->set(['id' => $id]);

        //$this->_findRecord($subject);
        //$this->_trigger('beforeRender', $subject);

    }
}
