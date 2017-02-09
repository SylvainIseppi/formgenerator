<?php

class FormSet
{

    private $items = array();

    /**
     * Ajoute un élément à la liste des champs.
     * @param Field $f Le nouveau champ à ajouter.
     * @param int $id Emplacement où placer le nouvel élément, à la fin si non spécifié.
     */
    public function add(Field $f, $id = null)
    {
        if ($id == null) {
            $this->items[] = $f;
        } else {
            $insert = array($f);
            array_splice($this->items, $id, 0, $insert);
        }
    }

    /**
     * Supprime un champ de la liste, et réordonne les autres de sorte à ne pas laisser d'identifiant vide.
     * @param int $id Numéro du champ à supprimer dans la liste.
     */
    public function remove($id)
    {
        if (is_int($id)) {
            unset($this->items[$id]);
            //$this->items = array_values($this->items);
        }
    }

    /**
     * DEBUG
     */
    public function removeAll()
    {
        unset($this->items);
        $this->items = array();
    }

    /**
     * Déplace un champ de la liste à la position donnée.
     * @param int $from
     * @param int $to
     */
    public function move($from, $to)
    {
        // L'emplacement 'to' est vide
        if (!$this->keyExists($to)) {
            $this->items[$to] = $this->get($from);
        } else {
            $insert = array($this->items[$from]);
            array_splice($this->items, $to, 0, $insert);
        }
        unset($this->items[$from]);
        $this->items = array_values($this->items);
    }

    /**
     * Récupère le champ à l'id spécifié.
     * @param int $id
     * @return mixed
     * @throws Exception
     */
    public function get($id)
    {
        if ($this->keyExists($id)) {
            return $this->items[$id];
        } else {
            throw new Exception("Pas d'élément à l'emplacement $id.");
        }
    }

    /**
     * @return array Tableau contenant les identifiants de tous les champs de la liste.
     */
    public function keys()
    {
        return array_keys($this->items);
    }

    /**
     * @return int Nombre de champs dans la liste.
     */
    public function length()
    {
        return count($this->items);
    }

    /**
     * Indique si il y a un champ à l'indice donné.
     * @param int $key Identifiant du champ dans la liste.
     * @return bool
     */
    public function keyExists($key)
    {
        return isset($this->items[$key]);
    }

    public function preview() {
        $html = '';
        foreach($this->items as $id => $f) {
            $html .= $f->preview($id);
        }
        return $html;
    }

    /**
     * Transcrit chaque champ de la liste en code HTML.
     * @return string
     */
    public function HTMLize()
    {
        $html = '';
        foreach ($this->items as $f) {
            $html .= $f->HTMLize();
        }
        return $html;
    }
    public function checkize(){
        $check='';
        foreach ($this->items as $c ) {
            $check.=$c->checkize();
        }
        return $check;
    }
    public function requirize(){
        $require="";
        foreach ($this->items as $r) {
            $require.=$r->requirize();
        }
        return $require;
    }
    public function typize(){
        $typeChamp="";
        foreach ($this->items as $t) {
            $typeChamp.=$t->typize();
        }
        return $typeChamp;
    }

    public function __toString()
    {
        $string = '';
        foreach ($this->items as $f) {
            $string .= strval($f);
        }
        unset($f);
        return $string;
    }
}

abstract class Field
{
    protected $value;
    protected $name;
    protected $label;
    protected $required;

    // Valeurs communes à tous les champs
    public function setLabel($label)
    {
        $this->label = strip_tags($label);
    }

    public function setValue($val)
    {
        $this->value = strip_tags($val);
    }

    public function getLabel()
    {
        return $this->label;
    }

    public function setName($name)
    {
        $this->name = strip_tags($name);
    }

    public function getName()
    {
        return $this->name;
    }

    public function setRequired($required)
    {
        $this->required = strip_tags($required);
    }

    public function isRequired()
    {
        return $this->required ? 'required' : '';
    }

    public function __toString()
    {
        return $this->name . '\n';
    }

    // Présentation des types de champ dans la liste
    public abstract function getType();

    public abstract function preview($id);

    // Génération de code HTML selon les paramètres spécifiés
    public abstract function HTMLize();
    public abstract function checkize();
    public abstract function requirize();
    public abstract function typize();

    protected static function trunkName($str)
    {
        return trim($str);
    }
}

class TextField extends Field
{

    private $maxLength = 0;

    function __construct()
    {
        $this->label = "";
    }

