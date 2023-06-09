<?php
include_once 'views/forms_doc.php';

class ContactDoc extends FormsDoc {
    private function showForm() {
        $this->showFormStart('contact');
        $this->showFormField('title', 'Aanhef:', 'select', array('dhr' => 'Dhr', 'mvr' => 'Mvr', 'other' => 'Anders'));
        $this->showFormField('name', 'Naam:', 'text');
        $this->showFormField('email', 'E-mail:', 'email');
        $this->showFormField('telefoon', 'Telefoonnummer:', 'text'); 
        $this->showFormField('favcontact', 'Hoe wilt u gecontacteerd worden?', 'radio', array('telefoon' => 'Telefonisch', 'mail' => 'E-mail'));
        $this->showFormField('comment', 'Opmerking:', 'textarea');
        $this->showFormButton('Versturen', 'contact');
        $this->showFormEnd('contact');
    }
    protected function showHeader()
    {
        echo '<h1>Contact opnemen?</h1>';
    }

    protected function showContent() {
        $this->showForm();
    }
}