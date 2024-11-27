Sistema de Notas - Projeto de Gestão Escolar
Este projeto foi desenvolvido para o gerenciamento de notas dos alunos de uma instituição de ensino. Ele permite o cadastro das informações dos alunos, incluindo suas notas, e calcula a média. Os dados dos alunos são armazenados em um banco de dados MySQL. Além disso, é possível visualizar os alunos cadastrados e seus respectivos dados.

Funcionalidades
Cadastro de informações de alunos (Nome, RGM, Turma, Nota 1, Nota 2).
Cálculo automático da média das notas.
Armazenamento dos dados no banco de dados MySQL.
Visualização dos alunos cadastrados e suas notas.
Capacidade de limpar os registros dos alunos no banco de dados.
Tecnologias Utilizadas
PHP: Para lógica do servidor e manipulação dos formulários.
MySQL: Para armazenamento e recuperação de dados.
HTML/CSS: Para a construção da interface web.
Como Rodar o Projeto
Requisitos
Servidor Apache (ou outro servidor web).
PHP instalado.
MySQL instalado.
Passos para Configuração
Clone o repositório:

Se você ainda não tem o projeto, faça o clone ou baixe os arquivos do repositório.

Configuração do Banco de Dados:

O projeto utiliza o banco de dados sistema_escolar. Para criar o banco de dados e a tabela de alunos, execute os seguintes comandos no seu banco de dados MySQL:

sql
Copiar código
CREATE DATABASE sistema_escolar;
USE sistema_escolar;

CREATE TABLE alunos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100),
    rgm VARCHAR(20),
    turma VARCHAR(20),
    nota1 DECIMAL(5,2),
    nota2 DECIMAL(5,2),
    media DECIMAL(5,2)
);
Configuração do Servidor Web:

Coloque os arquivos do projeto na pasta pública do seu servidor web (ex.: htdocs no XAMPP).

Conexão com o Banco de Dados:

O arquivo de configuração de banco de dados é o processar_notas.php. Verifique se a conexão com o banco de dados está configurada corretamente:

php
Copiar código
$conn = new mysqli("localhost", "root", "", "sistema_escolar");
Certifique-se de que o banco de dados e as credenciais de acesso estão corretos.

Acessando o Projeto:

Abra o navegador e vá até http://localhost/nome_do_projeto/notas.php para começar a usar o sistema.

Estrutura do Projeto
bash
Copiar código
- / (diretório principal)
  - /css (diretório de estilos CSS)
    - style.css
  - /assets (imagens e outros recursos)
    - bg-desktop-light.jpg
  - processar_notas.php (lógica de inserção no banco de dados)
  - visualizar_alunos.php (exibe os alunos cadastrados)
  - notas.php (formulário para inserção de notas)
  - index.php (página inicial)
  - .htaccess (se necessário para configuração de URL)
  - README.md (este arquivo)
Fluxo do Sistema
Cadastro de Notas:

O usuário preenche o formulário com as informações do aluno (Nome, RGM, Turma, Nota 1 e Nota 2).
O sistema calcula automaticamente a média das notas.
O sistema armazena as informações no banco de dados.
Visualização de Alunos:

O usuário pode visualizar todos os alunos cadastrados na base de dados, incluindo suas notas e médias.
Limpeza de Dados:

O administrador pode optar por limpar os dados no banco de dados a qualquer momento usando o comando para truncar a tabela.
Exemplo de Uso
Cadastrar um aluno
Acesse a página de notas.php.
Preencha os campos de nome, RGM, turma, nota 1 e nota 2.
O sistema calcula a média automaticamente.
Clique em Enviar para registrar o aluno no banco de dados.
Visualizar alunos
Acesse a página de visualizar_alunos.php.
Você verá uma tabela com todos os alunos cadastrados, suas notas e a média calculada.
Considerações Finais
Este projeto pode ser expandido para incluir funcionalidades adicionais, como a edição e remoção de registros, autenticação de usuários (login e senha), exportação de notas para PDF, entre outras.

Se você tiver sugestões ou melhorias, fique à vontade para contribuir!

Licença
Este projeto é de código aberto e pode ser utilizado e modificado conforme necessário. Se você modificar o código, não se esqueça de dar os devidos créditos.
