<?php
//cria o banco de dados se ele não existir
$db = new SQLite3('../../db/bibliotecario.db');
session_start(); 
$usuario_id = $_SESSION['usuarioId'];
$lista = $db->query("SELECT * FROM cad_escola WHERE id = '$usuario_id'  ");
$dados = $lista->fetchArray();
$nome_escola = $dados['nome'];           
?>

<div class="table-responsive" style="max-height: 400px;">
    <table class="table  table-sm table-hover" id="tabela-categorias" >
        <thead>
            <tr>
                <th>#</th>
                <th></th>
                <th>Título</th>
                
            </tr>
        </thead>
        <tbody>
            <tr>
        <?php
            $ordem = 1;
            $lista = $db->query("SELECT * FROM cad_curso  WHERE id_escola = '$usuario_id'");
            while($dados = $lista->fetchArray()){
                $id = $dados['id'];
                $titulo = $dados['titulo'];
               
               
                ?>
                <th scope="row"><?php echo $ordem ?></th>
                <th>
                    <div class="radio-container">
                        <input class="" type="radio" name="categoria" data-id="<?php echo $id ?>" value="option1" >
                    
                    </div>
                </th>
                <td><?php echo $titulo ?></td>
               
                
            </tr>
              <?php
              $ordem++;
              }
              ?>                                             
        </tbody>
    </table>
</div>

<script>
    $(function(){
        $("#tabela-categorias tr").click(function() {
				$(this).find("input[type='radio']").prop("checked", true);
				$('#tabela-categorias tbody tr').removeClass('table-highlighted');
                
                // adicionar a classe de destaque à linha selecionada
                $(this).closest('#tabela-categorias tbody tr').addClass('table-highlighted');
			});  
    // ao clicar em um input radio
    $('input[name="categoria"]').on('change', function() {
                // remover a classe de destaque de todas as linhas
                $('#tabela-categorias tbody tr').removeClass('table-highlighted');
                
                // adicionar a classe de destaque à linha selecionada
                $(this).closest('#tabela-categorias tbody tr').addClass('table-highlighted');
            });
        
    })
    
</script>
             