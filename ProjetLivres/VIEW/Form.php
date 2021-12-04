<?php
class Form
{
    /**
     * On déclare nos parametres
     */


    private $_name;
    private $_id;
    private $_methode;
    private $_action;
    private $_type;
    private $_htmlADD = '';
    private $_required = '';
    /**
     * On crée un constructeur avec 4 params
     */


    public function __construct($name, $id, $methode, $action, $class='')
    {
        $this->_name = $name;
        $this->_id = $id;
        $this->_methode = $methode;
        $this->_action = $action;
        $this->_htmlADD .= '<form method="'.$this->_methode.'" action="'.$this->_action.'" class="'.$class.'""><div class="form-group">';


    }


    /**
     * On crée une nouvelle fonction : setText avec : 6 params
     */

    public function setText($label, $name, $id, $required = NULL, $placeholder, $value, $type)
    {
        if ($required <> false)
        {
            $this->_required = 'required';
        }
        else
        {
            $this->_required = '';
        }
        $this->_htmlADD= $this->_htmlADD .
            '<p>
				<label for="'.$name.'">'.$label.'</label><br />
				<input type="'.$type.'" name="'.$name.'"  onBlur="checkAvailability()"  placeholder="'.$placeholder.'" id="'.$id.'"'.$this->_required.'/>
            </p><div class="msgErreur" id="resultat"></div>';


    }

    /**
     * @param $label
     * @param $name
     * @param $id
     * @param null $required
     * @param $placeholder
     * @param $value
     * @param $type
     */
    public function setPassword($label, $name, $id, $required = NULL, $placeholder, $value, $type, $class='')
    {
        if ($required <> false)
        {
            $this->_required = 'required';
        }
        else
        {
            $this->_required = '';
        }
        $this->_htmlADD= $this->_htmlADD .
            '<p>
				<label for="'.$name.'">'.$label.'</label><br />
				<input class="'.$class.'" type="'.$type.'" name="'.$name.'"  placeholder="'.$placeholder.'" id="'.$id.'"'.$this->_required.'/>
            </p><div class="msgErreur" id="resultat2"></div>';

    }
    /**
     * On crée une nouvelle fonction : setEmail avec : 6 params
     */

    public function setEmail($label, $name, $id, $required = NULL, $placeholder, $value, $type)
    {
        if ($required <> false)
        {
            $this->_required = 'required';
        }
        else
        {
            $this->_required = '';
        }
        $this->_htmlADD= $this->_htmlADD .
            '<p>
				<label for="'.$name.'">'.$label.'</label><br />
				<input type="'.$type.'" name="'.$name.'"  onblur="verifMail(this)"  placeholder="'.$placeholder.'" id="'.$id.'"'.$this->_required.'/>
            </p>';

    }

    public function setNumber($label, $name, $id, $required = NULL, $type, $onblur,$value, $placeholder){
        if($required <> false){
            $this->_required = "required";
        }
        else{
            $this->_required = '';
        }
        $this->_htmlADD = $this->_htmlADD.
            '<p>
				<label for="'.$name.'">'.$label.'</label><br />
				<input type="'.$type.'" name="'.$name.'" id="'.$id.'"'.$this->_required.'  onblur="'.$onblur.'" value="'.$value.'" placeholder="'.$placeholder.'"/>
            </p>';
    }


    public function setDecimal($label, $name, $id, $required = NULL, $type, $onblur,$value, $placeholder){
        if($required <> false){
            $this->_required = "required";
        }
        else{
            $this->_required = '';
        }
        $this->_htmlADD = $this->_htmlADD.
            '<p>
				<label for="'.$name.'">'.$label.'</label><br />
				<input type="'.$type.'" name="'.$name.'" id="'.$id.'"'.$this->_required.' onblur="'.$onblur.'" value="'.$value.'" step = "0.01" placeholder="'.$placeholder.'"/>
            </p>';
    }
    /*public function setDecimalEdit($label, $name, $id, $required = NULL, $type, $onblur,$value, $placeholder){
        if($required <> false){
            $this->_required = "required";
        }
        else{
            $this->_required = '';
        }
        $this->_htmlADD = $this->_htmlADD.
            '<p>
				<label for="'.$name.'">'.$label.'</label><br />
				<input type="'.$type.'" name="'.$name.'" id="'.$id.'"'.$this->_required.' onblur="'.$onblur.'" value="'.if(isset($_SESSION['$value'])) echo $_SESSION['$value'] .'" step = "0.01" placeholder="'.$placeholder.'"/>
            </p>';
    }*/

    public function hidden($label, $name, $id, $required = NULL, $type, $onblur,$value, $placeholder){
        if($required <> false){
            $this->_required = "required";
        }
        else{
            $this->_required = '';
        }
        $this->_htmlADD = $this->_htmlADD.
            '<label for="'.$name.'">'.$label.'</label>
			<input type="'.$type.'" name="'.$name.'" id="'.$id.'"'.$this->_required.' onblur="'.$onblur.'" value="'.$value.'" placeholder="'.$placeholder.'" />';
    }

    public function hidden1($label, $name, $id, $required = NULL, $type, $onblur,$value, $placeholder,$class){
        if($required <> false){
            $this->_required = "required";
        }
        else{
            $this->_required = '';
        }
        $this->_htmlADD = $this->_htmlADD.
            '<label for="'.$name.'">'.$label.'</label>
			<input type="'.$type.'" name="'.$name.'" id="'.$id.'"'.$this->_required.' onblur="'.$onblur.'" value="'.$value.'" placeholder="'.$placeholder.'" class="'.$class.'" />';
    }

