<main>
  <section>
    
  </section>
  <h2 class="mt-2"> Excluir Produto </h2>
  <form method="post">
    <div class="form-group">
      <p>Você deseja realmente excluir o produto <strong> <?= $obProduto->NOME ?> </strong></p>
    </div>
    <div class="form-group">
      <a href="index.php">
        <button type="button" class="btn btn-dark">
          Cancelar
        </button>
      </a>

      <button type="submit" name="excluir" class="btn btn-danger"> Excluir </button>
    </div>
  </form>
</main>