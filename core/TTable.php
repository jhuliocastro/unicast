<?php
namespace Core;

class TTable{
    private string $table;
    private string $header;
    private string $url;
    private string $method;
    private bool $reorderRows = true;
    private bool $showHeader = true;
    private bool $showFooter = true;
    private bool $toolbar = true;
    private bool $lineNumbers = true;
    private ?string $columns = null;
    private ?string $searches = null;

    /**
     * @param string $header
     */
    public function header(string $header){
        $this->header = $header;
    }

    /**
     * @param string $url URL OF JSON WITH DATA
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
     * @param bool $lineNumbers TRUE OR FALSE
     */
    public function lineNumbers(bool $lineNumbers){
        $this->lineNumbers = $lineNumbers;
    }

    /**
     * @param string $field COLUMN ID
     * @param string $text
     * @param string $size % OR px
     */
    public function addColumn(string $field, string $text, string $size){
        $this->columns .= "{ field: '$field', text: '$text', size: '$size' },";
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
        return "<script type=\"text/javascript\">
            query(() => {
                new w2grid({
                    name: 'grid',
                    box: query('#grid')[0],
                    header: '$this->header',
                    url: '$this->url',
                    method: '$this->method', // need this to avoid 412 error on Safari
                    reorderRows: $this->reorderRows,
                    show: {
                        header: $this->showHeader,
                        footer: $this->showFooter,
                        toolbar: $this->toolbar,
                        lineNumbers: $this->lineNumbers
                    },
                    columns: [
                        $this->columns
                    ],
                    searches: [
                        $this->searches
                    ]
                })
            })
        </script>";

    }
}