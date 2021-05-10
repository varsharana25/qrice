<?php

App::uses('AppController', 'Controller');

/**
 * Faqs Controller
 *
 * @property Faq $Faq
 * @property PaginatorComponent $Paginator
 */
class FaqsController extends AppController {

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator', 'Session');
    public $uses = array('Adminuser', 'Faq');
    public $layout = 'admin';

    /**
     * admin_index method
     *
     * @return void
     */
    public function admin_index() {
        $this->checkadmin();
        $this->set('pagename', 'Faqs');
        $this->Faq->recursive = 0;
        $conditions = array();
        $this->paginate = array('conditions' => $conditions, 'order' => 'faq_id DESC');
        $this->set('faqs', $this->Paginator->paginate('Faq'));
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
        $this->set('pagename', 'Update Faq');
        if (!$this->Faq->exists($id)) {
            throw new NotFoundException(__('Invalid faq'));
        }
        if ($this->request->is(array('post', 'put'))) {
            $this->request->data['Faq']['faq_id'] = $id;
            if ($this->Faq->save($this->request->data)) {
                $this->Session->setFlash('The faq has been saved!', '', array(''), 'adminsuccess');
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('The faq could not be saved. Please, try again.!', '', array(''), 'adminerror');
                return $this->redirect($this->referer());
            }
        }
        $options = array('conditions' => array('Faq.' . $this->Faq->primaryKey => $id));
        $this->request->data = $this->Faq->find('first', $options);
    }

    /**
     * admin_edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function admin_add() {
        $this->checkadmin();
        $this->set('pagename', 'Add Faq');
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Faq->save($this->request->data)) {
                $this->Session->setFlash('The faq has been saved!', '', array(''), 'adminsuccess');
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('The faq could not be saved. Please, try again.!', '', array(''), 'adminerror');
                return $this->redirect($this->referer());
            }
        }
    }

    public function admin_delete($id = null) {
        $this->checkadmin();
        $this->set('pagename', 'Delete Faq');
        if (!$this->Faq->exists($id)) {
            throw new NotFoundException(__('Invalid faq'));
        }
        $this->Faq->delete($id);
        $this->Session->setFlash('The faq has been deleted!!', '', array(''), 'adminsuccess');
        return $this->redirect($this->referer());
    } 

}
