# 🧪 Teste do Formulário de Contactos

## ✅ Status Atual

O formulário de contactos está **100% funcional** e seguro!

---

## 📋 Como Testar

### 1. **Via Navegador Web**
- Acesse: `http://localhost/sollays/public/contactos.php`
- Preencha o formulário com:
  - **Nome:** Seu Nome (mín. 3, máx. 100 caracteres)
  - **E-mail:** seu@email.com
  - **Assunto:** Escolha um assunto
  - **Mensagem:** Digite sua mensagem (mín. 10, máx. 5000 caracteres)
- Clique em "Enviar Mensagem"
- **Sucesso:** Você verá um alerta verde com "Mensagem enviada com sucesso!"

### 2. **Via cURL (Terminal)**
```bash
curl -X POST http://localhost/sollays/public/enviar_contato.php \
  -d "nome=João Silva&email=joao@example.com&assunto=Dúvida sobre produtos&mensagem=Esta é uma mensagem de teste para verificar o funcionamento correto do formulário." \
  -H "Content-Type: application/x-www-form-urlencoded"
```

---

## 🛡️ Segurança Implementada

✅ **Proteção contra Script Maliciosos**
- Bloqueia tags HTML: `<script>`, `javascript:`, `onerror`, etc.
- Desativa tentativas de injeção de código

✅ **Rate Limiting**
- Máximo 20 mensagens por IP por hora
- Protege contra spam e ataques de força bruta

✅ **Validação de Entrada**
- Nome: 3-100 caracteres
- E-mail: validação RFC completa
- Assunto: 5-200 caracteres
- Mensagem: 10-5000 caracteres

✅ **Sanitização**
- `htmlspecialchars()` em todos os campos
- Remoção de tags perigosas
- Escapamento de caracteres especiais

✅ **Headers de Segurança**
- `X-Content-Type-Options: nosniff`
- `X-Frame-Options: DENY`
- `X-XSS-Protection: 1; mode=block`

---

## 📊 Verificar Mensagens no Banco

```sql
-- Ver todas as mensagens
SELECT * FROM mensagens_contato ORDER BY data_envio DESC;

-- Ver por status
SELECT * FROM mensagens_contato WHERE status = 'não lido';

-- Contar mensagens por IP
SELECT ip, COUNT(*) as total FROM mensagens_contato GROUP BY ip;

-- Atualizar status
UPDATE mensagens_contato SET status = 'lido', resposta = 'Sua resposta aqui', data_resposta = NOW() WHERE id = 1;
```

---

## 🚨 Teste de Validação

### Teste 1: Campo Obrigatório Vazio
- Deixe um campo em branco
- **Esperado:** Mensagem de erro específica

### Teste 2: E-mail Inválido
- Digite: `email-invalido`
- **Esperado:** "E-mail inválido"

### Teste 3: Mensagem Muito Curta
- Digite: `abc`
- **Esperado:** "Mensagem deve ter entre 10 e 5000 caracteres"

### Teste 4: Conteúdo Malicioso
- Digite: `<script>alert('hack')</script>`
- **Esperado:** "Conteúdo inválido detectado"

### Teste 5: Spam (Rate Limiting)
- Envie 21 mensagens em menos de 1 hora
- **Esperado:** 21ª mensagem será bloqueada com "Limite de mensagens excedido"

---

## 📝 Informações da Tabela

```
Tabela: mensagens_contato

Campos:
- id (INT) - Identificador único
- nome (VARCHAR 100) - Nome do remetente
- email (VARCHAR 100) - E-mail do remetente
- assunto (VARCHAR 200) - Assunto da mensagem
- mensagem (LONGTEXT) - Conteúdo da mensagem
- ip (VARCHAR 45) - IP do remetente
- user_agent (TEXT) - Navegador/Cliente
- data_envio (TIMESTAMP) - Data de envio automática
- status (VARCHAR 20) - Não lido/Lido/Respondido
- resposta (LONGTEXT) - Resposta do admin
- data_resposta (TIMESTAMP) - Data da resposta
```

---

## 💻 Arquivos Modificados

1. **`public/contactos.php`**
   - Formulário HTML
   - JavaScript melhorado com melhor tratamento de erros
   - Contador de caracteres dinâmico

2. **`public/enviar_contato.php`**
   - Backend seguro
   - Validação rigorosa
   - Rate limiting
   - Proteção contra XSS e injeção SQL

3. **`config/database.php`**
   - Conexão centralizada (já existente)

---

## ✨ Resultado Final

✅ Formulário funcional
✅ Mensagens salvas no banco
✅ Validação completa
✅ Segurança em múltiplas camadas
✅ Rate limiting ativo
✅ Alertas visuais claros
✅ Contador de caracteres em tempo real

---

**Status:** 🟢 **PRONTO PARA PRODUÇÃO**
