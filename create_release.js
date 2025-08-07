const fs = require('fs');
const https = require('https');

// Lê o conteúdo das release notes
const releaseNotes = fs.readFileSync('temp_release_notes.md', 'utf8');

// Dados da release
const releaseData = {
  tag_name: 'v1.0.0-alpha',
  name: 'MCPeer v1.0.0-alpha - Initial Alpha Release 🚀',
  body: releaseNotes,
  draft: false,
  prerelease: true
};

// Opções da requisição
const options = {
  hostname: 'api.github.com',
  port: 443,
  path: '/repos/marcellopato/mcpeer/releases',
  method: 'POST',
  headers: {
    'User-Agent': 'MCPeer-Release-Creator',
    'Accept': 'application/vnd.github.v3+json',
    'Content-Type': 'application/json'
  }
};

// Fazer a requisição
const req = https.request(options, (res) => {
  let data = '';
  
  res.on('data', (chunk) => {
    data += chunk;
  });
  
  res.on('end', () => {
    if (res.statusCode === 201) {
      console.log('✅ Release created successfully!');
      console.log('🔗 Release URL:', JSON.parse(data).html_url);
    } else {
      console.log('❌ Error creating release');
      console.log('Status Code:', res.statusCode);
      console.log('Response:', data);
    }
  });
});

req.on('error', (e) => {
  console.error('❌ Request error:', e.message);
});

// Enviar os dados
req.write(JSON.stringify(releaseData));
req.end();

console.log('🚀 Creating GitHub release...');
