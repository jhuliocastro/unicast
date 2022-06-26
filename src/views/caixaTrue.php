<html>
    <head>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </head>
    <body>
        <script>
            Swal.fire({
                title: 'Venda Finalizada!',
                text: "Troco: R$ <?= $this->data["troco"] ?>",
                icon: 'success',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Imprimir Cupom',
                cancelButtonText: 'Voltar'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.open("/pdv/imprimir/cupom/" + <?= $id ?>, '_blanck');
                    window.location.href = "/vendas";
                }else{
                    window.location.href = "/vendas"
                }
            })
        </script>
    </body>
</html>
