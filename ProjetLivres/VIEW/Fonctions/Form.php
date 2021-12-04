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

    public function setText($label, $name, $id, $required = NULL, $placeholder, $value, $type, $class='', $onBlur='', $idResultat='')
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
				<input type="'.$type.'" class="'.$class.'" name="'.$name.'" onBlur="'.$onBlur.'"  placeholder="'.$placeholder.'" id="'.$id.'" '.$this->_required.' />
            </p><div id="'.$idResultat.'"></div>';


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
    public function setPassword($label, $name, $id, $required = NULL, $placeholder, $value, $type, $class='', $onBlur='', $idResultat='')
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
				<input type="'.$type.'" class="'.$class.'" name="'.$name.'"  placeholder="'.$placeholder.'" id="'.$id.'"'.$this->_required.'/>
            </p><div id="'.$idResultat.'"></div>';

    }
    /**
     * On crée une nouvelle fonction : setEmail avec : 6 params
     */

    public function setEmail($label, $name, $id, $required = NULL, $placeholder, $value, $type, $class='')
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
				<input type="'.$type.'" class="'.$class.'" name="'.$name.'"  onblur="verifMail(this)"  placeholder="'.$placeholder.'" id="'.$id.'"'.$this->_required.'/>
            </p>';

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
    /**
     *On crée une fonction qui génère le code HTML
     */

    public function getForm()
    {
        return $this->_htmlADD;

    }

}