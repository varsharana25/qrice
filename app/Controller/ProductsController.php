<?php
App::uses('AppController', 'Controller');
/**
 * Adminusers Controller
 *
 * @property Adminuser $Adminuser
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class ProductsController extends AppController {
    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator', 'Session');
    public $uses = array('Adminuser', 'Product', 'Productcategory', 'Productvariation', 'Brand','Productsubcategory','Pincode');
    public $layout = 'admin';
    public function admin_index($type = NULL) {
        $this->layout = 'admin';
        $vendor = $this->checkadmin();
        $conditions = array('Product.status !=' => 'Trash');
        $this->paginate = array('joins' => array(
                array(
                    'table' => 'tbl_productcategories',
                    'alias' => 'Productcategory',
                    'type' => 'INNER',
                    'conditions' => array(
                        'Productcategory.procategory_id = Product.category_id'
                    )
                )
            ), 'fields' => array('Product.*', 'Productcategory.*'), 'conditions' => $conditions, 'order' => 'Product.product_id DESC');

        $this->set('products', $this->Paginator->paginate('Product'));
        $categories = $this->Productcategory->find('all', array('conditions' => array('status' => 'Active', 'parent_id' => '0')));
        $this->set('categories', $categories);
        $brands = $this->Brand->find('all', array('conditions' => array('status' => 'Active')));
        $this->set('brands', $brands);
    }
    public function admin_add() {
        $this->layout = 'admin';
        $admin = $this->checkadmin();
        if ($this->request->is('post')) {
            $this->request->data['Product']['created_date'] = date('Y-m-d H:i:s');
            if (!empty($this->request->data['Product']['image']['name'])) {
                $logo = rand(0, 9999) . $this->request->data['Product']['image']['name'];
                move_uploaded_file($this->request->data['Product']['image']['tmp_name'], 'files/products/' . $logo);
                $this->request->data['Product']['image'] = $logo;
            } else {
                $this->request->data['Product']['image'] = '';
            }
            $this->request->data['Product']['pincode'] = implode(',',$this->request->data['Product']['pincode']);
            $this->request->data['Product']['datetime'] = date('Y-m-d H:i:s');
            $this->Product->save($this->request->data['Product']);
            $product_id = $this->Product->getLastInsertID();
            $this->Session->setFlash('Product Added successfully!', '', array(''), 'success');
            $this->redirect(array('action' => 'index'));
        }
        $categories = $this->Productcategory->find('all', array('conditions' => array('status' => 'Active', 'parent_id' => '0')));
        $this->set('categories', $categories);
        $brands = $this->Brand->find('all', array('conditions' => array('status' => 'Active')));
        $this->set('brands', $brands);
    }
    public function ajaxSubcategory($id = NULL) {
        $this->autoRender = false;
        $subcategories = $this->Productcategory->find('all', array('conditions' => array('parent_id' => $id)));
        $data = '';
        foreach ($subcategories as $subcategory) {
            $data .= '<option value="' . $subcategory['Productcategory']['procategory_id'] . '">' . $subcategory['Productcategory']['name'] . '</option>';
        }
        echo $data;
        exit;
    }
    public function admin_edit($product_id = NULL) {
        $this->layout = 'admin';
        $admin = $this->checkadmin();
        $product = $this->Product->find('first', array('conditions' => array('product_id' => $product_id)));
        if ($this->request->is('post')) {
            $this->request->data['Product']['created_date'] = date('Y-m-d H:i:s');
            if (!empty($this->request->data['Product']['image']['name'])) {
                $logo = rand(0, 9999) . $this->request->data['Product']['image']['name'];
                move_uploaded_file($this->request->data['Product']['image']['tmp_name'], 'files/products/' . $logo);
                $this->request->data['Product']['image'] = $logo;
            } else {
                $this->request->data['Product']['image'] = $product['Product']['image'];
            }
            $this->request->data['Product']['pincode'] = implode(',',$this->request->data['Product']['pincode']);
            $this->request->data['Product']['product_id'] = $product_id;
            $this->request->data['Product']['datetime'] = date('Y-m-d H:i:s');
            $this->Product->save($this->request->data['Product']);
           
            $this->Session->setFlash('Product Updated successfully!', '', array(''), 'vendorsuccess');
            if(!empty($_REQUEST['stock']) && $_REQUEST['stock']=='instock'){
                $this->redirect(array('action' => 'instock'));    
            }elseif(!empty($_REQUEST['stock']) && $_REQUEST['stock']=='outof'){
                $this->redirect(array('action' => 'outofstock'));    
            }elseif(!empty($_REQUEST['stock']) && $_REQUEST['stock']=='low'){
                $this->redirect(array('action' => 'lowstock'));    
            }
            $this->redirect(array('action' => 'index'));
        }
        $categories = $this->Productcategory->find('all', array('conditions' => array('status' => 'Active', 'parent_id' => '0')));
        $this->set('categories', $categories);
        $subcategories = $this->Productcategory->find('all', array('conditions' => array('status' => 'Active', 'parent_id' => $product['Product']['category_id'])));
        $this->set('subcategories', $subcategories);
        $subcategories = $this->Productsubcategory->find('all', array('conditions' => array('status' => 'Active', 'parent_id' => $product['Product']['category_id'])));
        $this->set('subcategories', $subcategories);
        $brands = $this->Brand->find('all', array('conditions' => array('status' => 'Active')));
        $this->set('brands', $brands);
        $this->set('product', $product);
        $this->request->data['Product'] = $product['Product'];
    }
    public function admin_delete($id = NULL) {
        $this->autoRender = false;
        $this->Product->updateAll(
                array('Product.status' => "'Trash'"), array('Product.product_id' => $id)
        );
        $this->Session->setFlash('Product Deleted', '', array(''), 'adminsuccess');
        $this->redirect(array('action' => 'index'));
    }
    public function admin_updatestatus($product_id = NULL, $status = NULL) {
        $this->Product->updateAll(
                array('Product.status' => "'" . $status . "'"), array('Product.product_id' => $product_id)
        );
        $this->Session->setFlash('Product status updated', '', array(''), 'adminsuccess');
        $this->redirect(array('action' => 'index'));
    }
    public function admin_view($product_id = NULL) {
        $this->layout = 'admin';
        $admin = $this->checkadmin();
        $product = $this->Product->find('first', array('conditions' => array('product_id' => $product_id)));
        $categories = $this->Productcategory->find('all', array('conditions' => array('status' => 'Active', 'parent_id' => '0')));
        $this->set('categories', $categories);
        $subcategories = $this->Productcategory->find('all', array('conditions' => array('status' => 'Active', 'parent_id' => $product['Product']['category_id'])));
        $this->set('subcategories', $subcategories);
                $subcategories = $this->Productsubcategory->find('all', array('conditions' => array('status' => 'Active', 'parent_id' => $product['Product']['category_id'])));
        $this->set('subcategories', $subcategories);
        $brands = $this->Brand->find('all', array('conditions' => array('status' => 'Active')));
        $this->set('brands', $brands);
        $this->set('product', $product);
        $this->request->data['Product'] = $product['Product'];
    }
    public function admin_instock() {
        $this->layout = 'admin';
        $vendor = $this->checkadmin();
        $conditions = array('Product.status !=' => 'Trash');
        $conditions['inventory_value >'] = '0';
        $this->paginate = array('joins' => array(
                array(
                    'table' => 'tbl_productcategories',
                    'alias' => 'Productcategory',
                    'type' => 'INNER',
                    'conditions' => array(
                        'Productcategory.procategory_id = Product.category_id'
                    )
                )
            ), 'fields' => array('Product.*', 'Productcategory.*'), 'conditions' => $conditions, 'order' => 'Product.product_id DESC', 'limit' => '50');
        $this->set('products', $this->Paginator->paginate('Product'));
        $categories = $this->Productcategory->find('all', array('conditions' => array('status' => 'Active', 'parent_id' => '0')));
        $this->set('categories', $categories);
        $brands = $this->Brand->find('all', array('conditions' => array('status' => 'Active')));
        $this->set('brands', $brands);
    }

    public function admin_outofstock() {
        $this->layout = 'admin';
        $vendor = $this->checkadmin();
        $conditions = array('Product.status !=' => 'Trash');
        $conditions['inventory_value <='] = '0';
        $this->paginate = array('joins' => array(
                array(
                    'table' => 'tbl_productcategories',
                    'alias' => 'Productcategory',
                    'type' => 'INNER',
                    'conditions' => array(
                        'Productcategory.procategory_id = Product.category_id'
                    )
                )
            ), 'fields' => array('Product.*', 'Productcategory.*'), 'conditions' => $conditions, 'order' => 'Product.product_id DESC', 'limit' => '50');
        $this->set('products', $this->Paginator->paginate('Product'));
        $categories = $this->Productcategory->find('all', array('conditions' => array('status' => 'Active', 'parent_id' => '0')));
        $this->set('categories', $categories);
        $brands = $this->Brand->find('all', array('conditions' => array('status' => 'Active')));
        $this->set('brands', $brands);
    }

    public function admin_lowstock() {
        $this->layout = 'admin';
        $vendor = $this->checkadmin();
        $conditions = array('Product.status !=' => 'Trash');
        $conditions[]="`inventory_value` <= `lowstock_value`";
        $conditions['inventory_value >'] = '0';
        $this->paginate = array('joins' => array(
                array(
                    'table' => 'tbl_productcategories',
                    'alias' => 'Productcategory',
                    'type' => 'INNER',
                    'conditions' => array(
                        'Productcategory.procategory_id = Product.category_id'
                    )
                )
            ), 'fields' => array('Product.*', 'Productcategory.*'), 'conditions' => $conditions, 'order' => 'Product.product_id DESC', 'limit' => '50');
        $this->set('products', $this->Paginator->paginate('Product'));
        $categories = $this->Productcategory->find('all', array('conditions' => array('status' => 'Active', 'parent_id' => '0')));
        $this->set('categories', $categories);
        $brands = $this->Brand->find('all', array('conditions' => array('status' => 'Active')));
        $this->set('brands', $brands);
    }
}
