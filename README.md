# MCPeer

![MCPeer Logo](./logo.png) <!-- coloque seu logo aqui -->

## O que é o MCPeer?

**MCPeer** é uma plataforma para criar, configurar e gerenciar servidores **Model Context Protocol (MCP)** de forma simples, visual e padronizada.

Com uma interface moderna construída em **PHP + TailwindCSS** e containerizada com **Docker**, o MCPeer permite que empresas, desenvolvedores e equipes criem adaptadores MCP para suas APIs (como GitLab, Jira, Trello, etc) rapidamente, sem a necessidade de codificação manual complexa.

---

## Por que usar o MCPeer?

- Padroniza a implementação do MCP, facilitando a adoção do protocolo em múltiplos sistemas.  
- Permite montar ações MCP (`query`, `mutation`, `stream`) conectadas às APIs existentes via configuração visual ou arquivo YAML/JSON.  
- Gera automaticamente o código backend PHP e configuração Docker pronta para deploy.  
- Suporta dark mode automático via TailwindCSS, garantindo boa usabilidade para todos os usuários.  
- Facilita integrações com IA, chatbots e UIs inteligentes que dependem de MCP para comunicação contextual.

---

## Principais funcionalidades

- Interface web para definir ações MCP, seus parâmetros e handlers HTTP.  
- Geração automática de servidores MCP baseados em Laravel/PHP.  
- Configuração simples de autenticação para APIs externas (Token, Basic, OAuth2).  
- Visualização e teste de respostas MCP dentro da plataforma.  
- Exportação de projetos com Dockerfile e arquivo de especificação MCP (`mcp.json`).  
- Suporte a dark mode conforme preferências do sistema do usuário.

---

## Tecnologias usadas

- Backend: PHP 8.2 com Laravel (ou framework leve à sua escolha)  
- Frontend: Blade + TailwindCSS (dark mode via `prefers-color-scheme`)  
- Containerização: Docker + docker-compose  
- Possível integração futura: OpenAI GPT / Claude para geração automática de ações MCP.

---

## Como começar

### Pré-requisitos

- Docker e docker-compose instalados  
- PHP 8.2+ (para desenvolvimento local)  
- Composer (para dependências PHP)

### Passos

1. Clone o repositório:

   ```bash
   git clone https://github.com/marcellopato/mcpeer
   cd mcpeer
