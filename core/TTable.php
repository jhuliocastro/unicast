<?php
namespace Core;

class TTable{
    private string $table;
    private string $header;
    private string $url;
    private string $method;
    private bool $reorderRows = false;
    private bool $showHeader = true;
    private bool $showFooter = true;
    private bool $toolbar = true;
    private bool $lineNumbers = false;
    private ?string $columns = null;
    private ?string $searches = null;
    private ?string $sort = "";
    private string $itemToolbar = "";

    /**
     * @param string $header
     */
    public function header(string $header){
        $this->header = $header;
    }

    /**
     * @param string $url URL JSON
     */
    public function url(string $url){
        $this->url = $url;
    }

    /**
     * @param string $method
     */
    public function method(string $method){
        $this->method = $method;
    }

    /**
     * @param bool $reoderRows TRUE OR FALSE
     */
    public function reoderRows(bool $reoderRows){
        $this->reorderRows = $reoderRows;
    }

    /**
     * @param bool $showHeader TRUE OR FALSE
     */
    public function showHeader(bool $showHeader){
        $this->showHeader = $showHeader;
    }

    /**
     * @param bool $toolbar TRUE OR FALSE
     */
    public function toolbar(bool $toolbar){
        $this->toolbar = $toolbar;
    }

    /**
     * @param string $type
     * @param string $id
     * @param string $text
     * @param string $image
     */
    public function addItemToolbar(string $type, string $id, string $text, string $image){
        $this->itemToolbar .= "{ type: '$type', id: '$id', text: '$text', img: 'fa-solid $image' },";
    }

    /**
     * @param bool $lineNumbers TRUE OR FALSE
     */
    public function lineNumbers(bool $lineNumbers){
        $this->lineNumbers = $lineNumbers;
    }

    /**
     * @param string $column
     * @param string $direction ASC OR DESC
     */
    public function sort(string $column, string $direction){
        $this->sort = " {'field':'$column', 'direction':'$direction'}";
    }

    /**
     * @param string $field COLUMN ID
     * @param string $text
     * @param string $size % OR px
     * @param bool $sortable TRUE OR FALSE
     */
    public function addColumn(string $field, string $text, string $size, bool $sortable = false){
        if($sortable == false){
            $sortable = 'false';
        }else{
            $sortable = 'true';
        }
        $this->columns .= "{ field: '$field', text: '$text', size: '$size', sortable: $sortable },";
    }

    /**
     * @param string $type INT | TEXT | DATE
     * @param string $field
     * @param string $label
     */
    public function addSearch(string $type, string $field, string $label){
        $this->searches .= "{ type: '$type',  field: '$field', label: '$label' },";
    }

    public function close(){
        $retorno = "
            query(() => {
                new w2grid({
                    name: 'grid',
                    box: query('#grid')[0],
                    url: '$this->url',
                    header: '$this->header',
                    method: '$this->method',
                    reorderRows: '$this->reorderRows',
                     toolbar: {
                        items: [
                            { type: 'break' },
                            $this->itemToolbar
                        ],
                        onClick: function (target, data) {
                            console.log(target);
                        }
                    },
                    show: {
                        header: '$this->showHeader',
                        footer: '$this->showFooter',
                        toolbar: '$this->toolbar',
                        lineNumbers: '$this->lineNumbers'
                    },
                    columns: [
                        $this->columns
                    ],
                    searches: [
                        $this->searches
                    ]
                })
            })
        ";

        $retorno = "<script type=\"text/javascript\">".$retorno."</script>";
        return $retorno;

    }
}