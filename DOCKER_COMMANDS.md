# MCPeer - Comandos Docker

## 🐳 Comandos principais

### Desenvolvimento
```bash
# Iniciar ambiente completo
docker-compose up -d

# Ver logs em tempo real
docker-compose logs -f

# Parar containers
docker-compose down

# Rebuild containers (após mudanças no Dockerfile)
docker-compose up -d --build
```

### Laravel dentro do container
```bash
# Executar comandos Laravel
docker-compose exec app php artisan migrate
docker-compose exec app php artisan test
docker-compose exec app php artisan serve

# Instalar dependências
docker-compose exec app composer install
docker-compose exec app composer update
```

### Frontend
```bash
# Node.js dentro do container (se configurado)
docker-compose exec app npm install
docker-compose exec app npm run dev
docker-compose exec app npm run build

# Ou localmente (recomendado para desenvolvimento)
npm install
npm run dev
```

### Database
```bash
# Conectar ao MySQL
docker-compose exec db mysql -u root -p

# Backup do banco
docker-compose exec db mysqldump -u root -p mcpeer > backup.sql

# Restaurar backup
docker-compose exec -T db mysql -u root -p mcpeer < backup.sql
```

### Redis
```bash
# Conectar ao Redis
docker-compose exec redis redis-cli

# Ver estatísticas
docker-compose exec redis redis-cli info
```

### Debugging
```bash
# Ver containers rodando
docker ps

# Ver logs específicos
docker-compose logs app
docker-compose logs webserver
docker-compose logs db
docker-compose logs redis

# Entrar no container
docker-compose exec app bash
```

## 🚀 URLs importantes

- **Aplicação**: http://localhost:8080
- **MySQL**: localhost:3307
- **Redis**: localhost:6380
