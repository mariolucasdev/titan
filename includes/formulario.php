<main>
  <section>
    <a href="index.php">
      <button class="btn btn-dark">
        Voltar
      </button>
    </a>
  </section>
  <h2 class="mt-2"> <?= TITLE ?> </h2>
  <form method="post">
    <div class="form-group">
      <label for="">Nome</label>
      <input type="text" class="form-control" name="NOME" value="<?= $obProduto->NOME ?? null ?>">
    </div>
    <div class="form-group">
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="">Cor</label>
          <select class="form-control" name="COR" id="cor">
            <?php if($obProduto->COR): ?>
              <?php if($obProduto->COR == 'AZUL'): ?>
                <option selected value="AZUL"> AZUL </option>
              <?php elseif($obProduto->COR == 'VERMELHO'): ?>
                <option selected value="VERMELHO"> VERMELHO </option>
              <?php else: ?>
                <option selected value="AMARELO"> AMARELO </option>
              <?php endif ?>
            <?php else: ?>
                <option value="AZUL"> AZUL </option>
                <option value="VERMELHO"> VERMELHO </option>
                <option value="AMARELO"> AMARELO </option>
              <?php endif ?>
          </select>
        </div>
        <div class="form-group col-md-6">
          <label for="">Preço</label>
          <input type="text" value="<?= $obProduto->PRECO ?? null ?>" class="form-control" name="PRECO">
        </div>
      </div>
    </div>
    <div class="form-group">
      <button type="submit" class="btn btn-block btn-success"> Cadastrar </button>
    </div>
  </form>
</main>