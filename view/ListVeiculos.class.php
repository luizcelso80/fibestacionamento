<?php
date_default_timezone_set("Brazil/East");
require_once "../control/ControlVeiculo.class.php";
$pagina = (isset($_GET['pagina']))? $_GET['pagina'] : 1;
$pagina2 = (isset($_GET['pagina2']))? $_GET['pagina2'] : 1;
$dados = [];
$controlVeiculo = new ControlVeiculo();
if(isset($_GET['saida'])){
	$id = $_GET['saida'];
	$dados = $controlVeiculo->saidaVeiculo($id);
}
if(isset($_GET['ret'])){
	$id = $_GET['ret'];
	$dados = $controlVeiculo->erroSaida($id);
}
$numPaginas1 = $controlVeiculo->numPaginas(1);
$numVeiculos1 = $controlVeiculo->contaVeiculos(1);
$veiculos1 = $controlVeiculo->listLimit($pagina,1, 1);
$numPaginas2 = $controlVeiculo->numPaginas(2);
$veiculos2 = $controlVeiculo->listLimit($pagina2,2,2);
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<div align="center">
		<table border="1">
			<thead>
				<th colspan="7">TÃO - <?php echo $numVeiculos1; ?> - VEÍCULOS</th>
			</thead>
			<thead>
				<th>ID</th>
				<th>PLACA</th>
				<th>DESCRIÇÃO</th>
				<th>ENTRADA</th>
				<th>SAÍDA</th>
				<th>VALOR</th>
				<th colspan="2">AÇÕES</th>
			</thead>
			<tfoot>
				<td colspan="8" align="center">O senhor é meu pastor e nada me faltará!</td>
			</tfoot>
			<?php foreach($veiculos1 as $carro){ ?>
			<tr>
				<td><?php echo $carro->id; ?></td>
				<td><?php echo $carro->placa; ?></td>
				<td><?php echo $carro->descricao; ?></td>
				<td><?php echo date('d/m/Y H:i', strtotime($carro->entrada)); ?></td>
				<td><?php echo ($carro->saida) ? date('d/m/Y H:i', strtotime($carro->saida)) : ""; ?></td>
				<td><?php echo $carro->valor; ?></td>
				<td><?php echo "<a href='ListVeiculos.class.php?pagina=$pagina&pagina2=$pagina2&saida=$carro->id'><button>SAINU</button></a> ";?></td>
				
			</tr>
			<?php } ?>
			
		</table>
		<?php for($i = 1; $i < $numPaginas1 + 1; $i++) {
			echo "<a href='ListVeiculos.class.php?pagina=$i'>".$i."</a> ";
		}
		?>
	</div>
	<hr>	
	<div align="center">
		<?php if (isset($_GET['saida'])) {
			if (array_key_exists('erro', $dados)) {
				echo $dados['erro']."<br>";
				echo "Permanencia: ". $dados['mes'] . "m " . $dados['dia'] . "d ". $dados['hora'] . "h " . $dados['minuto'] . "m<br>";
				echo "Placa: " . $dados['placa'] . "<br>";
				echo "Valor: R$" . $dados['valor'];
			}else{
				echo "Permanencia: ". $dados['mes'] . "m " . $dados['dia'] . "d ". $dados['hora'] . "h " . $dados['minuto'] . "m<br>";
				echo "Placa: " . $dados['placa'] . "<br>";
				echo "Valor: R$" . $dados['valor'];
			}

			
			
		}
		if (isset($_GET['ret'])) {
			if (array_key_exists('erro', $dados)) {
				echo $dados['erro']."<br>";
			}
		}

		?>
	</div>
	<hr>	
	<div align="center">
		<table border="1">
			<thead>
				<th colspan="7">NÃO TÃO</th>
			</thead>
			<thead>
				<th>ID</th>
				<th>PLACA</th>
				<th>DESCRIÇÃO</th>
				<th>ENTRADA</th>
				<th>SAÍDA</th>
				<th>VALOR</th>
				<th colspan="2">AÇÕES</th>
			</thead>
			
			<tfoot>
				<td colspan="8" align="center">O senhor é meu pastor e nada me faltará!</td>
			</tfoot>
			<?php foreach($veiculos2 as $carro2){ ?>
			<tr>
				<td><?php echo $carro2->id; ?></td>
				<td><?php echo $carro2->placa; ?></td>
				<td><?php echo $carro2->descricao; ?></td>
				<td><?php echo date('d/m/Y H:i', strtotime($carro2->entrada)); ?></td>
				<td><?php echo ($carro2->saida) ? date('d/m/Y H:i', strtotime($carro2->saida)) : ""; ?></td>
				<td><?php echo $carro2->valor; ?></td>
				<td><?php echo "<a href='ListVeiculos.class.php?pagina=$pagina&pagina2=$pagina2&ret=$carro2->id'><button>DES-SAINU</button></a> ";?></td>
			</tr>
			<?php } ?>
			
		</table>
		<?php for($i = 1; $i < $numPaginas2 + 1; $i++) {
			echo "<a href='ListVeiculos.class.php?pagina2=$i'>".$i."</a> ";
		}
		?>
	</div>

</body>
</html>