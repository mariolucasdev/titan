<main>
  <section>
    <a href="cadastrar.php">
      <button class="btn btn-success">
        Novo Produto
      </button>
    </a>
  </section>
  <section>
    <table class="table bg-light mt-3">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nome</th>
          <th>Cor</th>
          <th>Preço</th>
          <th>Ações</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($produtos as $produto): ?>
          <tr>
            <td> <?= $produto->IDPROD ?> </td>
            <td> <?= $produto->NOME ?> </td>
            <td> <?= $produto->COR ?> </td>
            <td> R$ <?= number_format($produto->PRECO, 2,',', '.') ?> </td>
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