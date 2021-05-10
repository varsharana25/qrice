<?php

App::uses('AppController', 'Controller');

/**
 * Categories Controller
 *
 * @property Productcategory $Productcategory
 * @property PaginatorComponent $Paginator
 */
class ProductsubcategoriesController extends AppController {

    /**
     * Components
     *
     * @var array
     */
    public $uses = array('Adminuser', 'Productsubcategory','Productcategory');
    public $components = array('Paginator');
    public $layout = 'admin';

    /**
     * admin_index method
     *
     * @return void
     */
    public function admin_index() {
        $sessionadmin = $this->checkadmin();
        $this->set('pagename', 'Subcategories');
        $this->Productsubcategory->recursive = 0;
        if (!empty($_REQUEST['s'])) {
            $s = $_REQUEST['s'];
            $conditions = array('name LIKE' => "%$s%");
        }
        $conditions['status'] = 'Active';
        $this->paginate = array('conditions' => $conditions, 'order' => 'prosubcategory_id DESC');
        $this->set('productsubcategories', $this->Paginator->paginate('Productsubcategory'));
    }

    public function admin_add() {
        $sessionadmin = $this->checkadmin();
        $this->set('pagename', 'Add Productsubcategory');
        if ($this->request->is('post')) {
            $check = $this->Productsubcategory->find('first', array('conditions' => array('name' => $this->request->data['Productsubcategory']['name'], 'status !=' => 'Trash')));
            if (empty($check)) {            
                $this->request->data['Productsubcategory']['parent_id'] = $this->request->data['Productsubcategory']['parent_id']; 
                $this->Productsubcategory->save($this->request->data['Productsubcategory']);
                $this->Session->setFlash('Productsubcategory added', '', array(''), 'adminsuccess');
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Productsubcategory already exists', '', array(''), 'adminerror');
            }
        }
        $productcategories = $this->Productcategory->find('all', array('conditions' => array('status' => 'Active', 'parent_id' => '0')));
        $this->set('productcategories', $productcategories);
    }

    public function admin_edit($id = null) {
        $sessionadmin = $this->checkadmin();
        $this->set('pagename', 'Edit Productsubcategory');
        $result = $this->Productsubcategory->find('first', array('conditions' => array('prosubcategory_id' => $id)));
        if ($this->request->is('post')) {
            $check = $this->Productsubcategory->find('first', array('conditions' => array('name' => $this->request->data['Productsubcategory']['name'], 'status !=' => 'Trash', 'prosubcategory_id !=' => $id)));
            if (empty($check)) {
                $this->request->data['Productsubcategory']['prosubcategory_id'] = $id;
                $this->Productsubcategory->save($this->request->data['Productsubcategory']);
                $this->Session->setFlash('Productsubcategory updated', '', array(''), 'adminsuccess');
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Productsubcategory already exists', '', array(''), 'adminerror');
            }
        }
        $productcategories = $this->Productcategory->find('all', array('conditions' => array('status' => 'Active', 'parent_id' => '0')));
        $this->set('productcategories', $productcategories);
        $this->set('result', $result);
        $this->request->data['Productsubcategory'] = $result['Productsubcategory'];
    }

    public function admin_delete($id = null) {
        $sessionadmin = $this->checkadmin();
        $this->Productsubcategory->id = $id;
        if (!$this->Productsubcategory->exists()) {
            throw new NotFoundException(__('Invalid category'));
        }
        $this->Productsubcategory->updateAll(
                array('Productsubcategory.status' => "'Trash'"), array('Productsubcategory.prosubcategory_id' => $id)
        );
        $this->Session->setFlash('Productsubcategory deleted', '', array(''), 'adminsuccess');
        return $this->redirect(array('action' => 'index'));
    }

    public function ajaxSubcategory($id = NULL) {
        $this->autoRender = false;
        $subcategoies = $this->Productsubcategory->find('all', array('conditions' => array('parent_id' => $id)));
        $html = '<option value="">[--Select Sub category--]</option>';
        foreach ($subcategoies as $subcategory) {
            $html.='<option value="' . $subcategory['Productsubcategory']['prosubcategory_id'] . '">' . $subcategory['Productsubcategory']['name'] . '</option>';
        }
        echo $html;
        exit;
    }

}
