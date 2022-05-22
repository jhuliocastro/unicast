<?php
namespace Core;

class TButton{
    private $class;
    private $title;
    private $action;
    private $js = false;
    private $idModal;
    private $idBotao;
    private $url;

    public function title(string $title){
        $this->title = $title;
    }

    public function id($id){
        $this->idBotao = $id;
    }

    public function url($url){
        $this->url = $url;
    }

    /**
     * Undocumented function
     *
     * @param string $action
     * 0 = MODAL
     * 1 = FUNCAO JS
     * 2 = REDIRECIONAMENTO
     * @return void
     */
    public function action(int $action){
        $this->action = $action;
    }

    public function idModal(string $id){
        $this->idModal = $id;
    }

    public function show(){
        $botao = "
            <button id='$this->idBotao'>$this->title</button>
        ";
        switch($this->action){
            case 0:
                $botao .= "
                <script>
                $(function() {
                    $(\"#$this->idBotao\").button();
                
                    $(\"#$this->idBotao\").click(function(){
                        $this->idModal.dialog('open');
                    });
                });
                </script>
                ";
                break;
            case 1:
                $botao .= "
                <script>
                $(function() {
                    $(\"#$this->idBotao\").button();
                
                    $(\"#$this->idBotao\").click(function(){
                        $this->js();
                    });
                });
                </script>
                ";
                break;
            case 2:
                $botao .= "
                <script>
                $(function() {
                    $(\"#$this->idBotao\").button();
                
                    $(\"#$this->idBotao\").click(function(){
                        window.location.href='$this->url';
                    });
                });
                </script>
                ";
                break;
        }
        return $botao;
    }
}