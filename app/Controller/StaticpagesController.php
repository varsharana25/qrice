<?php

App::uses('AppController', 'Controller');

/**
 * Staticpages Controller
 *
 * @property Staticpage $Staticpage
 * @property PaginatorComponent $Paginator
 */
class StaticpagesController extends AppController {

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator', 'Session');
    public $uses = array('Adminuser', 'Staticpage');
    public $layout = 'admin';

    /**
     * admin_index method
     *
     * @return void
     */
    public function admin_index() {
        $this->checkadmin();
        $this->set('pagename', 'Static Pages');
        $this->Staticpage->recursive = 0;
        $conditions = array();
        $this->paginate = array('conditions' => $conditions, 'order' => 'page_id DESC', 'limit' => '10');
        $this->set('staticpages', $this->Paginator->paginate('Staticpage'));
    }

    
    /**
     * admin_edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function admin_edit($id = null) {
        $this->checkadmin();
        $this->set('pagename', 'Update Static Page');
        if (!$this->Staticpage->exists($id)) {
            throw new NotFoundException(__('Invalid staticpage'));
        }
        if ($this->request->is(array('post', 'put'))) {
            $page = $this->Staticpage->find('first', array('conditions' => array('page_id' => $id)));
            $this->request->data['Staticpage']['page_id'] = $id;
            if (!empty($this->request->data['Staticpage']['image']['name'])) {
                $ext = $this->getFileExtension($this->request->data['Staticpage']['image']['name']);
                $img = uniqid() . '.' . $ext;
                move_uploaded_file($this->request->data['Staticpage']['image']['tmp_name'], 'img/' . $img);
                $this->request->data['Staticpage']['image'] = $img;
            } else {
                $this->request->data['Staticpage']['image'] = $page['Staticpage']['image'];
            }
            if ($this->Staticpage->save($this->request->data)) {
                $this->Session->setFlash('The staticpage has been saved!', '', array(''), 'adminsuccess');
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('The staticpage could not be saved. Please, try again.!', '', array(''), 'adminerror');
                return $this->redirect($this->referer());
            }
        }
        $options = array('conditions' => array('Staticpage.' . $this->Staticpage->primaryKey => $id));
        $this->request->data = $this->Staticpage->find('first', $options);
    }

}
