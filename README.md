<div>
  <a href="https://imgbox.com/Wa5LeIEx" target="_blank"><img src="https://thumbs2.imgbox.com/3c/83/Wa5LeIEx_t.jpeg" alt="image host"/></a>
</div>

---

Construção de sistema web como parte do teste técnico para a vaga de Desenvolvedor PHP.

---

#### Requisitos para executar o sistema:
* Docker
* Git
* Apache
* MySQL
* PhpMyAdmin
* JavaScript

---

#### Configuração e execução do projeto
* Clonar o repositório atual para sua máquina local:

    `git clone https://github.com/cebpereira/teste-turim`

* Navegar para a pasta do projeto:

    `cd teste-turim`

* Executar o comando abaixo no terminal:

    `docker compose up -d`

* Aguarde a execução do comando terminar, em caso de sucesso, os containers estarão ativos e o projeto estará rodando via localhost nas seguintes portas:
    * 8080 -> PhpMyAdmin
    * 3306 -> MySQL
    * 80 -> Apache

* Configure o arquivo 'db_config.php' com seus dados de conexão com o banco, exemplo:

    ` $host = "mysql_db";
      $user = "root";
      $password = "root";
      $db = "mysql-db";`


* Utilizando o phpMyAdmin, crie as tabelas necessárias ou chame a função criarBD presente em PessoaController:

    `CREATE TABLE IF NOT EXISTS pessoas (
      	id INT AUTO_INCREMENT PRIMARY KEY,
      	nome VARCHAR(255) NOT NULL
    );`

    `CREATE TABLE IF NOT EXISTS filhos (
      	id INT AUTO_INCREMENT PRIMARY KEY,
      	nome VARCHAR(255) NOT NULL,
      	pessoa_id INT,
      	FOREIGN KEY (pessoa_id) REFERENCES pessoas(id) ON DELETE CASCADE
    );`
 
* A rota inicial do projeto é a localhost

---
 
> [!NOTE]
> Em caso de sugestões, correções ou dúvidas:
> [LinkedIn](https://www.linkedin.com/in/cebpereira/),
> [Instagram](https://www.instagram.com/c_elandro/)
> ou pelo email c.elandro.bp@gmail.com
