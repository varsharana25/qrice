<?php



App::uses('AppController', 'Controller');



/**

 * Adminusers Controller

 *

 * @property Adminuser $Adminuser

 * @property PaginatorComponent $Paginator

 * @property SessionComponent $Session

 */

class DeliveryboysController extends AppController {



    /**

     * Components

     *

     * @var array

     */

    public $components = array('Paginator', 'Session');

    public $uses = array('Adminuser', 'Deliveryboy','Order');

    public $layout = 'admin';



    /**

     * AdminIndex

     *

     * @return void

     */

    public function admin_index() {

        $this->checkadmin();

         $status=array("Active","Inactive");
         $conditions['status']=$status;
        if (isset($_REQUEST['s'])) {

            $s = $_REQUEST['s'];

            $conditions['OR'] = array('Deliveryboy.name LIKE' => '%' . $s . '%', 'Deliveryboy.email LIKE' => '%' . $s . '%', 'Deliveryboy.mobile LIKE' => '%' . $s . '%');

        }

        $this->paginate = array('conditions' => $conditions, 'order' => 'Deliveryboy.deliveryboy_id DESC');

        $this->set('deliveryboys', $this->Paginator->paginate('Deliveryboy'));

    }



    public function admin_view($id = NULL) {

        $sessionadmin = $this->checkadmin();

        $deliveryboy = $this->Deliveryboy->find('first', array('conditions' => array('Deliveryboy.deliveryboy_id' => $id)));

        $this->set('deliveryboy', $deliveryboy);

        $orders = $this->Order->find('all', array('conditions' => array('Order.deliveryboy_id' => $id)));
        $this->set('orders', $orders);


    }



    public function admin_delete($id = null) {

        $this->autorender = false;

        if (!$this->Deliveryboy->exists($id)) {

            throw new NotFoundException(__('Deliveryboy Not Found'));

        }

        $this->request->data['Deliveryboy']['deliveryboy_id'] = $id;

        $this->request->data['Deliveryboy']['status'] = 'Trash';

        if ($this->Deliveryboy->save($this->request->data['Deliveryboy'])) {

            $this->Session->setFlash('Deliveryboy deleted successfully!', '', array(''), 'success');

        } else {

            $this->Session->setFlash('Deliveryboy could not be deleted! Please try again later!', '', array(''), 'danger');

        }

        $this->redirect(array('action' => 'index'));

    }



    public function admin_add() {

        $this->layout = 'admin';

        $this->checkadmin();

        if ($this->request->is('post')) {

            $checkemail = $this->Deliveryboy->find('first', array('conditions' => array('email' => $this->request->data['Deliveryboy']['email'], 'status !=' => 'Trash')));

            if (empty($checkemail)) {

                $check = $this->Deliveryboy->find('first', array('conditions' => array('mobile' => $this->request->data['Deliveryboy']['mobile'], 'status !=' => 'Trash')));

                if (empty($check)) {
                    $checkid = $this->Deliveryboy->find('first', array('conditions' => array('deliveryboyid' => $this->request->data['Deliveryboy']['deliveryboyid'], 'status !=' => 'Trash')));

                    if (empty($checkid)) {

                    $this->request->data['Deliveryboy']['password'] = md5($this->request->data['Deliveryboy']['password']);

                    if (!empty($this->request->data['Deliveryboy']['profile']['name'])) {

                        $ext = $this->getFileExtension($this->request->data['Deliveryboy']['profile']['name']);

                        $file = uniqid() . '.' . $ext;

                        move_uploaded_file($this->request->data['Deliveryboy']['profile']['tmp_name'], 'files/deliveryboys/' . $file);

                        $this->request->data['Deliveryboy']['profile'] = $file;

                    } else {

                        $this->request->data['Deliveryboy']['profile'] = '';

                    }

                    $this->request->data['Deliveryboy']['created_date'] = date('Y-m-d H:i:s');

                    $this->Deliveryboy->save($this->request->data['Deliveryboy']);

                    $id = $this->Deliveryboy->getLastInsertID();

                    // $this->Deliveryboy->updateAll(

                    //         array('Deliveryboy.deliveryboyid' => "'DB" . ($id + 1000) . "'"), array('Deliveryboy.deliveryboy_id' => $id)

                    // );

                    $this->Session->setFlash('Deliveryboy added', '', array(''), 'adminsuccess');

                    $this->redirect(array('action' => 'index'));
                } else {

                    $this->Session->setFlash('Userid already exists', '', array(''), 'adminerror');

                }

                } else {

                    $this->Session->setFlash('Mobile number already exists', '', array(''), 'adminerror');

                }

            } else {

                $this->Session->setFlash('Email already exists', '', array(''), 'adminerror');

            }

        }

    }



