<?php
namespace Core;

use Controller\Controller;

class TPage extends Controller implements IPage{
    private int $type;
    private string $page;
    private $button;

    /** 0 = Table
     *  1 = Form
     * @param int $type
     * @param string $title
     */

    public function __construct(int $type, string $title)
    {
        $this->type = $type;
        $this->page = "
        <div class='pcoded-content'>
        <div class='card'>
        <div class='card-header'>
            $title :: ".EMPRESA."
        </div>
        <div class='card-body p-2'>
        <div class='card-block''>
        <div class='container-fluid'>
        <div>
            <hr id='linha'>
        </div>
        ";
    }

    /**
     * ADD BUTTON
     *
     * @param string $id ID DO BOTAO
     * @param string $title TITULO DO BOTAO
     * @param string|null $url URL PARA ONDE O BOTAO VAI REDIRECIONAR (ACEITA NULL)
     * @param string|null $idModal
     * @param string|null $functionJS
     * @param string|null $shortcut
     * @return void
     */


    public function addButton($botao){
        $botao = "
            $botao
            <hr id='linha'>
        ";
        $this->page = str_replace("<hr id='linha'>", $botao, $this->page);        
    }

    public function addJS(string $file)
    {
        // TODO: Implement addJS() method.
        //$file = file_get_contents();
        $file = "/../assets/js/$file.js";
        $this->page .= "
            <script src='$file'></script>
        ";
    }

    public function addTable(string $table){
        $this->page .= $table;
    }

    public function addForm(string $form){
        $this->page .= $form;
    }

    public function close()
    {
        $this->page .= "
        </div>
        </div>
        </div>
        </div>
        </div>
        ";

        parent::render("empresas", [
            "content" => $this->page
        ]);
    }
}