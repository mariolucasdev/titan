<?php
  if(isset($_GET['status'])){
    $typeStatus = $_GET['status'] == 'success' ? 'success' : 'danger';
    $messageStatus = $_GET['status'] == 'success' ? 'Sucesso ao realizar ação!' : 'Falha ao realizar ação!';
  }
?>

<main>
  <section>
    <?php if(isset($_GET['status'])): ?>
      <div class="alert alert-<?= $typeStatus ?> alert-dismissible fade show" role="alert">
        <?= $messageStatus ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <?php endif ?>
  </section>
  <section>
   
    <?php if(isset($_GET['NOME'], $_GET['PRECO'], $_GET['COR'])): ?>
      <a href="index.php">
        <button class="btn btn-dark">
          Limpar Filtros
        </button>
      </a>
    <?php endif ?>

    <a href="cadastrar.php">
      <button class="btn btn-success">
        Novo Produto
      </button>
    </a>
  </section>

  <section class="mt-3">
    <form action="buscar.php">
      <div class="form-row">
        <div class="form-group col-md-3">
          <label for="NOME">Busca por nome</label>
          <input type="text" autofocus name="NOME" placeholder="Nome do produto" class="form-control">
        </div>
        <div class="form-group col-md-3">
          <label for="NOME">Cor</label>
          <select name="COR" class="form-control">
            <option value="">Todas</option>
            <option value="AMARELO">AMARELO</option>
            <option value="AZUL">AZUL</option>
            <option value="VERMELHO">VERMELHO</option>
          </select>
        </div>
        <div class="form-group col-md-3">

          <div class="form-check form-check-inline mb-2">
            <input class="form-check-input" type="radio" name="FILTRO_PRECO" id="inlineRadio1" value="mai">
            <label class="form-check-label" for="inlineRadio1">Maior</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="FILTRO_PRECO" id="inlineRadio2" value="mei">
            <label class="form-check-label" for="inlineRadio2">Menor</label>
          </div>

          <input type="text" autofocus name="PRECO" value="0" required placeholder="Preço" class="form-control">
        </div>
        <div class="form-group col-md-3">
          <label for="NOME">Buscar</label>
          <button type="submit" class="btn btn-primary btn-block">
            Buscar
          </button>
        </div>
      </div>
    </form>
  </section>

  <section>
    <table class="table bg-light mt-3">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nome</th>
          <th>Cor</th>
          <th>Preço</th>
          <th>Desconto</th>
          <th>Ações</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($produtos as $produto): ?>
          <tr>
            <td> <?= $produto->IDPROD ?> </td>
            <td> <?= $produto->NOME ?> </td>
            <td> <span class="badge badge-<?=$colors[$produto->COR]?>"> <?= $produto->COR ?></span></td>
            <td> R$ <?= number_format($produto->PRECO, 2,',', '.') ?> </td>
            <td> <?= $produto->COR == 'VERMELHO' && $produto->PRECO > 50 ? $discount[$produto->COR] + 5 : $discount[$produto->COR] ?>% </td>
            <td>
              <a href="editar.php?id=<?= $produto->IDPROD ?>">
                <button class="btn btn-primary"> Editar </button>
              </a>
              <a href="excluir.php?id=<?= $produto->IDPROD ?>">
                <button class="btn btn-danger"> Excluir </button>
              </a>
            </td>
          </tr>
        <?php endforeach ?>
      </tbody>
    </table>
  </section>
</main>