# fundamentos_symfony
* Instalação e configuração do hambiente.
    * Arquivo .env (Configuração local para cada maquina)
    
* ROUTE
    * Configuração das rotas por yaml
    * Arquivo de configuração config/routes
        * Faz a ligação entre a URL e o CONTROLLER
        * É preciso passar o caminho do controller + nome do controller + :: nome do metodo
            * task:
                path: /task
                controller: App\Controller\TaskController::index
        * Definindo paramentro padrão para rota
            * show:
                path: /task/{id}
                controller: App\Controller\TaskController::show
                requirements:
                  id: '\d+'
        * Atributo opcional e valor padrão
            * eX: defaults: 
                    id: 10
        * Definido métodos HTTP aceitos na rota
            * Requisição dever feita de modo correto e por isso deve ser definido os métodos para cada rota
                * EX: methods: [GET|POST]
        * Forçar rolta a utilizar protocolo
            * Protocolo HTTPS é o protocolo HTTP seguro, onde é necessário um certificado que comprova que aquele site de fato é seu.
                *  ex: scheme: [HTTPS]
            * Definindo condições para rota ser aceita
                * Parametro "codition" define as condições para a rota ser exibida
                    * ex: condition:  "context.getMethod() in ['GET', 'HEAD'] and request.headers.get('User-Agent') matches '/Chrome/i'"
             
 * CRIANDO CONTROLLER PARA ROTA
    * No controller, precisamos  retornar uma instancia da classe RESPONSE que será enviada para o navegador
    * Importar a classe referente ao RESPONSE.

* VIEWS"
    * Estrutura de decisão e repetição
        * Twig ajuda na criação das estruturas de repetiçao, IF e FOR fica muito mais simples e facíl de se trabalhar
            * ex:dfgsdfg
                {% if curso == "Symfony" %}<br>
                Você esta fazendo o melhor curso de {{ curso }} no Brasil<br>
                {% else %}
                    <p>{{ curso }} não é um curso de symfony</p>
                {% endif %}
                {% for item in cursos %}<br>
                   {{ item.name }}<br>
                {% endfor %}
                </html>
                
    * Estendendo layout
        * Com twig podemos estender o layout facilitando a organização do nosso HTML
        * Podemos dividir nosso HTML em:
            * HEARD | BODY | FOOTER
                   
                   {% extends "base.html.twig" %}
                   
                   {% block stylesheets %} {% endblock%}
                   {% block title %}
                       Lista de Cursos
                   {% endblock %}
                                      
                   {% block body %}
                       <h1">Lista de Cursos</h1>
                       <p>Este curso é  <strong>{{ curso }}</strong></p>
                       <h3>Outros cursos</h3>
                       {% for item in cursos %}
                           <li>item.name</li>
                       {% endfor %}
                   {% endblock %}                   
                   {% block footer %}{% endblock %}
    * Melhorando o estilo do layout
        * inserimos um template do bootstrap para nossa pagina
            * Incluimos o conteudo do nosso template em nosso arquivo base.html.twig
