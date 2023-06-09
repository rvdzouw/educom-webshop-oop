<?php

function showFormStart($field) {
    echo '<form method="post" action="index.php" id="'.$field.'">';
}
function showFormField($field, $label, $type, $data, $options = array(), $rows = NULL, $cols = NULL, $onChange=NULL) {

  echo '<label for="' . $field . '">' . $label . ' </label><br>' . PHP_EOL;
        if ($type == "select"){
            echo '<' . $type . ' id="' . $field . '" name="' . $field . '" ' . (empty($onChange) ? '' : 'onchange="' . $onChange . '"'). '>' . PHP_EOL;
            foreach($options as $key => $title) {
                echo '<option value="' . $key .'"'; if (isset($data[$field]) && $data[$field] == "$key") echo "selected"; echo'>' . $title . '</option>' . PHP_EOL;
            }   echo '</select>' . PHP_EOL;            
            showError($field, $data);
        }   
        
        else if ($type == "radio") {
            foreach ($options as $key => $contactoptions) {
                echo  '<input type="radio" id="' . $field . $key . '" name="' . $field . '"'; if (isset($data[$field]) && $data[$field] == "$key") echo "checked"; echo' value="' . $key . '" > 
                <label for="' . $field . $key . '">' . $contactoptions . '</label><br>';
            }
            showError($field, $data);
        } 
        
        else if ($type == "textarea") {
            echo '<textarea name ="' . $field . '" rows="' . $rows . '" cols="' . $cols . '">' . $data[$field] . '</textarea><br><br>';
            showError($field, $data);
        }
        else if ($type == "number") {
            echo '<br><input type="number" id="'.$field.'" name ="' . $field . '" value="'.$data[$field].'" min="' . $rows . '" max="' . $cols . '" onchange="' .$onChange. '">';
            
        } else {
            echo '<input type="' . $type . '"id="' . $field . '" name="' . $field . '" value="' . $data[$field] . '"><br>' . PHP_EOL;
            showError($field, $data);
        }
}

function showError($field, $data) {
    if (array_key_exists($field."Err", $data)) {
        echo '<span class="error"> ' . $data['' . $field . 'Err'] . ' </span><br>' . PHP_EOL;
    }
}

function showFormButton($submitButton, $action) {
    
    echo '<input type="submit" name="' . $action . '" value="' . $submitButton . '">';
}

function showFormEnd($page) {
    echo '<br><input name="page" value="' . $page . '" type="hidden">';
    echo '</form>'; 
}

function showRegisterForm($data) { /* register form */

    showFormStart('register');
    showFormField('email', 'E-mail:', 'email', $data);
    showFormField('name', 'Naam:' , 'text', $data);
    showFormField('password', 'Wachtwoord:', 'password', $data);
    showFormField('repeatpassword', 'Herhaal Wachtwoord', 'password', $data);
    showFormButton('Registreren', 'action');
    showFormEnd($data['page']);    
}

function showContactForm($data) { /* contact form */
    
    // define('TITLE_OPTIONS', array("dhr" => 'Dhr', "mvr" =>  'Mvr', "OTHER" => 'Anders')); 
    // define('CONTACT_OPTIONS', array("telefoon" => 'per Telefoon', "mail" => 'per E-mail')); 
    
    showFormStart('contact');
    showFormField('title', 'Aanhef', 'select', $data, TITLE_OPTIONS);
    showFormField('name', 'Naam:', 'text', $data);
    showFormField('email', 'E-mail:', 'email', $data);
    showFormField('telefoon', 'Telefoonnummer', 'text', $data);
    showFormField('favcontact', 'Hoe wilt u gecontacteerd worden?', 'radio', $data, CONTACT_OPTIONS);
    showFormField('comment', 'Beschrijf in het kort de reden van contact:', 'textarea', $data);
    showFormButton('Versturen' , 'action');
    showFormEnd($data['page']);
}

function showLoginForm($data) {
    showFormStart('login');
    showFormField('email', 'E-mail', 'text', $data);
    showFormField('password', 'Wachtwoord', 'password', $data);
    showFormButton('Login', 'action');
    showFormEnd($data['page']);
}

function showChangePassForm($data) {
    showFormStart('changepass');
    showFormField('password', 'Huidig wachtwoord:', 'password', $data);
    showFormField('newpassword', 'Nieuw wachtwoord:', 'password', $data);
    showFormField('repeatnewpassword', 'Herhaal uw nieuwe wachtwoord:', 'password', $data);
    showFormButton('Veranderen', 'action');
    showFormEnd($data['page']);
} 

?>