<?php
namespace Core;

class TPage implements IPage{
    private int $type;
    private string $page;

    /** 0 = Table
     *  1 = Form
     * @param int $type
     */

    public function __construct(int $type, string $title)
    {
        $this->type = $type;
        $this->page = "
        <div class='pcoded-content'>
        <div class='card'>
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
        ";
    }
}