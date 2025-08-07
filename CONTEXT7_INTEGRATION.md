# Context7 Integration Demo

Este é um exemplo prático de como o MCPeer pode gerenciar servidores MCP externos, usando o **Context7** da Upstash como demonstração.

## 🎯 O que é Context7?

Context7 é um serviço que resolve o problema de **documentação desatualizada** em LLMs, fornecendo:

- ✅ **Documentação atualizada** específica por versão
- ✅ **Exemplos reais** que funcionam
- ✅ **Informação concisa** sem "enchimento"
- ✅ **Integração MCP** com ferramentas como Cursor

## 🚀 Como usar esta demonstração

### 1. Configurar o exemplo
```bash
# Via Docker (recomendado)
docker-compose exec app php artisan mcpeer:setup-context7

# Ou localmente
php artisan mcpeer:setup-context7
```

### 2. Acessar a demonstração
- **Dashboard**: http://localhost:8080 → Context7 Demo
- **Direto**: http://localhost:8080/context7/demo
- **Servidores**: http://localhost:8080/mcp/servers → Context7 Documentation Server

### 3. Testar funcionalidades

#### Query Documentation
- Escolha uma biblioteca (Laravel, React, Vue.js, etc.)
- Digite o que quer aprender (routing, authentication, etc.)
- Veja documentação atualizada com exemplos

#### Search Libraries
- Busque por funcionalidades específicas
- Filtre por linguagens de programação
- Compare relevância entre bibliotecas

## 📊 Dados criados automaticamente

O seeder cria:

### MCPServer: Context7 Documentation Server
- **Nome**: Context7 Documentation Server
- **Slug**: context7-docs
- **Porta**: 3001
- **Status**: Active
- **Capabilities**: Queries ✅, Mutations ❌, Streams ✅

### MCPActions (4 ações):

1. **query_documentation** (Query)
   - Consultar documentação específica com exemplos
   - Parâmetros: library, query, version, include_examples

2. **search_libraries** (Query)
   - Buscar em múltiplas bibliotecas
   - Parâmetros: search_term, languages[], categories[]

3. **compare_libraries** (Query)
   - Comparar bibliotecas para casos específicos
   - Parâmetros: libraries[], use_case, criteria[]

4. **stream_updates** (Stream)
   - Atualizações em tempo real de documentação
   - Parâmetros: libraries[], update_types[]

## 🛠️ Integração técnica

### Simulação de API
Como o Context7 ainda está em desenvolvimento, a demo simula respostas realistas:

```php
// Exemplo de resposta simulada
[
    'documentation' => 'Laravel 10.x - routing',
    'description' => 'Laravel is a web application framework...',
    'examples' => [
        [
            'title' => 'Basic Route Definition',
            'code' => "Route::get('/users', [UserController::class, 'index']);",
            'language' => 'php'
        ]
    ]
]
```

### Endpoints de demonstração
- `POST /context7/demo/query` - Simula query de documentação
- `POST /context7/demo/search` - Simula busca entre bibliotecas

## 🔗 Recursos Context7

- **Website**: https://context7.com
- **GitHub**: https://github.com/upstash/context7
- **MCP Server**: https://mcp.context7.com/mcp
- **Integração Cursor**: Add to Cursor via website

## 💡 Casos de uso reais

### Para desenvolvedores
- Consultar documentação Laravel 10.x específica
- Buscar componentes React atuais
- Comparar frameworks Python para APIs

### Para equipes
- Padronizar conhecimento sobre bibliotecas
- Integrar com ferramentas de desenvolvimento
- Automatizar consultas de documentação

### Para produtos
- Chatbots com conhecimento atualizado
- Assistentes de código inteligentes
- Suporte técnico automatizado

## 🎓 O que esta demo ensina sobre MCPeer

1. **Gerenciamento de servidores externos** - Como integrar APIs externas
2. **Configuração visual** - Interface para definir ações MCP
3. **Testing em tempo real** - Validação de integrações
4. **Geração automática** - Configs Docker e MCP prontas
5. **Documentação viva** - Exemplos funcionais

## 🔄 Próximos passos

1. **Teste a demo** - Experimente as funcionalidades
2. **Veja o código gerado** - Examine configs MCP e Docker
3. **Crie seus próprios servidores** - Use como base para APIs reais
4. **Integre com Context7 real** - Quando disponível publicamente

---

**Esta demonstração mostra o poder do MCPeer para gerenciar o ecossistema MCP de forma visual e intuitiva! 🚀**
