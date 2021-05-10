<?php

App::uses('AppController', 'Controller');

/**
 * Adminusers Controller
 *
 * @property Adminuser $Adminuser
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class SitesettingsController extends AppController {

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator', 'Session');
    public $uses = array('Adminuser', 'Sitesetting');
    public $layout = 'admin';

    /**
     * AdminIndex
     *
     * @return void
     */
    public function admin_index() {
        $this->checkadmin();
        $this->set('title', 'Settings');
        $setting = $this->Sitesetting->find('first');
        if ($this->request->is('post')) {
            $this->request->data['Sitesetting']['id'] = 1;
            if (!empty($this->request->data['Sitesetting']['logo']['name'])) {
                $ext = $this->getFileExtension($this->request->data['Sitesetting']['logo']['name']);
                $file = uniqid() . '.' . $ext;
                move_uploaded_file($this->request->data['Sitesetting']['logo']['tmp_name'], 'img/' . $file);
                $this->request->data['Sitesetting']['logo'] = $file;
            } else {
                $this->request->data['Sitesetting']['logo'] = $setting['Sitesetting']['logo'];
            }
            if (!empty($this->request->data['Sitesetting']['fav_icon']['name'])) {
                $ext = $this->getFileExtension($this->request->data['Sitesetting']['fav_icon']['name']);
                $file = uniqid() . '.' . $ext;
                move_uploaded_file($this->request->data['Sitesetting']['fav_icon']['tmp_name'], 'img/' . $file);
                $this->request->data['Sitesetting']['fav_icon'] = $file;
            } else {
                $this->request->data['Sitesetting']['fav_icon'] = $setting['Sitesetting']['fav_icon'];
            }
            $this->Sitesetting->save($this->request->data);
            $this->Session->setFlash('Sitesettings Saved successfully!', '', array(''), 'adminsuccess');
            $this->redirect(array("controller" => "sitesettings", "action" => "index"));
        }
        $result = $this->Sitesetting->find('first', array('conditions' => array('id' => '1')));
        $this->set('result', $result);
    }

    public function admin_contactus() {
        $this->checkadmin();
        $this->set('title', 'Settings');
        $setting = $this->Sitesetting->find('first');
        if ($this->request->is('post')) {
            $this->request->data['Sitesetting']['id'] = 1;
            $this->Sitesetting->save($this->request->data);
            $this->Session->setFlash('Settings Saved successfully!', '', array(''), 'adminsuccess');
            $this->redirect(array("controller" => "sitesettings", "action" => "contactus"));
        }
        $settings = $this->Sitesetting->find('first', array('conditions' => array('id' => '1')));
        $this->set('settings', $settings);
    }

    public function admin_cms() {
        $this->checkadmin();
        $this->set('title', 'Settings');
        $setting = $this->Sitesetting->find('first');
        if ($this->request->is('post')) {
            $this->request->data['Sitesetting']['id'] = 1;
            $this->Sitesetting->save($this->request->data);
            $this->Session->setFlash('Settings Saved successfully!', '', array(''), 'adminsuccess');
            $this->redirect(array("controller" => "sitesettings", "action" => "cms"));
        }
        $settings = $this->Sitesetting->find('first', array('conditions' => array('id' => '1')));
        $this->set('settings', $settings);
    }

}
