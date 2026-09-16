# Roadmap — Projeto Enerank

Objetivo geral: transformar o projeto atual (PHP procedural + PDO simples) em uma
aplicação organizada em **MVC**, usando **POO**, com **contas de usuário**, pronta
para **deploy** — aprendendo PHP e boas práticas de programação no processo.

Cada sprint entrega algo que **funciona de ponta a ponta**. Não avance pro próximo
sem conseguir explicar o que o código do sprint atual está fazendo.

---

## Sprint 0 — Organizar a casa (estrutura de pastas MVC) ✅

**Objetivo:** sair do "tudo misturado num arquivo .php" para uma estrutura de pastas
que separa responsabilidades, sem ainda mudar a lógica.

```
enerank/
├── public/                 <- única pasta acessível pelo navegador
│   ├── index.php           <- front controller (todo acesso passa por aqui)
│   └── assets/
│       ├── css/style.css
│       └── img/can.svg
├── app/
│   ├── Controllers/
│   ├── Models/
│   └── Views/
├── config/
│   └── database.php
├── .env
├── .gitignore
└── database.example.php
```

**Tarefas:**
- [x] Criar as pastas acima
- [x] Mover `public/assets` para dentro de `public/`
- [x] Deixar `config/database.php` de fora da pasta pública (ninguém deve acessar
  `seusite.com/database.php` diretamente)

**Por que isso importa:** hoje, qualquer arquivo `.php` na raiz é acessível
diretamente pela URL. Separar uma pasta `public/` como única porta de entrada é o
primeiro passo de segurança de qualquer app PHP real.

---

## Sprint 1 — Classe de conexão (POO + PDO) ✅

**Objetivo:** trocar o `require 'database.php'` com `$pdo` solto por uma classe.

**Tarefas:**
- [x] Criar `app/Models/Database.php` com uma classe `Database` usando o padrão
  **Singleton** (só existe uma conexão PDO ativa por requisição)
- [x] Ler host/usuário/senha de variáveis de ambiente (`.env`), não direto no código
- [x] Testar: qualquer Model deve conseguir pegar a conexão com
  `Database::getConnection()`

**Conceitos novos:** classes, métodos estáticos, singleton, variáveis de ambiente.

---

## Sprint 2 — Models (regra de negócio + banco) ✅

**Objetivo:** cada tabela do banco vira uma classe. As queries saem do meio do HTML.

**Tarefas:**
- [x] Criar `app/Models/Energetico.php` com métodos:
  `all()`, `find($id)`, `create($dados)`, `update($id, $dados)`, `delete($id)`
- [x] Cada método usa PDO com **prepared statements** (você já faz isso — só migra
  pra dentro da classe)
- [x] Nenhum SQL deve sobrar fora dessa classe

**Conceitos novos:** classes como "camada de acesso a dados", separação de
responsabilidades.

---

## Sprint 3 — Controllers + Views (fim do PHP misturado com HTML) ✅

**Objetivo:** separar "o que processa a requisição" de "o que é exibido na tela".

**Tarefas:**
- [x] Criar `app/Controllers/EnergeticoController.php` com métodos
  `index()`, `create()`, `store()`, `edit()`, `update()`, `delete()`
- [x] Criar `app/Controllers/PaginaController.php` com `home()` para a landing page
- [x] Mover o HTML dos `.php` antigos para `app/Views/energetico/` (`listar.php`,
  `criar.php`, `editar.php`) e `app/Views/home.php` — Views só recebem dados
  prontos e exibem, sem lógica de banco
- [x] `public/index.php` vira um **front controller**: lê a rota via `$_GET['rota']`
  e despacha pro Controller/método certo usando `config/routes.php`
- [x] Roteamento implementado como **array de rotas** (`'rota' => [Controller::class, 'metodo']`),
  em vez de `switch`/`if` — mais organizado e fácil de estender
- [x] Composer instalado, com autoload **PSR-4** (`App\` → `app/`), necessário pra
  usar `Controller::class` nas rotas sem `require` manual
- [x] Remover arquivos antigos (`verEnergetico.php`, `criarEnergetico.php`,
  `editarEnergetico.php`) após migração completa

**Conceitos novos:** MVC na prática, roteamento via array, front controller,
autoload PSR-4 com Composer, `call_user_func` para despachar dinamicamente.

---

## Sprint 4 — Contas de usuário (cadastro e login)

**Objetivo:** pessoas conseguem criar conta e logar.

**Tarefas:**
- [ ] Nova tabela `usuarios` (id, nome, email, senha_hash)
- [ ] `Model` de usuário, com `password_hash()` e `password_verify()`
  (**nunca** salvar senha em texto puro)
- [ ] `AuthController` com `register()`, `login()`, `logout()`
- [ ] Usar `session_start()` para manter o usuário logado entre páginas
- [ ] Proteger rotas: usuário não logado não pode criar/editar/excluir avaliações

**Conceitos novos:** hashing de senha, sessions, middlewares simples de autenticação.

---

## Sprint 5 — Relacionar avaliações a usuários

**Objetivo:** cada energético avaliado pertence a quem avaliou.

**Tarefas:**
- [ ] Adicionar coluna `usuario_id` na tabela `energeticos` (chave estrangeira)
- [ ] Ao criar uma avaliação, salvar o `usuario_id` da sessão atual
- [ ] Só o dono da avaliação pode editar/excluir a própria (checar isso no
  Controller antes de executar)

**Conceitos novos:** relacionamentos entre tabelas (1 usuário → N avaliações),
autorização (diferente de autenticação).

---

## Sprint 6 — Hardening (segurança básica)

**Objetivo:** fechar brechas comuns antes de colocar na internet.

**Tarefas:**
- [ ] Proteção contra CSRF nos formulários (token oculto)
- [ ] Validação de dados no backend (não confiar só no HTML5 `required`)
- [ ] Escapar toda saída de dados do usuário com `htmlspecialchars()` nas Views
  (evita XSS)
- [ ] Rate limit simples ou captcha no login (evita força bruta), se quiser ir além

**Conceitos novos:** CSRF, XSS, validação de entrada vs. saída.

---

## Sprint 7 — Deploy

**Objetivo:** colocar o site no ar para outras pessoas usarem.

**Tarefas:**
- [ ] Escolher hospedagem (ex: Railway, Render, Hostinger, ou uma VPS com Ubuntu)
- [ ] Configurar variáveis de ambiente de produção (não subir `.env` real pro Git)
- [ ] Configurar banco MySQL no provedor escolhido
- [ ] Apontar domínio (se tiver) ou usar a URL gerada pelo provedor
- [ ] Testar o fluxo completo em produção: cadastro, login, criar/editar/excluir

---

## Depois disso (ideias para continuar aprendendo)

- Testes automatizados (PHPUnit)
- Migrar para um micro-framework (Slim, ou até Laravel, pra comparar com o que
  você fez na mão)
- Upload de imagem real de cada energético
- Página de perfil do usuário com histórico de avaliações

---

### Como usar este roadmap
Trate cada sprint como um checkpoint. Ao terminar um, peça pra eu revisar o código
antes de seguir — isso ajuda a pegar maus hábitos cedo e a consolidar o conceito
antes de empilhar complexidade em cima.