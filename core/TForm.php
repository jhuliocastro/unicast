<?php
namespace Core;

class TForm{
    private string $form;
    private string $input = "";

    /**
     * @param string $id
     * @param string $method
     */
    public function __construct(string $id, string $method)
    {
        $this->form = "
            <form method='$method' id='$id'>
        ";

    }

    /**
     * @param string $id
     * @param string $label
     * @param string $type
     * @param bool $required (true or false)
     * @param string|null $placeholder
     * @return void
     */
    public function addInput(string $id, string $label, string $type, bool $required, ?string $placeholder){
        $input = "
            <div class='row'>
                <div class='form-group'>
                    <label>$label</label>
                    <input type='$type' name='$id' id='$id' placeholder='$placeholder'>
                </div>
            </div>
        ";

        if($required == true){
            $input = str_replace("<input", "<input required ", $input);
        }

        $this->input .= $input;
    }

    public function modal(string $id, string $title, int $width, bool $autoopen = false){
        if($autoopen == true){
            $autoopen = "true";
        }else{
            $autoopen = "false";
        }

        $this->form = "
            <div id='$id' title='$title'>
            $this->input
            <input type='submit' tabindex='-1' style='position:absolute; top:-1000px'>
            </form>
            </div>
            <script>
            var dialog_$id = $('#$id').dialog({
                autoOpen: $autoopen,
                width: $width
            });
            
            var form4 = dialog_$id.find( 'form' ).on( 'submit', function( event ) {
                event.preventDefault();
                
            });
            </script>
        ";

        return $this->form;
    }

    public function show(){
        return $this->form;
    }
}