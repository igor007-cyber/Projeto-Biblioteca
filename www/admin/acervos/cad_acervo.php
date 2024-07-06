<?php
//cria o banco de dados se ele não existir
$db = new SQLite3('../../db/bibliotecario.db');
session_start(); 
$usuario_id = $_SESSION['usuarioId'];

 

  
?>
<h4>Novo cadastro</h4>
<form action="" id="form">
            <div class="form-group row" >
                <div class="col-sm-12">
                    <div class="form-group form-primary">
                        <label class="float-label">Título</label>
                        <input type="text" id="titulo" name="text" class="form-control" >
                        <span class="form-bar"></span>
                        
                    </div>
                </div>
                <div class="col-sm-10">
                    <div class="form-group form-primary">
                        <label class="float-label">Autor</label>
                        <input type="text" id="autor" name="text" class="form-control" >
                        <span class="form-bar"></span>
                        
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group form-primary">
                        <label class="float-label">Quantidade</label>
                        <input type="number" id="quantidade" name="quant" class="form-control" >
                        <span class="form-bar"></span>
                        
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group form-primary">
                        <label class="float-label">Ano</label>
                        <input type="text" id="ano" name="text" class="form-control" >
                        <span class="form-bar"></span>
                        
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group form-primary">
                        <label class="float-label">ISBN</label>
                        <input type="text" id="isbn" name="text" class="form-control" >
                        <span class="form-bar"></span>
                        
                    </div>
                </div>
                <div class="col-sm-5">
                    <div class="form-group form-primary">
                        <label class="float-label">Editora</label>
                        <input type="text" id="editora" name="text" class="form-control" >
                        <span class="form-bar"></span>
                        
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group form-primary">
                        <select name="" id="tipo" class="form-control">
                            <option value="">Selecione uma categoria</option>
                            <option>Livro</option>
                            <option>Revista</option>
                            <option>Coleção</option>
                            <option>Jornal</option>
                            <option>Gibi</option>
                            <option>Outros</option>
                                            
                        </select>
                    </div>
                </div>
                </div>
                <div class="form-group row" >
                    <div class="col-sm-12">
                        LOCALIZAÇÃO
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group form-primary">
                            <label class="float-label">Setor</label>
                            <input type="text" id="setor" name="text" class="form-control" >
                            <span class="form-bar"></span>
                            
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group form-primary">
                            <label class="float-label">Estante</label>
                            <input type="text" id="estante" name="text" class="form-control" >
                            <span class="form-bar"></span>
                            
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group form-primary">
                            <label class="float-label">Prateleira</label>
                            <input type="text" id="prateleira" name="text" class="form-control" >
                            <span class="form-bar"></span>
                            
                        </div>
                    </div>

                </div>
                <div class="form-group row" >
                <div class="col-sm-8">
                    <div class="form-group form-primary">
                    <label class="float-label">Sinopse</label>
                        <textarea name="" id="sinopse" class="form-control" cols="30" rows="5"></textarea>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group form-primary">
                        <select name="" id="categoria" class="form-control">
                            <option value="">Selecione uma área de conhecimento</option>
                                            <?php
                                                    $lista = $db->query("SELECT * FROM cad_categoria  WHERE id_escola = '$usuario_id'  ORDER BY titulo");
                                                    while($dados = $lista->fetchArray()){
                                                        $id = $dados['id'];
                                                        $nome = $dados['titulo'];

                                                    ?>
                                                    <option value="<?php echo $id ?>"><?php echo $nome ?></option>

                                                    <?php
                                                    }
                                                    ?>
                        </select>
                    </div>
                    <div class="form-group form-primary">
                        <br>
                        <button type="button" class="btn btn-secondary cancelar" >Retornar</button>
                        <input type="submit" class="btn btn-success" value="Salvar">
                    </div>
                </div>
                
                
            </div>
          
                
            
</form>

<script>
    $(function(){
        $('.cancelar').click(function(){
            $('.tabela').load('acervos/tabela.php');
        })
        $("#form").submit(function(event) {
            event.preventDefault(); //previne o comportamento padrão do formulário
            var data = new FormData();
            var titulo = $("#titulo").val();
            var autor = $("#autor").val();
            var quantidade = $("#quantidade").val();
            var ano = $("#isbn").val();
            var editora = $("#editora").val();
            var tipo = $("#tipo").val();
            var setor = $("#setor").val();
            var estante = $("#estante").val();
            var prateleira = $("#prateleira").val();
            var sinopse = $("#sinopse").val();
            var categoria = $("#categoria").val();
            var isbn = $("#isbn").val();

            
            data.append("isbn", isbn);
            data.append("titulo", titulo);
            data.append("autor", autor);
            data.append("quantidade", quantidade);
            data.append("ano", ano);
            data.append("editora", editora);
            data.append("tipo", tipo);
            data.append("setor", setor);
            data.append("estante", estante);
            data.append("prateleira", prateleira);
            data.append("sinopse", sinopse);
            data.append("categoria", categoria);


          
           

            if(titulo == ''){
                swal("Aviso!", 'Descreva o título do acervo!', "warning");
            }else if(autor == ''){
                swal("Aviso!", 'Descreva o autor do acervo!', "warning");
            }else if(quantidade == '' || quantidade == 0){
                swal("Aviso!", 'Informe a quantidade do acervo!', "warning");
            }else if(tipo == ''){
                swal("Aviso!", 'Selecione uma categoria para o acervo!', "warning");
            }else if(categoria == ''){
                swal("Aviso!", 'Selecione uma área de conhecimento para o acervo!', "warning");
            }else {
            
                $.ajax({
                    type: "POST",
                    url: "acervos/salva_acervo.php",
                    data: data,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if(response == 1){
                            $('.tabela').load('acervos/cad_acervo.php');
                          
                            swal(
                                'Cadastrado!',
                                'Cadastro salvo com sucesso!',
                                'success'
                            )
                        }else{
                            swal("Aviso!", response, "warning");
                        }
                        
                    },
                        error: function(response) {
                        swal("Aviso!", "Erro ao salvar dados", "warning");
                        
                    }
                });
            }
        });
       
    })
</script>