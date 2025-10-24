## 👨‍💻 Autor

<div align="center">
  <img src="https://avatars.githubusercontent.com/ninomiquelino" width="100" height="100" style="border-radius: 50%">
  <br>
  <strong>Onivaldo Miquelino</strong>
  <br>
  <a href="https://github.com/ninomiquelino">@ninomiquelino</a>
</div>

---

# 🔠 Real-Time Slug Generator: PHP & JavaScript Debounce

![Made with PHP](https://img.shields.io/badge/PHP-777BB4?logo=php&logoColor=white)
![Frontend JavaScript](https://img.shields.io/badge/Frontend-JavaScript-F7DF1E?logo=javascript&logoColor=black)
![TailwindCSS](https://img.shields.io/badge/TailwindCSS-38B2AC?logo=tailwindcss&logoColor=white)
![License MIT](https://img.shields.io/badge/License-MIT-green)
![Status Stable](https://img.shields.io/badge/Status-Stable-success)
![Version 1.0.0](https://img.shields.io/badge/Version-1.0.0-blue)
![GitHub stars](https://img.shields.io/github/stars/NinoMiquelino/seo-slug-generator?style=social)
![GitHub forks](https://img.shields.io/github/forks/NinoMiquelino/seo-slug-generator?style=social)
![GitHub issues](https://img.shields.io/github/issues/NinoMiquelino/seo-slug-generator)

Este projeto demonstra a colaboração eficiente entre o backend PHP (para lógica de negócios complexa) e o frontend JavaScript (para usabilidade em tempo real). Ele gera automaticamente um slug amigável para URLs e fornece feedback de SEO conforme o usuário digita.

---

## ⚡ Recursos Principais

* **Manipulação de Strings em PHP:** O PHP é usado para realizar a tarefa mais complexa: remover acentos (diacríticos), converter para minúsculas e sanitizar a string para gerar um slug seguro e amigável para URLs.
* **Debouncing com JavaScript:** Uma funcionalidade essencial de UX. O JavaScript utiliza a técnica de **Debouncing** para garantir que a requisição AJAX ao PHP só seja disparada após um breve período de inatividade na digitação, evitando sobrecarregar o servidor.
* **Comunicação JSON:** O frontend envia o título como JSON (`fetch` POST) e o PHP retorna o slug e um array de feedback de SEO no formato JSON.
* **Análise de SEO Simples:** O PHP inclui uma análise básica de comprimento de título e slug, oferecendo feedback instantâneo ao usuário.

---

## 🧠 Tecnologias utilizadas

* **Backend:** PHP 7.4+ (Focado em `iconv` e regex para manipulação de strings).
* **Frontend:** HTML5, JavaScript Vanilla e `fetch` API.
* **Técnica:** JavaScript Debouncing.
* **Estilização:** Tailwind CSS (via CDN).

---

## 🧩 Estrutura do Projeto

```
seo-slug-generator/
├── index.html
├── api.php
├── README.md
├── .gitignore
└── LICENSE
```
---

## ⚙️ Configuração e Instalação

### Pré-requisitos

1.  Um ambiente de servidor web com PHP.
2.  (Opcional, mas recomendado) A extensão `iconv` do PHP ativada para melhor tratamento de acentos.

### 1. Estrutura

1.  Crie a estrutura de pastas conforme o diagrama. Não há necessidade de pastas adicionais como `uploads/` ou `cache/` neste projeto.

### 2. Executar o Servidor

Utilize o servidor embutido do PHP para testes (a partir da raiz do projeto):

```bash
php -S localhost:8001
```

​• Acesse: O frontend estará disponível em http://localhost:8001/public/index.html.

```javascript
// public/index.html
const API_URL = 'http://localhost:8001/src/api.php'; 

```

---

## 📝 Instruções de Uso
​Acesse a página do projeto no seu navegador.
​Comece a digitar um título no campo de entrada, por exemplo: Título de Artigo Chique, com Acentos e Símbolos: Será que Funciona?!.
​Observe o seguinte:
​O slug na caixa cinza abaixo do campo de título será atualizado apenas quando você fizer uma pausa na digitação (devido ao Debounce).
​O resultado do slug será limpo: titulo-de-artigo-chique-com-acentos-e-simbolos-sera-que-funciona.
​O painel de Feedback de SEO será atualizado com as análises retornadas pelo PHP.

---

## 🤝 Contribuições
Contribuições são sempre bem-vindas!  
Sinta-se à vontade para abrir uma [*issue*](https://github.com/NinoMiquelino/seo-slug-generator/issues) com sugestões ou enviar um [*pull request*](https://github.com/NinoMiquelino/seo-slug-generator/pulls) com melhorias.

---

## 💬 Contato
📧 [Entre em contato pelo LinkedIn](https://www.linkedin.com/in/onivaldomiquelino/)  
💻 Desenvolvido por **Onivaldo Miquelino**

---
