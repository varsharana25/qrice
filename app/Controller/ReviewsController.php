<?php

App::uses('AppController', 'Controller');

/**
 * Contects Controller
 *
 * @property Contect $Contect
 * @property PaginatorComponent $Paginator
 */
class ReviewsController extends AppController {

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator', 'Session');
    public $uses = array('Adminuser', 'Review', 'Emailcontent', 'Sitesetting');
    public $layout = 'admin';

    /**
     * admin_index method
     *
     * @return void
     */
    public function admin_index() {
        $this->checkadmin();
        $this->Review->recursive = 0;
        $conditions = array();
        if (!empty($_REQUEST['s'])) {
            $s = $_REQUEST['s'];
            $conditions['OR'] = array('text LIKE' => "%$s%");
        }
        $this->paginate = array('conditions' => $conditions, 'order' => 'review_id DESC');
        $this->set('reviews', $this->Paginator->paginate('Review'));
    }

    /**
     * admin_delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function admin_delete($id = null) {
        $this->autorender = false;
        $this->checkadmin();
        if (!$this->Review->exists($id)) {
            throw new NotFoundException(__('Review Not Found'));
        }
        $this->request->data['Review']['review_id'] = $id;
        if ($this->Review->delete($id)) {
            $this->Session->setFlash('Review deleted successfully!', '', array(''), 'success');
        } else {
            $this->Session->setFlash('Review could not be deleted! Please try again later!', '', array(''), 'danger');
        }
        $this->redirect(array('action' => 'index'));
    }

    public function admin_updatestatus($id = null) {
        $this->autorender = false;
        $review = $this->Review->find('first', array('conditions' => array('review_id' => $id)));
        $review['Review']['review_status'] = ($review['Review']['review_status'] == 'Approved') ? 'Unapproved' : 'Approved';
        $this->Review->save($review['Review']);

        $this->Session->setFlash('Review status updated successfully!', '', array(''), 'success');
        $this->redirect(array('action' => 'index'));
    }

}