    public function getType()
    {
        return "Texte";
    }

    public function setMaxLength($l)
    {
        $this->maxLength = $l;
    }

    public function getMaxLength()
    {
        return $this->maxLength;
    }

    public function preview($id)
    {?>
        <li class="input-field" id="texte<?php echo $id ?>" draggable="true" ondragstart="drag(event)" onclick="showOptions(this)">
        <i class="mdi-editor-format-size prefix"></i>
        <label for="untitled<?php echo $id ?>"><?php echo ($this->label == "" ? ('texte' . $id) : $this->label) ?></label>
        <input type="text" id="untitled<?php echo $id ?>" disabled />
    <?php
    }

    public function HTMLize()
    {
        $trunk = Field::trunkName($this->name);
        $required = parent::isRequired();

        return "<label for='$trunk'>{$this->label}</label> |
        <input type='text' name='$trunk' id='$trunk' $required/>|";

    }
        public function checkize(){
        $trunk=Field::trunkName($this->name);
        return 'if(isset($_POST["'.$trunk.'"]){|';
    }
       public function requirize(){
            $trunk= Field::trunkName($this->name);
            $required= parent::isRequired();
            if($required=="required"){
                return 'if(!empty($_POST["'.$trunk.'"])){|';
            }
            else return "";
        }
        public function typize(){
            $trunk= Field::trunkName($this->name);
            $maxLength=$this->getmaxlength();
            return 'if(strlen($_POST["'.$trunk.'"])<='.$maxLength.'){|
                '.$trunk.'=htmlspecialchars($_POST['.$trunk.']))||;';
        }
}

class NumberField extends Field
{

    private $minValue;
    private $maxValue;

    function __construct()
    {
        $this->label = "";
    }

    public function getType()
    {
        return "Nombre";
    }

    public function setMaxValue($max)
    {
        $this->maxValue = $max;
    }

    public function getMaxValue()
    {
        return $this->maxValue;
    }

    public function setMinValue($min)
    {
        $this->minValue = $min;
    }

    public function getMinValue()
    {
        return $this->minValue;
    }

    public function preview($id)
    {
        return '<li class="input-field" id="nombre' . $id . '" draggable="true" onclick="showOptions(this)" ondragstart="drag(event)" onclick="showOptions(this)">'
        . '<i class="mdi-image-filter-6 prefix"></i>'
        . '<label for="untitled' . $id . '">' . ($this->label == "" ? ('nombre' . $id) : $this->label) . '</label>'
        . '<input type="number" id="untitled' . $id . '" disabled />';
    }

    public function HTMLize()
    {
        $trunk = Field::trunkName($this->name);
        $required = parent::isRequired();

        return "<label for='$trunk'>{$this->label}</label>|
        <input type='number' name='$trunk' id='$trunk' min='{$this->minValue}' max='{$this->maxValue}' $required />|";
    }
     public function checkize(){
        $trunk=Field::trunkName($this->name);
        return 'if(isset($_POST["'.$trunk.'"]){|';
    }
  public function requirize(){
            $trunk= Field::trunkName($this->name);
            $required= parent::isRequired();
            if($required=="required"){
                return 'if(!empty($_POST["'.$trunk.'"])){|';
            }
            else return "";
        }
        public function typize(){
            $trunk= Field::trunkName($this->name);
            $required= parent::isRequired();
            $min=$this->getminValue();
            $max=$this->getMaxValue();
          
                return 'if($_POST["'.$trunk.'"]>='.$min.' && $_POST["'.$trunk.'"]<='.$max.'){|
                  '.$trunk.'= htmlspecialchars($_POST["'.$trunk.'"])||;';
          
            

        }
}

class Textarea extends Field
{

    private $maxLength;

    function __construct()
    {
        $this->label = "";
    }

    public function getType()
    {
        return "Textarea";
    }

    public function setMaxLength($l)
    {
        $this->maxLength = $l;
    }

    public function getMaxLength()
    {
        return $this->maxLength;
    }

    public function preview($id)
    {
        return '<li class="input-field" id="textarea' . $id . '" draggable="true" onclick="showOptions(this)" ondragstart="drag(event)" onclick="showOptions(this)">'
        . '<i class="mdi-action-subject prefix"></i>'
        . '<label for="untitled' . $id . '">' . ($this->label == "" ? ('textarea' . $id) : $this->label) . '</label>'
        . '<textarea class="materialize-textarea" id="untitled' . $id . '" disabled></textarea>';
    }

