<?php

App::uses('AppController', 'Controller');

/**
 * Category Controller
 *
 * @property Category $Category
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class CategoriesController extends AppController {

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator', 'Session');
    public $uses = array('Adminuser', 'Sitesetting', 'Product', 'Category');
    public $layout = 'admin';

    /**
     * AdminIndex
     *
     * @return void
     */
    public function admin_index() {
        $this->layout = 'admin';
        $this->Category->recursive = 0;
        $this->checkadmin();
        $conditions = array('status !=' => 'Trash');
        if (isset($_REQUEST['s'])) {
            $s = $_REQUEST['s'];
            $conditions['OR'] = array('name LIKE' => '%' . $s . '%');
        }
        $this->paginate = array('conditions' => $conditions, 'order' => 'catorder ASC');
        $this->set('categories', $this->Paginator->paginate('Category'));
    }

    public function admin_edit($id = null) {
        $this->checkadmin();
        if (!$this->Category->exists($id)) {
            throw new NotFoundException(__('Invalid Category'));
        }
        $category = $this->Category->find('first', array('conditions' => array('category_id' => $id)));
        if ($this->request->is(array('post', 'put'))) {
            $this->request->data['Category']['category_id'] = $id;
            if (!empty($this->request->data['Category']['image']['name'])) {
                $file = rand(0, 99999) . $this->request->data['Category']['image']['name'];
                move_uploaded_file($this->request->data['Category']['image']['tmp_name'], 'files/categoryimages/' . $file);
                $this->request->data['Category']['image'] = $file;
            } else {
                $this->request->data['Category']['image'] = $category['Category']['image'];
            }
            $this->Category->save($this->request->data['Category']);
            $this->Session->setFlash('Category updated successfully ', '', array(''), 'success');
            return $this->redirect(array('action' => 'index'));
        }
        $this->request->data['Category'] = $category['Category'];
    }

}
