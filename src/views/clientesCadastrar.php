<?php
$this->layout("_theme", $this->data);
$this->data["empresa"] = EMPRESA;
?>

<div class="pcoded-content">
    <div class="card">
        <form method="post" action="/clientes/cadastrar">
            <div class="card-header">
                Cadastrar Clientes :: <?= $this->data["empresa"] ?>
            </div>
            <div class="card-body p-2">
                <div class="card-block">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12" style="margin-top: 15px;">
                                <div class="form-group">
                                    <label>Nome do Cliente</label>
                                    <input type="text"
                                           autocomplete="off"
                                           data-role="input"
                                           required
                                           name="nomeCliente"
                                           id="nomeCliente">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Pessoa para Contato</label>
                                    <input type="text" data-role="input" name="pessoaContato" id="pessoaContato">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Sexo</label>
                                    <select data-role="select" name="sexo" id="sexo">
                                        <option value="m">Masculino</option>
                                        <option value="f">Feminino</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>CEP</label>
                                    <input type="text" data-role="input" name="cep" id="cep" maxlength="9">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>UF</label>
                                    <input type="text" maxlength="2" data-role="input" name="uf" id="uf">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Cidade</label>
                                    <input type="text" data-role="input" name="cidade" id="cidade">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Bairro</label>
                                    <input type="text" data-role="input" name="bairro" id="bairro">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-11">
                                <div class="form-group">
                                    <label>Logradouro</label>
                                    <input type="text" data-role="input" name="logradouro" id="logradouro">
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="form-group">
                                    <label>Número</label>
                                    <input type="number" data-role="input" name="numero" id="numero">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Complemento</label>
                                    <input type="text" data-role="input" name="complemento" id="complemento">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>CPF</label>
                                    <input type="text" data-role="input" name="cpf" id="cpf">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>RG</label>
                                    <input type="text" data-role="input" name="rg" id="rg">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Telefone</label>
                                    <input type="text" maxlength="15" data-role="input" name="telefone" id="telefone">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>E-mail</label>
                                    <input type="text" data-role="input" name="email" id="email">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button>CADASTRAR CLIENTE</button>
            </div>
        </form>
    </div>
</div>

<?= $this->start("scripts"); ?>
<script>
    $(document).ready(function () {
        $("#cep").mask('#####-###');
        $("#cpf").mask('###.###.###-##');
        $("#telefone").mask('(##) #####-####');
        $("#nomeCliente").focus();
    });
</script>
<?= $this->end("scripts"); ?>
