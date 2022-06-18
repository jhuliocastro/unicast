<?php
namespace Core;

class TForm{
    private string $form;
    private string $input = "";

    /**
     * @param string $id
     * @param string $method
     * @param string $url
     * @param bool $encrypte
     */
    public function __construct(string $id, string $method, string $url, bool $encrypte = false)
    {
        $this->form = "<form method='$method' id='$id' action='$url'";
        
        if($encrypte == true){
            $this->form .= " enctype=\"multipart/form-data\"";
        }

        $this->form .= ">";
    }


    public function addInput(string $input){
        $this->input .= $input;
    }

    /**
     * Undocumented function
     *
     * @param string $id
     * @param string $title
     * @return void
     */
    public function addSubmit(string $id, string $title){
        $input = "
            <div class='row'>
                <div class='col-md-12'>
                    <div class='form-group'>
                        <button id='$id'>$title</button>
                        <script>$(\"#$id\").button();</script>
                    </div>
                </div>
            </div>
        ";
        $this->form .= $input;
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
            var $id = $('#$id').dialog({
                autoOpen: $autoopen,
                width: $width
            });
            
            var form4 = $id.find( 'form' ).on( 'submit', function( event ) {
                event.preventDefault();
                
            });
            </script>
        ";

        return $this->form;
    }

    public function show(){
        $this->form .= $this->input."</form>";
        return $this->form;
    }
}