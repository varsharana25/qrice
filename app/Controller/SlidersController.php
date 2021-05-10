<?php

App::uses('AppController', 'Controller');

/**
 * Sliders Controller
 *
 * @property Slider $Slider
 * @property PaginatorComponent $Paginator
 */
class SlidersController extends AppController {

    /**
     * Components
     *
     * @var array
     */
    public $uses = array('Adminuser', 'Slider');
    public $components = array('Paginator');
    public $layout = 'admin';

    /**
     * admin_index method
     *
     * @return void
     */
    public function admin_index() {
        $sessionadmin = $this->checkadmin();
        $this->set('pagename', 'Sliders');
        $this->Slider->recursive = 0;
        $conditions = array();
        $this->paginate = array('conditions' => $conditions, 'order' => 'slider_id DESC');
        $this->set('sliders', $this->Paginator->paginate('Slider'));
    }

    public function admin_add() {
        $sessionadmin = $this->checkadmin();
        $this->set('pagename', 'Add Slider');
        if ($this->request->is('post')) {
            if (!empty($this->request->data['Slider']['image']['name'])) {
                $ext = $this->getFileExtension($this->request->data['Slider']['image']['name']);
                $img = uniqid() . '.' . $ext;
                move_uploaded_file($this->request->data['Slider']['image']['tmp_name'], 'files/sliders/' . $img);
                $this->request->data['Slider']['image'] = $img;
            } else {
                $this->request->data['Slider']['image'] = '';
            }
            $this->Slider->save($this->request->data['Slider']);
            $this->Session->setFlash('Slider added', '', array(''), 'adminsuccess');
            return $this->redirect(array('action' => 'index'));
        }
    }

    public function admin_edit($id = null) {
        $sessionadmin = $this->checkadmin();
        $this->set('pagename', 'Edit Slider');
        $result = $this->Slider->find('first', array('conditions' => array('slider_id' => $id)));
        if ($this->request->is('post')) {
            if (!empty($this->request->data['Slider']['image']['name'])) {
                $ext = $this->getFileExtension($this->request->data['Slider']['image']['name']);
                $img = uniqid() . '.' . $ext;
                move_uploaded_file($this->request->data['Slider']['image']['tmp_name'], 'files/sliders/' . $img);
                $this->request->data['Slider']['image'] = $img;
            } else {
                $this->request->data['Slider']['image'] = $result['Slider']['image'];
            }
            $this->request->data['Slider']['slider_id'] = $id;
            $this->Slider->save($this->request->data['Slider']);
            $this->Session->setFlash('Updated', '', array(''), 'adminsuccess');
            return $this->redirect(array('action' => 'index'));
        }
        $this->request->data['Slider'] = $result['Slider'];
    }

    public function admin_delete($id = null) {
        $sessionadmin = $this->checkadmin();
        $this->Slider->id = $id;
        if (!$this->Slider->exists()) {
            throw new NotFoundException(__('Invalid slider'));
        }
        $this->Slider->delete($id);
        $this->Session->setFlash('Slider deleted', '', array(''), 'adminsuccess');
        return $this->redirect(array('action' => 'index'));
    }

}
