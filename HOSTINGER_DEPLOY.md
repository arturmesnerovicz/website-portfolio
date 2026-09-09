# Guia de Deploy - Estúdio Norra na Hospedagem Compartilhada Hostinger

Este guia descreve o processo simplificado para publicar a nova aplicação web do Estúdio Norra na Hostinger.

---

## 1. Configuração do Domínio e PHP no hPanel

1. Acesse o **hPanel da Hostinger** > **Sites** > Selecione `estudionorra.com`.
2. Vá em **Avançado** > **Configuração do PHP**:
   - Selecione **PHP 8.2**, **PHP 8.3** ou **PHP 8.4**.
   - Certifique-se de que as extensões `pdo_sqlite`, `pdo_mysql`, `intl`, `mbstring`, `fileinfo`, `zip`, `curl` estejam marcadas (padrão da Hostinger).
3. Vá em **Sites** > **Gerenciar** > **Diretório Raiz (Document Root)**:
   - Se o hPanel permitir alterar o diretório raiz, aponte para `public_html/public`.
   - Se não permitir alterar, o arquivo `.htaccess` na raiz do projeto já redireciona automaticamente e com segurança para `public/`.

---

## 2. Envio dos Arquivos

### Opção A: Via Git no hPanel (Recomendado)
1. No hPanel, vá em **Avançado** > **Git**.
2. Configure o repositório Git e a branch `main`.
3. Defina o diretório de instalação como `public_html`.
4. Clique em **Criar / Implementar**.

### Opção B: Via SSH ou FTP / Gerenciador de Arquivos
1. Compacte o projeto (excluindo `vendor/` e `node_modules/`).
2. Envie para o diretório `public_html/`.
3. Descompacte os arquivos.

---

## 3. Configuração do `.env`

1. Copie o arquivo `.env.production.example` para `.env`:
   ```bash
   cp .env.production.example .env
   ```
2. Gere a chave de aplicação:
   ```bash
   php artisan key:generate --ansi
   ```
3. Configure as credenciais do seu e-mail corporativo (`contato@estudionorra.com` no Titan Mail da Hostinger) nos campos `MAIL_USERNAME` e `MAIL_PASSWORD`.

---

## 4. Banco de Dados e Permissões

### Usando SQLite (Padrão e Recomendado para Shared Hosting):
1. O banco SQLite já fica isolado em `database/database.sqlite`, garantindo zero latência de rede e sem necessidade de provisionar servidor MySQL.
2. Certifique-se de que as permissões dos diretórios estejam liberadas para o servidor web:
   ```bash
   chmod -R 775 storage bootstrap/cache database
   ```
3. Execute as migrações e popule o conteúdo:
   ```bash
   php artisan migrate --force
   php artisan db:seed --force
   ```

---

## 5. Storage Symlink e Otimização de Produção

Execute os comandos finais de otimização:
```bash
php artisan storage:link
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

Ou simplesmente execute o script automatizado:
```bash
bash deploy-hostinger.sh
```

---

## 6. Acesso ao Painel Administrativo Filament

- **URL do Painel:** `https://estudionorra.com/admin`
- **E-mail:** `teste@estudionorra.com`
- **Senha:** `12345678`

No painel, você tem controle total sobre:
- **Configurações Gerais do Site:** Slogans, métricas, dados de SEO e links.
- **Hero Slides:** Textos e imagens da seção principal.
- **Projetos Selecionados:** Inserção, edição de mockups e tags.
- **Expertise (Serviços):** Textos e entregáveis do acordeom.
- **Jornada do Projeto:** Descrição e imagens das 4 etapas.
- **Perguntas Frequentes (FAQ):** Respostas editáveis.
- **Leads:** Gestão e acompanhamento das mensagens recebidas pelo formulário.
