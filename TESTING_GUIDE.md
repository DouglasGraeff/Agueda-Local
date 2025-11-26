# 🧪 Guia de Testes - Águeda Local API

## 📋 Índice
1. [Instalação do Postman](#instalação-do-postman)
2. [Importar Collection](#importar-collection)
3. [Configurar Ambiente](#configurar-ambiente)
4. [Sequência de Testes](#sequência-de-testes)
5. [Troubleshooting](#troubleshooting)

---

## 🔧 Instalação do Postman

### Opção 1: Download Direto
1. Aceda a [postman.com](https://www.postman.com/downloads/)
2. Clique em "Download"
3. Escolha seu SO (Windows, Mac, Linux)
4. Instale normalmente

### Opção 2: Chocolatey (Windows)
```powershell
choco install postman
```

### Opção 3: Winget (Windows 11+)
```powershell
winget install Postman.Postman
```

---

## 📥 Importar Collection

### Passo 1: Abrir Postman
1. Abra a aplicação Postman
2. Clique em **"File"** → **"Import"** ou use o botão **"Import"** no canto superior esquerdo

### Passo 2: Importar Ficheiro
1. Clique em **"Upload Files"** na janela de importação
2. Navegue até ao ficheiro `postman_collection.json` do projeto
3. Clique em **"Import"**
   - Collection: "Agueda Local API"
   - Variables: base_url, token, user_uuid, user_id

### Passo 3: Verificar Import
- No painel esquerdo, deverá ver:
  ```
  📁 Agueda Local API
    ├── Health Check
    ├── 📁 Auth
    │   ├── Register - Consumidor
    │   ├── Register - Produtor
    │   ├── Login
    │   └── Logout
    └── 📁 Users
        ├── Get My Profile
        ├── Get User Profile (Public)
        ├── Update My Profile
        ├── Update Password
        └── Delete My Account
  ```

---

## ⚙️ Configurar Ambiente

### Passo 1: Abrir Variáveis da Collection
1. No painel esquerdo, clique em **"Agueda Local API"** (nome da collection)
2. Clique em **"Variables"** na aba superior
3. Deverá ver as variáveis pré-configuradas:
   ```
   base_url = http://localhost:8000/api
   token = (vazio - será preenchido após login)
   user_uuid = (vazio - será preenchido após login)
   user_id = (vazio - será preenchido após login)
   ```

### Passo 2: Ajustar Base URL (se necessário)
- Se o servidor Laravel está em outro porto, altere `base_url` para:
  - `http://localhost:8000/api` (padrão Laravel)
  - `http://localhost:3000/api` (se porta 3000)
  - `http://192.168.x.x:8000/api` (se servidor remoto)

### Passo 3: Salvar Variáveis
- Clique em **"Save"** (Ctrl + S) após fazer alterações

---
Testar as rotas