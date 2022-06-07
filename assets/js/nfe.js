function danfe(caminho){
    window.open(caminho, "janela2","width=850,height=700, directories=no, location=no, menubar=no, scrollbars=no, status=no, toolbar=no, resizable=no");
}

function excluir(chave){
    Swal.fire({
        icon: 'question',
        title: 'Confirma Exclusão da Nota?',
        text: 'CHAVE: ' + chave,
        showCancelButton: true,
        confirmButtonText: 'Sim',
        cancelButtonText: 'Não'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: 'POST',
                url: '/nfe/excluir',
                dataType: "JSON",
                data: {
                    chave: chave
                },
                success: function(retorno) {
                    console.log(retorno);
                    if(retorno.status === true){
                        tabela.ajax.reload();
                        Swal.fire('Nota Excluída!', '', 'success');
                    }else{
                        Swal.fire('Operação não realizada!', retorno.erro, 'error');
                    }
                }
            });
        }else{
            Swal.fire('Operação cancelada pelo usuário!!', '', 'info');
        }
    });
}