    public function setRadio($label,$name,$id,$required = NULL,$type,$value, $checked = ''){
        if($required <> false){
            $this->_required = "required";
        }
        else{
            $this->_required = '';
        }
        $this->_htmlADD = $this->_htmlADD.
        '<p>
				<label for="'.$name.'">'.$label.'</label>
				<input type="'.$type.'" name="'.$name.'" id="'.$id.'"'.$this->_required.' value="'.$value.'" checked = "'.$checked.'"/>
            </p>';
    }

    public function setRadio1($label,$name,$id,$required = NULL,$type,$value){
        if($required <> false){
            $this->_required = "required";
        }
        else{
            $this->_required = '';
        }
        $this->_htmlADD = $this->_htmlADD.
            '<p>
				<label for="'.$name.'">'.$label.'</label>
				<input type="'.$type.'" name="'.$name.'" id="'.$id.'"'.$this->_required.' value="'.$value.'" checked />
            </p>';
    }

    public function setText1($label, $name, $id, $required = NULL, $placeholder, $value, $type, $onKeyUp)
    {
        if ($required <> false)
        {
            $this->_required = 'required';
        }
        else
        {
            $this->_required = '';
        }
        $this->_htmlADD= $this->_htmlADD .
            '<p>
				<label for="'.$name.'">'.$label.'</label><br />
				<input type="'.$type.'" name="'.$name.'"  onKeyUp="'.$onKeyUp.'"  placeholder="'.$placeholder.'" id="'.$id.'"'.$this->_required.'/>
            </p><div class="msgErreur" id="resultat"></div>';


    }
    /**
     * on crée une fonction setSubmit pour le submit avec 2 params
     *
     */

    public function setSubmit($name, $value, $disabled = null, $class='')
    {
        $this->_htmlADD = $this->_htmlADD .
            '<p></p>
	        </p>
			<input  class="'.$class.'" '.$disabled.' id="boutonSubmit" name="'.$name.'" type="submit" value="'.$value.'"  />
		</div>
		</form>';
    }


    public function setSubmit1($name, $value, $onKeyUp, $id, $class )
    {
        $this->_htmlADD = $this->_htmlADD .
            '<p></p>
	   
			<input name="'.$name.'" type="submit" value="'.$value.'" onclick = "'.$onKeyUp.'" id="'.$id.'" class="'.$class.'"/>
		
		</form>';
    }


    public function submit($name, $value, $disabled = null, $class='', $id, $onclick)
    {
        $this->_htmlADD = $this->_htmlADD .
            '<p></p>
	        </p>
			<input  class="'.$class.'" '.$disabled.' id="'.$id.'" name="'.$name.'" type="button" value="'.$value.'" onclick="'.$onclick.'"  />
		</div>
		</form>';
    }

    /**
     *On crée une fonction qui génère le code HTML
     */

    public function getForm()
    {
        return $this->_htmlADD;

    }

}
/*
private $_name;
private $_id;
private $_methode;
private $_action;
private $_required;
private $_type;
private $_for;
private $_varText;
public $htmlAdd;


public function __construct($methode, $action) // Constructeur demandant 2 paramètres et commence toujours avec __construct
{
    $this->setMethode($methode);
    $this->setAction($action);
}

public function setText($name, $id, $varText,$required = 0)
{
    $this->setRequired($required);
    $this->setName($name);
    $this->setId($id);
    $this->set_Type("text");
    $this->setFor($name);
    $this->setVarText($varText);

    echo '<p>
            <label for="'.$this->getName().'">'.$this->getVarText().'</label><br />
            <input type="'.$this->get_Type().'" name="'.$this->getName().'" id="'.$this->getId().'"
            ';
                if ($this->getRequired() == 1)
                {
                    echo ' required ';
                }


            echo '/></p>';
}


public function setEmail($varText ,$required = 0)
{
    $this->setRequired($required);
    $this->setName("EMAIL");
    $this->setId("EMAIL");
    $this->set_Type("EMAIL");
    $this->setFor('EMAIL');
    $this->setVarText($varText);

    echo '<p>
            <label for="'.$this->getName().'">'.$this->getVarText().'</label><br />
            <input type="'.$this->get_Type().'" name="'.$this->getName().'" id="'.$this->getId().'"
     ';
        if ($this->getRequired() == 1)
        {
            echo ' required ';
        }


    echo '/></p>';
}

public function setSubmit($type, $value)
{
    echo '<p></p>

        <input type="'.$type.'" value="'.$value.'" />

    </form>';
}


public function getForm()
{
    echo '
    <form method="'.$this->getMethode().'" action="'.$this->getAction().'">';
}


//Setters
public function setName($name)
{
    $this->_name = $name;
}

public function setId($id)
{
    $this->_id = $id;
}

public function setMethode($methode)
{
    $this->_methode = $methode;
}

public function setAction($action)
{
    $this->_action = $action;
}

public function setRequired($required)
{
    $this->_required = $required;
}

public function set_Type($type)
{
    $this->_type = $type;
}

public function setFor($for)
{
    $this->_for = $for;
}

public function setVarText($varText)
{
    $this->_varText = $varText;
}


//Getters
public function getName()
{
    return $this->_name;
}

public function getId()
{
    return $this->_id;
}

public function getMethode()
{
    return $this->_methode;
}

public function getAction()
{
    return $this->_action;
}

public function getVarText()
{
    return $this->_varText;
}

public function get_Type()
{
    return $this->_type;
}

public function getRequired()
{
    return $this->_required;
}
*/