    public function HTMLize()
    {
        $trunk = Field::trunkName($this->name);
        $required = parent::isRequired();

        return"<label for='$trunk'>{$this->label}</label>|
         <textarea name='$trunk' id='$trunk' maxlength='{$this->maxLength}' $required />|";
    }
     public function checkize(){
        $trunk=Field::trunkName($this->name);
        return 'if(isset($_POST["'.$trunk.'"]){';
    }
      public function requirize(){
            $trunk= Field::trunkName($this->name);
            $required= parent::isRequired();
            if($required=="required"){
                return 'if(!empty($_POST["'.$trunk.'"])){|';
            }
            else return "";
        }
        public function typize(){
            return '';
        }
}

class Phone extends Field
{

    function __construct()
    {
        $this->label = "";
    }

    public function getType()
    {
        return "Telephone";
    }

    public function preview($id)
    {
        return '<li class="input-field" id="telephone' . $id . '" draggable="true" onclick="showOptions(this)" ondragstart="drag(event)" onclick="showOptions(this)">'
        . '<i class="mdi-communication-call prefix"></i>'
        . '<label for="untitled' . $id . '">' . ($this->label == "" ? ('telephone' . $id) : $this->label) . '</label>'
        . '<input type="tel" id="untitled' . $id . '" disabled />';
    }

    public function HTMLize()
    {
        $trunk = Field::trunkName($this->name);
        $required = parent::isRequired();

        return "<label for='$trunk'>{$this->label}</label>
        <input type='tel' name='$trunk' id='$trunk' $required />";
    }
     public function checkize(){
        $trunk=Field::trunkName($this->name);
        return 'if(isset($_POST["'.$trunk.'"]){|';
    }
      public function requirize(){
            $trunk= Field::trunkName($this->name);
            $required= parent::isRequired();
            if($required=="required"){
                return 'if(!empty($_POST["'.$trunk.'"])){|';
            }
            else return "";
        }
         public function typize(){
            return '';
        }
}

class Email extends Field
{

    function __construct()
    {
        $this->label = "";
    }

    public function getType()
    {
        return "Email";
    }

    public function getDescription()
    {
        return "Une adresse email valide";
    }

    public function preview($id)
    {
        return '<li class="input-field" id="email' . $id . '" draggable="true" onclick="showOptions(this)" ondragstart="drag(event)" onclick="showOptions(this)">'
        . '<i class="mdi-content-mail prefix"></i>'
        . '<label for="untitled' . $id . '">' . ($this->label == "" ? ('email' . $id) : $this->label) . '</label>'
        . '<input type="email" id="untitled' . $id . '" disabled />';
    }

    public function HTMLize()
    {
        $trunk = Field::trunkName($this->name);
        $required = parent::isRequired();

        return "<label for='$trunk'>{$this->name}</label>|
        <input type='email' name='$trunk' id='$trunk' $required />|";
    }
     public function checkize(){
        $trunk=Field::trunkName($this->name);
        return 'if(isset($_POST["'.$trunk.'"]){|';
    }
      public function requirize(){
            $trunk= Field::trunkName($this->name);
            $required= parent::isRequired();
            if($required=="required"){
                return 'if(!empty($_POST["'.$trunk.'])){"';
            }
            else return "";
        }
         public function typize(){
            return '';
        }
}

class Checkbox extends Field
{
    private $checked = false;

    function __construct()
    {
        $this->label = "";
    }

    public function getType()
    {
        return "Checkbox";
    }

    public function setChecked($checked)
    {
        $this->checked = $checked;
    }

    public function isChecked()
    {
        return $this->checked;
    }

    public function preview($id)
    {
        return '<li class="input-field" id="checkbox' . $id . '" draggable="true" onclick="showOptions(this)" ondragstart="drag(event)" onclick="showOptions(this)">'
        . '<i class="mdi-toggle-check-box prefix"></i>'
        . '<label for="untitled' . $id . '">' . ($this->label == "" ? ('checkbox' . $id) : $this->label) . '</label>'
        . '<input type="checkbox" id="untitled' . $id . '" disabled />';
    }

    public function HTMLize()
    {
        $trunk = Field::trunkName($this->name);
        $required = parent::isRequired();

        return "<label for='$trunk'>{$this->label}</label>|
        <input type='checkbox' name='$trunk' id='$trunk' $required />|";
    }
     public function checkize(){
        $trunk=Field::trunkName($this->name);
        return 'if(isset($_POST["'.$trunk.'"]){|';
    }
    public function requirize(){
            $trunk= Field::trunkName($this->name);
            $required= parent::isRequired();
            return $required;
        }
         public function typize(){
            return '';
        }
}

