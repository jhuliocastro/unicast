<?php
namespace Core;

class TInput{
    private string $type;
    private string $id;
    private string $label;
    private string $width;

    public function __construct(string $type, string $id, string $label, string $width = '100%'){
        $this->type = $type;
        $this->id = $id;
        $this->label = $label;
        $this->width = $width;
    }

    public function show(){
        return "
            <div class='form-group'>
                <label>$this->label</label>
                <input id='$this->id' type='$this->type' class='input-small' data-role='input' style='width: $this->width;'>
            </div>
        ";
    }
}