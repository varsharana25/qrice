<?php

App::uses('AppController', 'Controller');

/**
 * Categories Controller
 *
 * @property Brand $Brand
 * @property PaginatorComponent $Paginator
 */
class BrandsController extends AppController {

    /**
     * Components
     *
     * @var array
     */
    public $uses = array('Adminuser', 'Brand');
    public $components = array('Paginator');
    public $layout = 'admin';

    /**
     * admin_index method
     *
     * @return void
     */
    public function admin_index() {
        $sessionadmin = $this->checkadmin();
        $this->set('pagename', 'Brands');
        $this->Brand->recursive = 0;
        if (!empty($_REQUEST['s'])) {
            $s = $_REQUEST['s'];
            $conditions = array('name LIKE' => "%$s%");
        }
        $conditions['status'] = 'Active';
        $this->paginate = array('conditions' => $conditions, 'order' => 'brand_id DESC');
        $this->set('brands', $this->Paginator->paginate('Brand'));
    }

    public function admin_add() {
        $sessionadmin = $this->checkadmin();
        $this->set('pagename', 'Add Brand');
        if ($this->request->is('post')) {
            $check = $this->Brand->find('first', array('conditions' => array('name' => $this->request->data['Brand']['name'], 'status !=' => 'Trash')));
            if (empty($check)) {
                if (!empty($this->request->data['Brand']['image']['name'])) {
                    $logo = rand(0, 9999) . $this->request->data['Brand']['image']['name'];
                    move_uploaded_file($this->request->data['Brand']['image']['tmp_name'], 'files/brands/' . $logo);
                    $this->request->data['Brand']['image'] = $logo;
                } else {
                    $this->request->data['Brand']['image'] = "";
                }
                $this->Brand->save($this->request->data['Brand']);
                $this->Session->setFlash('Brand added', '', array(''), 'adminsuccess');
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Brand already exists', '', array(''), 'adminerror');
            }
        }
    }

    public function admin_edit($id = null) {
        $sessionadmin = $this->checkadmin();
        $this->set('pagename', 'Edit Brand');
        $result = $this->Brand->find('first', array('conditions' => array('brand_id' => $id)));
        if ($this->request->is('post')) {
            $check = $this->Brand->find('first', array('conditions' => array('name' => $this->request->data['Brand']['name'], 'status !=' => 'Trash', 'brand_id !=' => $id)));
            if (empty($check)) {
                if (!empty($this->request->data['Brand']['image']['name'])) {
                    $logo = rand(0, 9999) . $this->request->data['Brand']['image']['name'];
                    move_uploaded_file($this->request->data['Brand']['image']['tmp_name'], 'files/brands/' . $logo);
                    $this->request->data['Brand']['image'] = $logo;
                } else {
                    $this->request->data['Brand']['image'] = $result['Brand']['image'];
                }
                $this->request->data['Brand']['brand_id'] = $id;
                $this->Brand->save($this->request->data['Brand']);
                $this->Session->setFlash('Brand updated', '', array(''), 'adminsuccess');
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Brand already exists', '', array(''), 'adminerror');
            }
        }
        $this->set('result', $result);
        $this->request->data['Brand'] = $result['Brand'];
    }

    public function admin_delete($id = null) {
        $sessionadmin = $this->checkadmin();
        $this->Brand->id = $id;
        if (!$this->Brand->exists()) {
            throw new NotFoundException(__('Invalid category'));
        }
        $this->Brand->updateAll(
                array('Brand.status' => "'Trash'"), array('Brand.brand_id' => $id)
        );
        $this->Session->setFlash('Brand deleted', '', array(''), 'adminsuccess');
        return $this->redirect(array('action' => 'index'));
    }

}
