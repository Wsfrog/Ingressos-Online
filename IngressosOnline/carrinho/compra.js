document.addEventListener('DOMContentLoaded', () => {
  const comprarButton = document.getElementById('comprarButton');
  const compraStatus = document.getElementById('compraStatus');

  comprarButton.addEventListener('click', () => {
    if (confirm('Deseja finalizar a compra?')) {
      fetch('comprar.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
      })
        .then(response => response.json())
        .then(data => {
          if (data.success) {
            compraStatus.textContent = 'Compra realizada com sucesso!';
            compraStatus.style.color = 'green';
            setTimeout(() => window.location.reload(), 2000); // Atualiza a página após 2 segundos
          } else {
            compraStatus.textContent = data.message || 'Erro ao realizar a compra.';
            compraStatus.style.color = 'red';
          }
        })
        .catch(error => {
          compraStatus.textContent = 'Erro ao se conectar ao servidor.';
          compraStatus.style.color = 'red';
        });
    }
  });
});
