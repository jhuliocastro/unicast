<?php
namespace Core;

class TTable{
    private string $table;
    private string $id;
    private string $column;
    private string $data;
    private ?string $url = null;
    private bool $paginacao = true;
    private int $numberPaging = 10;
    private int $numberColumnOrder = 0;
    private string $orderTable = "asc";

    public function __construct(string $id)
    {
        $this->id = $id;
        $this->table = "
            <table id='$id' class='display compact' style='width: 100%;'>
        ";

        $this->column = "
        <thead>
            <tr></tr>
        </thead>
        ";

        $this->data = "
        <tbody>
        </tbody>
        ";

    }

    public function paging(bool $paging, int $count){
        $this->paginacao = $paging;
        $this->numberPaging = $count;
    }

    public function addColumn(string $column){
        $column = "<td>$column</td></tr>";
        $this->column = str_replace("</tr>", $column, $this->column);
    }

    public function urlData(string $url){
        $this->url = $url;
    }

    /**
     * @param int $column (Number of column)
     * @param string $order (asc or desc)
     */

    public function order(int $column, string $order){
        $this->numberColumnOrder = $column;
        $this->orderTable = $order;
    }

    public function close(){
        if($this->paginacao == 1){
           $paginacao = "true";
        }else{
            $paginacao = "false";
        }

        $this->table .= $this->column;
        $this->table .= "</table>";
        $this->table .= "
        <script>
            var tabela = $('#$this->id').DataTable({
                'paging': $paginacao,
                'order': [[$this->numberColumnOrder, '$this->orderTable']],
                'iDisplayLength': $this->numberPaging,
                'ajax': '$this->url',
                'language': {
                    'url': '//cdn.datatables.net/plug-ins/1.11.5/i18n/pt-BR.json'
                }
            });
        </script>
        ";

        return $this->table;
    }
}