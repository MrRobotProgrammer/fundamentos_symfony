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
