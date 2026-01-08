<?php
class Form {
    private $fields = [];
    private $action;
    private $submit;
    private $count = 0;

    public function __construct($action, $submit)
    {
        $this->action = $action;
        $this->submit = $submit;
    }

    public function addField($name, $label, $type = "text", $options = [])
    {
        $this->fields[$this->count] = [
            "name" => $name,
            "label" => $label,
            "type" => $type,
            "options" => $options
        ];
        $this->count++;
    }

    public function display()
    {
        echo "<form method='POST' enctype='multipart/form-data'>";
        foreach ($this->fields as $f) {
            echo "<label>{$f['label']}</label>";

            switch ($f['type']) {
                case "textarea":
                    echo "<textarea name='{$f['name']}'></textarea>";
                    break;

                case "select":
                    echo "<select name='{$f['name']}'>";
                    foreach ($f['options'] as $v => $l) {
                        echo "<option value='$v'>$l</option>";
                    }
                    echo "</select>";
                    break;

                case "radio":
                    foreach ($f['options'] as $v => $l) {
                        echo "<label><input type='radio' name='{$f['name']}' value='$v'> $l</label>";
                    }
                    break;

                case "checkbox":
                    foreach ($f['options'] as $v => $l) {
                        echo "<label><input type='checkbox' name='{$f['name']}[]' value='$v'> $l</label>";
                    }
                    break;

                case "password":
                    echo "<input type='password' name='{$f['name']}'>";
                    break;

                default:
                    echo "<input type='text' name='{$f['name']}'>";
            }
        }

        echo "<button type='submit'>{$this->submit}</button>";
        echo "</form>";
    }
}
?>
