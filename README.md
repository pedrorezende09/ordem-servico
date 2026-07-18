# Sistema de Gestão de Ordens de Serviço

Sistema web desenvolvido em **Laravel** para gerenciamento de clientes e ordens de serviço, permitindo o controle completo do ciclo de atendimento, histórico de alterações, pagamentos e indicadores administrativos.

---

## 📖 Sobre o Projeto

Este sistema foi desenvolvido com o objetivo de aplicar conceitos de desenvolvimento web utilizando o framework Laravel, empregando a arquitetura MVC e recursos como autenticação, validação por Form Requests, relacionamentos entre entidades, paginação, filtros avançados e geração de relatórios em PDF.

---

# 🚀 Funcionalidades

- Dashboard administrativo
- CRUD completo de clientes
- CRUD completo de ordens de serviço
- Histórico de alterações
- Busca e filtros avançados
- Paginação
- Controle de pagamentos
- Exportação em PDF
- Autenticação de usuários
- Interface responsiva utilizando Tailwind CSS

---

# 🖥️ Telas do Sistema

## Dashboard

Painel principal contendo indicadores do sistema, métricas financeiras, gráfico de status das ordens e últimas ordens cadastradas.

![Dashboard](docs/dashboard.png)

---

# 👥 Clientes

## Listagem

![Clientes](docs/clientes.png)

---

## Listagem (Paginação)

![Clientes 2](docs/clientes2.png)

---

## Cadastro

![Cadastrar Cliente](docs/cliente-cadastrar.png)

---

## Busca

![Buscar Cliente](docs/clientes-buscar.png)

---

# 📋 Ordens de Serviço

## Listagem

![Ordens](docs/ordens-servico.png)

---

## Listagem (Paginação)

![Ordens 2](docs/ordens-servico2.png)

---

## Cadastro de Nova Ordem

![Nova Ordem](docs/ordens-servico-criarNovaOrdem.png)

---

## Visualização da Ordem

![Visualizar Ordem](docs/ordens-servico-visualizar.png)

![Visualizar Ordem 2](docs/ordens-servico-visualizar2.png)

---

## Edição

![Editar Ordem](docs/ordens-servico-editar.png)

---

## Validação utilizando Form Request

![Editar Form Request](docs/ordens-servico-editarFormrequest.png)

---

## Exclusão

![Excluir](docs/ordens-servico-excluirFormrequest.png)

![Excluir 2](docs/ordens-servico-excluir-FormRequest2.png)

---

## Histórico de Alterações

![Histórico](docs/ordens-servico-historico.png)

---

## Exportação em PDF

![PDF](docs/ordens-servico-pdf.png)

---

# 🔍 Filtros

## Busca por Cliente

![Busca Cliente](docs/ordens-servico-buscarCliente.png)

---

## Painel de Filtros

![Filtros](docs/ordens-servico-filtros.png)

---

## Filtro por Código

![Filtro Código](docs/ordens-servico-filtrar-codigo.png)

---

## Filtro por Data

![Filtro Data](docs/ordens-servico-filtrar-data.png)

---

## Filtro por Status

![Filtro Status](docs/ordens-servico-filtrar-emAndamento.png)

---

## Filtro por Pagamento

![Filtro Pago](docs/ordens-servico-filtrar-pago.png)

---

## Filtro por Valor Máximo

![Filtro Valor](docs/ordens-servico-filtrar-valorMaximo.png)

---

# 🔐 Autenticação

## Login

![Autenticação](docs/sistema-autenticacao.png)

---

## Atualização de Cadastro

![Atualizar Cadastro](docs/sistema-autenticacao-atualizar-cadastro.png)

---

# 🛠️ Tecnologias Utilizadas

- PHP 8
- Laravel
- Blade
- Tailwind CSS
- MySQL
- Eloquent ORM
- Chart.js
- DomPDF
- Vite

---

# 📂 Estrutura do Projeto

```
app/
├── Http/
│   ├── Controllers/
│   ├── Requests/
│   └── Middleware/
│
├── Models/
│
database/
├── migrations/
├── seeders/
│
resources/
├── views/
│
routes/
│
public/
│
docs/
```

---

# ⚙️ Instalação

Clone o repositório:

```bash
git clone https://github.com/pedrorezende09/ordem-servico.git
```

Entre na pasta:

```bash
cd ordem-servico
```

Instale as dependências do PHP:

```bash
composer install
```

Instale as dependências do frontend:

```bash
npm install
```

Copie o arquivo de configuração:

```bash
cp .env.example .env
```

Gere a chave da aplicação:

```bash
php artisan key:generate
```

Configure o banco de dados no arquivo `.env`.

Execute as migrations:

```bash
php artisan migrate
```

Inicie o ambiente de desenvolvimento:

```bash
composer run dev
```

A aplicação estará disponível em:

```
http://127.0.0.1:8000
```

---

# 🗄️ Banco de Dados

O projeto utiliza **MySQL**, com criação automática das tabelas por meio das migrations do Laravel.

---

# ✅ Funcionalidades Implementadas

- Dashboard administrativo
- CRUD de Clientes
- CRUD de Ordens de Serviço
- Histórico de alterações
- Autenticação de usuários
- Controle de pagamentos
- Paginação
- Busca
- Filtros avançados
- Exportação em PDF
- Relacionamentos utilizando Eloquent ORM
- Validação através de Form Requests

---

# 📈 Melhorias Futuras

- Soft Delete
- Dashboard mais interativo
- Relatórios estatísticos
- PDF individual da ordem de serviço
- Ordenação dinâmica das tabelas
- Estatísticas por cliente
- Melhorias de UI/UX

---

# 👨‍💻 Autor

**Pedro Rezende**

Estudante de Sistemas de Informação

Universidade Vale do Rio Doce (UNIVALE)

---

# 📄 Licença

Projeto desenvolvido para fins acadêmicos e de estudo.