class Url extends Field
{

    function __construct()
    {
        $this->label = "";
    }

    public function getType()
    {
        return 'URL';
    }

    public function preview($id)
    {
        return '<li class="input-field" id="url' . $id . '" draggable="true" onclick="showOptions(this)" ondragstart="drag(event)" onclick="showOptions(this)">'
        . '<i class="mdi-social-public prefix"></i>'
        . '<label for="untitled' . $id . '">' . ($this->label == "" ? ('url' . $id) : $this->label) . '</label>'
        . '<input type="url" id="untitled' . $id . '" disabled />';
    }

    public function HTMLize()
    {
        $trunk = Field::trunkName($this->name);
        $required = parent::isRequired();

        return "<label for='$trunk'>{$this->label}</label>|
        <input type='number' name='$trunk' id='$trunk' $required />|";
    }
     public function checkize(){
        $trunk=Field::trunkName($this->name);
        return 'if(isset($_POST["'.$trunk.'"]){|';
    }
 public function requirize(){
            $trunk= Field::trunkName($this->name);
            $required= parent::isRequired();
            return "$required";
        }
         public function typize(){
            return '';
        }
}

abstract class FieldOptions
{

    const WRAP_START = "<li class='input-field'>";
    const WRAP_END = "</li>";

    static function printOptions(Field $f)
    {
        /* Options communes à tous les champs, auto-remplies */
        $html = '<h3>Options du champ</h3>
                <h5>Général</h5>
                <ul id="options-general">
                    <li class="input-field">
                        <label for="option-label">Label du champ</label>
                        <input name="label" id="option-label" type="text" value="' . $f->getLabel() . '"/>
                    </li>
                    <li class="input-field">
                        <label for="option-name">Nom du champ</label>
                        <input name="name" id="option-name" class="validate" type="text" pattern="^[a-z0-9]+$" value="' . $f->getName() . '" />
                    </li>
                    <li>
                        <input name="required" id="option-required" type="checkbox" ' . ($f->isRequired() ? 'checked' : '') . ' />
                        <label for="option-required">Champ requis</label>
                    </li>
                </ul>
                <h5>Détail</h5>
                <ul id="options-detail">';

        /* Options spécifiques */
        switch ($f->getType()) {
            case 'Texte':
                $html .= FieldOptions::WRAP_START
                    . '<label for="options-maxlength" class="active">Nombre de caractères maximum</label>'
                    . "<input type='number' class='validate' name='maxlength' id='options-maxlength' min='0' name='maxlength' value='{$f->getMaxLength()}'/>"
                    . FieldOptions::WRAP_END;
                break;
            case 'Nombre':
                $html .= FieldOptions::WRAP_START
                    . '<label for="options-minvalue" class="active">Valeur minimale</label>'
                    . "<input type='number' class='validate' id='options-minvalue' name='minvalue' value='{$f->getMinValue()}' />"
                    . FieldOptions::WRAP_END
                    . FieldOptions::WRAP_START
                    . '<label for="options-maxvalue" class="active">Valeur maximale</label>'
                    . "<input type='number' class='validate' id='options-maxvalue' name='maxvalue' value='{$f->getMaxValue()}' />"
                    . FieldOptions::WRAP_END;
                break;
            case
            'Textarea':
                $html .= FieldOptions::WRAP_START
                    . '<label for="options-maxlength" class="active">Nombre de caractères maximum</label>'
                    . "<input type='number' class='validate' id='options-maxlength' name='maxlength' value='{$f->getMaxLength()}'/>"
                    . FieldOptions::WRAP_END;
                break;
            case 'Telephone':
                $html .= 'Pas d\'options spécifiques.';
                break;
            case 'Email':
                $html .= 'Pas d\'options spécifiques.';
                break;
            case 'URL':
                $html .= 'Pas d\'options spécifiques.';
                break;
            case 'Checkbox':
                $html .= FieldOptions::WRAP_START
                    . "<input type='checkbox' id='options-checked' name='checked'/>"
                    . "<label for='options-checked'>Initialement cochée</label>"
                    . FieldOptions::WRAP_END;
               
                break;
            default:
                break;
        }

        /* Fin de liste */
        $html .= '</ul>';

        /* Afficher l'ensemble des options */
        echo $html;
    }
}