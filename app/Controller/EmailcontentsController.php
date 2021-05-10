<?php

App::uses('AppController', 'Controller');

/**
 * Emailcontents Controller
 *
 * @property Emailcontent $Emailcontent
 * @property PaginatorComponent $Paginator
 */
class EmailcontentsController extends AppController {

    /**
     * Components
     *
     * @var array
     */
    public $uses = array('Adminuser', 'Emailcontent');
    public $components = array('Paginator');
    public $layout = 'admin';

    /**
     * admin_index method
     *
     * @return void
     */
    public function admin_index() {
        $sessionadmin = $this->checkadmin();
        $this->set('pagename', 'Emailcontents');
        $this->set('title', 'Emailcontents');
        $this->Emailcontent->recursive = 0;
        $conditions = array();
        $this->paginate = array('conditions' => $conditions, 'order' => 'emailcontent_id DESC');
        $this->set('emailcontents', $this->Paginator->paginate('Emailcontent'));
    }

    public function admin_edit($id = null) {
        $this->set('pagename', 'Edit Emailcontents');
        $this->set('title', 'Edit Emailcontents');
        $sessionadmin = $this->checkadmin();
        if (!$this->Emailcontent->exists($id)) {
            throw new NotFoundException(__('Invalid emailcontent'));
        }
        if ($this->request->is(array('post', 'put'))) {
            $this->request->data['Emailcontent']['emailcontent_id'] = $id;
            if ($this->Emailcontent->save($this->request->data)) {
                $this->Session->setFlash('<div class="alert alert-block alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button>' . __('The emailcontent has been saved.') . '</div>');
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('<div class="alert alert-block alert-danger"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button>' . __('The emailcontent could not be saved. Please, try again.') . '</div>');
            }
        } else {
            $options = array('conditions' => array('Emailcontent.' . $this->Emailcontent->primaryKey => $id));
            $this->request->data = $this->Emailcontent->find('first', $options);
        }
    }

}
