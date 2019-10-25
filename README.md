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
            * show:
                path: /task/show/{id?}
                controller: App\Controller\TaskController::show
                defaults:
                  id: 10
                requirements:
                  id: '\d+'
             
 * CRIANDO CONTROLLER PARA ROTA
    * No controller, precisamos  retornar uma instancia da classe RESPONSE que será enviada para o navegador
    * Importar a classe referente ao RESPONSE.
