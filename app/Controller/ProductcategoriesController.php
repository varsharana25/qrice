<?php
App::uses('AppController', 'Controller');
/**
 * Categories Controller
 *
 * @property Productcategory $Productcategory
 * @property PaginatorComponent $Paginator
 */
class ProductcategoriesController extends AppController {
    /**
     * Components
     *
     * @var array
     */
    public $uses = array('Adminuser', 'Productcategory','Productsubcategory');
    public $components = array('Paginator');
    public $layout = 'admin';
    /**
     * admin_index method
     *
     * @return void
     */
    public function admin_index() {
        $sessionadmin = $this->checkadmin();
        $this->set('pagename', 'Categories');
        $this->Productcategory->recursive = 0;
        if (!empty($_REQUEST['s'])) {
            $s = $_REQUEST['s'];
            $conditions = array('name LIKE' => "%$s%");
        }
        $conditions['status'] = 'Active';
        $this->paginate = array('conditions' => $conditions, 'order' => 'procategory_id DESC');
        $this->set('productcategories', $this->Paginator->paginate('Productcategory'));
    }
    public function admin_add() {
        $sessionadmin = $this->checkadmin();
        $this->set('pagename', 'Add Productcategory');
        if ($this->request->is('post')) {
            $check = $this->Productcategory->find('first', array('conditions' => array('name' => $this->request->data['Productcategory']['name'], 'status !=' => 'Trash')));
            if (empty($check)) {
                if (empty($this->request->data['Productcategory']['parent_id'])) {
                    $this->request->data['Productcategory']['parent_id'] = '0';
                }
                if (!empty($this->request->data['Productcategory']['image']['name'])) {
                    $logo = rand(0, 9999) . $this->request->data['Productcategory']['image']['name'];
                    move_uploaded_file($this->request->data['Productcategory']['image']['tmp_name'], 'files/category/' . $logo);
                    $this->request->data['Productcategory']['image'] = $logo;
                } else {
                    $this->request->data['Productcategory']['image'] = '';
                }
                $this->Productcategory->save($this->request->data['Productcategory']);
                $this->Session->setFlash('Productcategory added', '', array(''), 'adminsuccess');
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Productcategory already exists', '', array(''), 'adminerror');
            }
        }
        $productcategories = $this->Productcategory->find('all', array('conditions' => array('status' => 'Active', 'parent_id' => '0')));
        $this->set('productcategories', $productcategories);
    }
    public function admin_edit($id = null) {
        $sessionadmin = $this->checkadmin();
        $this->set('pagename', 'Edit Productcategory');
        $result = $this->Productcategory->find('first', array('conditions' => array('procategory_id' => $id)));
        if ($this->request->is('post')) {
            $check = $this->Productcategory->find('first', array('conditions' => array('name' => $this->request->data['Productcategory']['name'], 'status !=' => 'Trash', 'procategory_id !=' => $id)));
            if (empty($check)) {
                if (!empty($this->request->data['Productcategory']['image']['name'])) {
                    $logo = rand(0, 9999) . $this->request->data['Productcategory']['image']['name'];
                    move_uploaded_file($this->request->data['Productcategory']['image']['tmp_name'], 'files/category/' . $logo);
                    $this->request->data['Productcategory']['image'] = $logo;
                } else {
                    $this->request->data['Productcategory']['image'] = $result['Productcategory']['image'];
                }
                $this->request->data['Productcategory']['procategory_id'] = $id;
                $this->Productcategory->save($this->request->data['Productcategory']);
                $this->Session->setFlash('Productcategory updated', '', array(''), 'adminsuccess');
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Productcategory already exists', '', array(''), 'adminerror');
            }
        }
        $productcategories = $this->Productcategory->find('all', array('conditions' => array('status' => 'Active', 'parent_id' => '0', 'procategory_id !=' => $result['Productcategory']['procategory_id'])));
        $this->set('productcategories', $productcategories);
        $this->set('result', $result);
        $this->request->data['Productcategory'] = $result['Productcategory'];
    }
    public function admin_delete($id = null) {
        $sessionadmin = $this->checkadmin();
        $this->Productcategory->id = $id;
        if (!$this->Productcategory->exists()) {
            throw new NotFoundException(__('Invalid category'));
        }
        $this->Productcategory->updateAll(
                array('Productcategory.status' => "'Trash'"), array('Productcategory.procategory_id' => $id)
        );
        $this->Productsubcategory->updateAll(
                array('Productsubcategory.status' => "'Trash'"), array('Productsubcategory.parent_id' => $id)
        );
        $this->Session->setFlash('Productcategory deleted', '', array(''), 'adminsuccess');
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
