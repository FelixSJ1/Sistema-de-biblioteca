<?php
// app/views/PainelDeLivros.php (atualizado)
require_once __DIR__ . '/../models/Ricardo_painel.php';
$livros = RicardoModel::getAll();
$status = $_GET['status'] ?? '';
?>
<!doctype html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <title>Painel de Livros</title>
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <style>
    :root{
      --bg: #f5f7fa;
      --card: #ffffff;
      --muted: #6b7280;
      --border: #e6e9ee;
      --primary: #2563eb;
      --primary-600: #1e40af;
      --accent: #f3f6ff;
      --danger: #ef4444;
      --radius: 10px;
      --shadow: 0 6px 20px rgba(32,41,60,0.06);
      font-family: Inter, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
    }
    html,body{ height:100%; margin:0; background:var(--bg); color:#111827; }
    .wrap{ max-width:980px; margin:32px auto; padding:24px; }
    header{ display:flex; align-items:center; justify-content:space-between; gap:16px; margin-bottom:18px; }
    h1{ margin:0; font-size:20px; letter-spacing:-0.2px; }
    .sub { color:var(--muted); font-size:13px; margin-top:4px; }
    .card { background:var(--card); border-radius:var(--radius); padding:18px; box-shadow:var(--shadow); border:1px solid var(--border); margin-bottom:18px; }
    form.form-row { display:grid; grid-template-columns: 1fr 1fr; gap:12px; align-items:start; }
    form .full { grid-column: 1 / -1; }
    label { display:block; font-size:13px; color:var(--muted); margin-bottom:6px; }
    input[type="text"], textarea { width:100%; padding:10px 12px; border-radius:8px; border:1px solid var(--border); background: #fff; font-size:14px; box-sizing:border-box; }
    textarea { min-height:88px; resize:vertical; }
    .controls { display:flex; gap:10px; align-items:center; margin-top:8px; }
    button.btn { border: none; padding:10px 14px; border-radius:8px; cursor:pointer; font-weight:600; font-size:14px; transition: transform .08s ease, box-shadow .08s ease; }
    button.btn:active { transform:translateY(1px); }
    .btn-primary { background: linear-gradient(180deg,var(--primary),var(--primary-600)); color:#fff; box-shadow: 0 8px 18px rgba(37,99,235,0.12); }
    .btn-secondary { background:transparent; color:var(--primary-600); border:1px solid rgba(37,99,235,0.12); }
    .btn-danger { background:transparent; color:var(--danger); border:1px solid rgba(239,68,68,0.12); }
    .table-wrap { overflow:auto; }
    table { width:100%; border-collapse:collapse; min-width:720px; }
    th,td{ text-align:left; padding:12px 10px; border-bottom:1px solid var(--border); font-size:14px; vertical-align:middle; }
    thead th { color:var(--muted); font-weight:600; font-size:13px; }
    tbody tr:hover { background: var(--accent); }
    .badge { display:inline-block; padding:6px 9px; border-radius:999px; font-size:13px; font-weight:600; }
    .badge-true { background: rgba(37,99,235,0.12); color: var(--primary-600); }
    .badge-false { background: #f3f4f6; color: var(--muted); }
    @media (max-width:760px){ form.form-row { grid-template-columns: 1fr; } .wrap{ padding:16px; } table { min-width:560px; } }
  </style>
</head>
<body>
  <div class="wrap">
    <header>
      <div>
        <h1>Painel de Livros</h1>
        <div class="sub">Gerencie os livros disponíveis — adicionar e remover com segurança</div>
      </div>
      <div style="text-align:right"></div>
    </header>

    <?php if ($status === 'ok'): ?>
      <div class="card" style="border-left:4px solid var(--primary); color:var(--primary-600);">Livro adicionado com sucesso.</div>
    <?php elseif ($status === 'deleted'): ?>
      <div class="card" style="border-left:4px solid var(--primary); color:var(--primary-600);">Livro removido com sucesso.</div>
    <?php endif; ?>

    <div class="card" aria-labelledby="add-title">
      <h2 id="add-title" style="margin:0 0 12px 0; font-size:16px;">Adicionar livro</h2>
      <form method="post" action="../../public/ricardo_controller.php">
        <input type="hidden" name="action" value="add">
        <div class="form-row">
          <div>
            <label for="titulo">Título</label>
            <input id="titulo" name="titulo" type="text" required placeholder="Nome do livro">
          </div>
          <div>
            <label for="autor">Autor</label>
            <input id="autor" name="autor" type="text" required placeholder="Nome do autor">
          </div>

          <div class="full">
            <label for="sinopse">Sinopse</label>
            <textarea id="sinopse" name="sinopse" required placeholder="Breve descrição do livro"></textarea>
          </div>

          <div class="full">
            <label for="resumo">Resumo</label>
            <textarea id="resumo" name="resumo" placeholder="Resumo expandido"></textarea>
          </div>

          <div>
            <label for="lancamento">Lançamento</label>
            <input id="lancamento" name="lancamento" type="text" placeholder="Ex: 26 de junho de 1997">
          </div>

          <div style="display:flex; align-items:center; gap:10px;">
            <label style="margin:0;">
              <input type="checkbox" name="reservado" value="1" style="transform:scale(1.05); margin-right:8px;">
              Reservado
            </label>
          </div>

          <div class="controls full">
            <button type="submit" class="btn btn-primary">Adicionar</button>
            <button type="reset" class="btn btn-secondary">Limpar</button>
          </div>
        </div>
      </form>
    </div>

    <div class="card">
      <h2 style="margin:0 0 12px 0; font-size:16px;">Lista de livros</h2>
      <div class="table-wrap">
        <table role="table" aria-label="Lista de livros">
          <thead>
            <tr>
              <th style="width:60px">ID</th>
              <th>Título</th>
              <th style="width:200px">Autor</th>
              <th style="width:120px">Reservado</th>
              <th>Sinopse</th>
              <th style="width:140px">Lançamento</th>
              <th style="width:130px">Ações</th>
            </tr>
          </thead>
          <tbody>
            <?php if (empty($livros)): ?>
              <tr><td colspan="7" style="color:var(--muted)">Nenhum livro cadastrado.</td></tr>
            <?php else: ?>
              <?php foreach ($livros as $l): ?>
                <tr>
                  <td><?= htmlspecialchars($l['id']) ?></td>
                  <td style="font-weight:600;"><?= htmlspecialchars($l['titulo']) ?></td>
                  <td><?= htmlspecialchars($l['autor']) ?></td>
                  <td>
                    <?php if (!empty($l['reservado'])): ?>
                      <span class="badge badge-true">Reservado</span>
                    <?php else: ?>
                      <span class="badge badge-false">Disponível</span>
                    <?php endif; ?>
                  </td>
                  <td><?= nl2br(htmlspecialchars($l['sinopse'])) ?></td>
                  <td><?= htmlspecialchars($l['lancamento'] ?? '') ?></td>
                  <td>
                    <form method="post" action="../../public/ricardo_controller.php" style="display:inline;">
                      <input type="hidden" name="action" value="delete">
                      <input type="hidden" name="id" value="<?= htmlspecialchars($l['id']) ?>">
                      <button type="submit" class="btn btn-danger" onclick="return confirm('Remover o livro ID <?= htmlspecialchars($l['id']) ?>?')">Remover</button>
                    </form>
                  </td>
                </tr>
                <?php if (!empty($l['resumo'])): ?>
                  <tr>
                    <td></td>
                    <td colspan="6" style="color:var(--muted); font-size:13px;"><strong>Resumo:</strong> <?= nl2br(htmlspecialchars($l['resumo'])) ?></td>
                  </tr>
                <?php endif; ?>
              <?php endforeach; ?>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>

  </div>
</body>
</html>
