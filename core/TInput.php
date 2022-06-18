<?php
namespace Core;

class TInput{
    private string $type;
    private ?string $id = null;
    private ?string $label = null;
    private string $width = '100%';
    private string $data;
    private bool $required = false;

    /**
     * @param string $type TIPO DO INPUT
     */
    public function type(string $type){
        $this->type = $type;
    }

    /**
     * @param string $id ID DO INPUT
     */
    public function id(string $id){
        $this->id = $id;
    }

    /**
     * @param string $label TEXTO DA LABEL
     */
    public function label(string $label){
        $this->label = $label;
    }

    /**
     * @param string $width 0 A 100%
     */
    public function width(string $width){
        $this->width = $width;
    }

    /**
     * @param bool $required TRUE OR FALSE
     */
    public function required(bool $required){
        $this->required = $required;
    }

    /**
     * @param array $dados DADOS DO INPUT CASO O TIPO SEJA SELECT
     */
    public function data(array $dados){
        foreach($dados as $d){
            $this->data .= "<option id='$d->id'>$d->value</option><br/>";
        }
    }

    private function select() : string{
        if($this->required == true){
            return "
            <div class='form-group'>
                <label>$this->label</label>
                <select id='$this->id' name='$this->id' required class='input-small' data-role='select' style='width: $this->width;'>
                    $this->data
                </select>
            </div>
        ";
        }else{
            return "
            <div class='form-group'>
                <label>$this->label</label>
                <select id='$this->id' name='$this->id' class='input-small' data-role='select' style='width: $this->width;'>
                    $this->data
                </select>
            </div>
        ";
        }
    }

    private function text() : string{
        if($this->required == true){
            return "
                    <div class='form-group'>
                        <label>$this->label</label>
                        <input id='$this->id' name='$this->id' required type='text' class='input-small' data-role='input' style='width: $this->width;'>
                    </div>
                ";
        }else{
            return "
                    <div class='form-group'>
                        <label>$this->label</label>
                        <input id='$this->id' name='$this->id' type='text' class='input-small' data-role='input' style='width: $this->width;'>
                    </div>
                ";
        }
    }

    private function password()
    {
        if($this->required == true){
            return "
                    <div class='form-group'>
                        <label>$this->label</label>
                        <input id='$this->id' name='$this->id' required type='password' class='input-small' data-role='input' style='width: $this->width;'>
                    </div>
                ";
        }else{
            return "
                    <div class='form-group'>
                        <label>$this->label</label>
                        <input id='$this->id' name='$this->id' type='password' class='input-small' data-role='input' style='width: $this->width;'>
                    </div>
                ";
        }
    }

    private function number()
    {
        if($this->required == true){
            return "
                    <div class='form-group'>
                        <label>$this->label</label>
                        <input id='$this->id' name='$this->id' required type='number' class='input-small' data-role='input' style='width: $this->width;'>
                    </div>
                ";
        }else{
            return "
                    <div class='form-group'>
                        <label>$this->label</label>
                        <input id='$this->id' name='$this->id' type='number' class='input-small' data-role='input' style='width: $this->width;'>
                    </div>
                ";
        }
    }

    public function close(){
        switch ($this->type):
            case "select":
                return $this->select();
            case "text":
                return $this->text();
            case "password":
                return $this->password();
            case "number":
                return $this->number();
        endswitch;
    }
}