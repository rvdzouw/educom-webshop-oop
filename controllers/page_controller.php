<?php

require_once ('models/page_model.php');


class PageController {
    private $model;
    private $modelFactory;
    
    public function __construct($modelFactory) {
        $this->model = new PageModel(NULL);
        $this->modelFactory = $modelFactory;
    }

    public function handleRequest() {
        $this->getRequest();
        $this->processRequest();
        $this->showResponsePage();
    }
    
    private function getRequest() {
        $this->model->getRequestedPage();
    }

    private function showResponsePage() {
        $this->model->createMenu();
        $view = NULL;

        switch ($this->model->page) {
            case 'home' :
                require_once ('views/home_doc.php');
                $view = new HomeDoc($this->model);
                break;
            case 'about' :
                require_once ('views/about_doc.php');
                $view = new AboutDoc($this->model);
                break;
            case 'login' :
                require_once ('views/login_doc.php');
                $view = new LoginDoc($this->model);
                break;
            case 'register' :
                require_once ('views/register_doc.php');
                $view = new RegisterDoc($this->model);
                break;
            case 'changepassword' :
                require_once ('views/change_pass_doc.php');
                $view = new ChangePassDoc($this->model);
                break;
            case 'contact' :
                require_once ('views/contact_doc.php');
                $view = new ContactDoc($this->model);
                break;
            case 'thanks' :
                require_once('views/thanks_doc.php');
                $view = new ThanksDoc($this->model);
                break;
            case 'webshop' :
                require_once ('views/webshop_doc.php');
                $view = new WebshopDoc($this->model);
                break;
            case 'detail' :
                require_once ('views/detail_doc.php');
                $view = new DetailDoc($this->model);
                break;
            case 'shoppingcart' :
                require_once ('views/cart_doc.php');
                $view = new CartDoc($this->model);
                break;
        }
        if (!empty($view)) {
            $view->show();
        }
    }

    


    private function processRequest() {
        switch($this->model->page) {
            case 'login' :
                require_once 'models/user_model.php';
                $this->modelFactory->pageModel = $this->model;
                $this->model = $this->modelFactory->createModel('user');
                $this->model->validateLogin();
                if($this->model->valid) {
                    $this->model->doLoginUser();
                    $this->model->setPage('home');
                }
                break;
            case 'logout' :
                require_once 'models/user_model.php';
                $this->modelFactory->pageModel = $this->model;
                $this->model = $this->modelFactory->createModel('user');
                $this->model->doLogoutuser();
                $this->model->setPage('home');
                break;
            case 'contact':
                require_once 'models/user_model.php';
                $this->modelFactory->pageModel = $this->model;
                $this->model = $this->modelFactory->createModel('user');
                $this->model->validateContact();
                if ($this->model->valid) {
                    $this->model->setPage('thanks'); 
                }
                break;
            case 'register' :
                require_once 'models/user_model.php';
                $this->modelFactory->pageModel = $this->model;
                $this->model = $this->modelFactory->createModel('user');
                $this->model->validateRegister();
                if ($this->model->valid) {
                    $this->model->StoreUser();  
                    $this->model->setPage('login');
                }    
                break;
            case 'changepassword':
                require_once 'models/user_model.php';
                $this->modelFactory->pageModel = $this->model;
                $this->model = $this->modelFactory->createModel('user');
                $this->model->validateChangePass();
                if ($this->model->valid) {
                    $this->model->ChangePass();
                    $this->model->setPage('home');
                }
                break;
            case 'webshop':
                require_once 'models/shop_model.php';
                $this->modelFactory->pageModel = $this->model;
                $this->model = $this->modelFactory->createModel('webshop');
                $this->model->handleAction();
                $this->model->getProducts();
                break;
            case 'detail':
                require_once 'models/shop_model.php';
                $this->modelFactory->pageModel = $this->model;
                $this->model = $this->modelFactory->createModel('webshop');
                $this->model->handleAction();
                $this->model->getDetailVar();
                break;
            case 'shoppingcart' :
                require_once 'models/shop_model.php';
                $this->modelFactory->pageModel = $this->model;
                $this->model = $this->modelFactory->createModel('webshop');
                $this->model->handleAction();
                $this->model->getCartContent();
                break;            
        }
    }
}


?>