    public function admin_edit($id = NULL) {

        $this->layout = 'admin';

        $this->checkadmin();

        $deliveryboy = $this->Deliveryboy->find('first', array('conditions' => array('deliveryboy_id' => $id)));

        if ($this->request->is('post')) {

            $check = $this->Deliveryboy->find('first', array('conditions' => array('mobile' => $this->request->data['Deliveryboy']['mobile'], 'deliveryboy_id !=' => $id, 'status !=' => 'Trash')));

            if (empty($check)) {
                $checkid = $this->Deliveryboy->find('first', array('conditions' => array('deliveryboyid' => $this->request->data['Deliveryboy']['deliveryboyid'], 'deliveryboy_id !=' => $id, 'status !=' => 'Trash')));

            if (empty($checkid)) {

                $this->request->data['Deliveryboy']['deliveryboy_id'] = $id;

                if (!empty($this->request->data['Deliveryboy']['password'])) {

                    $this->request->data['Deliveryboy']['password'] = md5($this->request->data['Deliveryboy']['password']);

                }

                if (!empty($this->request->data['Deliveryboy']['profile']['name'])) {

                    $ext = $this->getFileExtension($this->request->data['Deliveryboy']['profile']['name']);

                    $file = uniqid() . '.' . $ext;

                    move_uploaded_file($this->request->data['Deliveryboy']['profile']['tmp_name'], 'files/deliveryboys/' . $file);

                    $this->request->data['Deliveryboy']['profile'] = $file;

                } else {

                    $this->request->data['Deliveryboy']['profile'] = $deliveryboy['Deliveryboy']['profile'];

                }

                $this->request->data['Deliveryboy']['created_date'] = date('Y-m-d H:i:s');

                $this->Deliveryboy->save($this->request->data['Deliveryboy']);

                $this->Session->setFlash('Deliveryboy added', '', array(''), 'adminsuccess');

                $this->redirect(array('action' => 'index'));
            } else {

                $this->Session->setFlash('Deliveryboy id already exists', '', array(''), 'adminsuccess');

                $this->redirect(array('action' => 'index'));

            }

            } else {

                $this->Session->setFlash('Mobile number already exists', '', array(''), 'adminsuccess');

                $this->redirect(array('action' => 'index'));

            }

        }

        $this->request->data['Deliveryboy'] = $deliveryboy['Deliveryboy'];

    }

    public function admin_updatepassword($id=NULL){
        $this->autoRender=false;
        $this->request->data['Deliveryboy']['deliveryboy_id']=$id;
        $this->request->data['Deliveryboy']['password']=md5($this->request->data['Deliveryboy']['password']);
        $this->Session->setFlash('Password updated', '', array(''), 'adminsuccess');
        $this->redirect($this->referer());
    }
    
    public function admin_updatestatus($product_id = NULL, $status = NULL) {
        $this->Deliveryboy->updateAll(
                array('Deliveryboy.status' => "'" . $status . "'"), array('Deliveryboy.deliveryboy_id' => $product_id)
        );
        $this->Session->setFlash('Deliveryboy status updated', '', array(''), 'adminsuccess');
        $this->redirect(array('action' => 'index'));
    }



}

