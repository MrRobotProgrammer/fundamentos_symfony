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
            * ex:
                {% if curso == "Symfony" %}<br>
                Você esta fazendo o melhor curso de {{ curso }} no Brasil<br>
                {% else %}
                    <p>{{ curso }} não é um curso de symfony</p>
                {% endif %}
                {% for item in cursos %}<br>
                   {{ item.name }}<br>
                {% endfor %}
                
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
 
 * Frameworks ORM
    * ORM reduz o trabalho do desenvolvedor de se conectar principalmente com base de dados relacionais
        * Com estes frameworks, o programador reduz a programação de acesso ao banco de dados, obtendo produtividade significativa no desenvolvimento do sistema
        * Esse efeito é atingido porque os frameworks ORM auxiliam no processo de mitigação da impedância.
            *  Impedencia
                * Um dos meios mais utilizados para se persistencia de informações por parte das aplicações são os banco de dados relaciionais
                * Porem eles existem barreiras técnicas ocasionadas pelo banco de dados relacionais
                * Banco relacional segue o paradigma relacional, enquanto aos softwares seguem o paradigma de orientação ao objeto.
                    * Orientado ao objeto - Focam em criar estruturas que possibilitem a representação do mundo real
                    * Relacional - Da o foco nas relacões entre entidades e consistência das informações
                * Um é incompativel com outro.
                * Problemas Caracteristicos da impedancia:
                    * Diferença dos tipos de dados
                    * Diferença com a relação da integridade dos dados 
                    * Visibilidades dos dados
                    * O modelo orientado a objetos lida com classes, interfaces, herança e por aí vai. O modelo relacional não oferece esse tipo de estrutura: em bancos de dados, ele se resume à tabelas, índices e chaves primárias e estrangeiras. Há uma enorme diferença estrutural entre os elementos destes dois paradigmas. 

* Mapeando as entidades manualmente
    * Cria um novo arquivo PHP dentro da pasta /src/Entity 
        * inclui namespace 
            * namespace App\Entity;
        * Para conseguir mapear nossa entidade corretamente, vamos utilizar uma classe do Doctrine para criar as annotation
            * use Doctrine\ORM\Mapping as ORM;
        * É preciso definir os atributos que nossa entidade tem 
            * As colunas do nosso banco de dados seram convertidas em atributos em nossa entidade
                * exemplo: 
                  
                      /**
                       * @ORM\Id
                       * @ORM\GeneratedValue
                       * @ORM\Column(type="integer")
                       */
                      private $id;
                         
                      /**
                       * @ORM\Column(type="string", Length=100)
                       */
                      private $name;
                  
                      /**
                       * @ORM\Column(type="string", Length=500)
                       */
                      private $description;
            * Depois declaramos os Getters e Setters de cada atributos
                * Exemplo:
                        
                         /**
                              * Pegar valor do ID
                              *
                              * @return integer
                              */
                             public function getId()
                             {
                                 return $this->id;
                             }
                         
                             /**
                              * Pegar o valor do nome
                              *
                              * @return string
                              */
                             public function getName()
                             {
                                 return $this->name;
                             }
                         
                             /**
                              * Setar o valor do nome
                              *
                              * @param string $name
                              */
                             public function setName($name): void
                             {
                                 $this->name = $name;
                             }
                         
                             /**
                              * Retornar o valor da descrição
                              *
                              * @return string
                              */
                             public function getDescription()
                             {
                                 return $this->description;
                             }
                         
                             /**
                              * Setar o valor da descrição
                              *
                              * @param string $description
                              */
                             public function setDescription($description): void
                             {
                                 $this->description = $description;
                             }
* Criando entidade via comando
    * Para criarmos uma nova entidade sem precisar faze-lo manualmente, precisamos usar o seguinte comando
    
     
        Ex: php bin/console make:entity
        
  * Adicionando novas propriedades a entidade
    * Para adicionar novas propriedades basta utilizar o mesmo código que foi usado para criar a entidade e inserir o mesmo nome da entidade que deseja adicionar as novas propriedades
  * Migrations
    * As migrations gera um arquivo de migração com as devidas querys que ira criar a nova tabela com od devidos campos
    * Também gera um arquivo de versionamento para identificar essa ação, caso necessite de retornar a base de dados para a versão anterior utiliza-se informações dessa tabela
        
        
            ### Criando as migrations 
            
            Ex: php bin/console make:migration
            
            ### Criando as tabelas e os campos na base de dados 
            
            Ex: php bin/console doctrine:migrations:migrate 
  * Criando registro no banco de dados
    * 1 - Para incluir registro na base é necessário utilizar os métodos do Doctrine que é atualmente o melhor conjunto de bibliotecas PHP para trabalhar com bancos de dados.
    * 2 - Essas ferramentas suportam bancos de dados relacionais como MYSQL e PostegreSQL e também banco de dados NoSQL como MongoDB.
        * Como utilizar
            
            
            ## como utilizar
                *INCLUIR DOCTRINE 
                 use Doctrine\ORM\EntityManagerInterface;
            
            ## Iniciar a classe Doctrine no construct                
                private $entityManager;                
                    public function __construct(EntityManagerInterface $entityManager)
                {
                    $this->entityManager = $entityManager;
                }
  + Reconhecendo repositorio e retornando dados
    * Para retornar os dados inseridos em nossa base de dados, vamos precisar do nosso repository, é por meio dele que faremos todas as nossas consultas
    * Nossa classe repository é criada com o memso comando que cria as nossas entity (entidades), lovalizado na pasta Entity\Repository
    * Para retornar nossos dados, criaremos metodo show em nosso arquivo controller:
        
        
        * public function show($id)
              {
                  $repository = $this->entityManager->getRepository(Task::class);
                  $task = $repository->findOneBy([
                      'id' => $id
                  ]);          
                  return new JsonResponse($task, Response::HTTP_OK);
              }
* Busca por multiplas linhas
    * Para visualizar todos os dados retornados pelo nosso controller devemos fazer um FOR em nossa view.
        * exemplo;
            
            
            {% extends "base.html.twig" %}
            
            {% block title %}
                Lista de Cursos
            {% endblock %}
            
            {% block body %}
                <h1>Lista de Cursos</h1>
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Titulo</th>
                        <th scope="col">Descrição</th>
                        <th scope="col">Data</th>
                    </tr>
                    </thead>
                    <tbody>
                    {% for item in task %}
                    <tr>
                        <th scope="row">{{ item.id }}</th>
                        <td>{{ item.name }}</td>
                        <td>{{ item.description }}</td>
                        <td></td>
                    </tr>
                    {% endfor %}
                    </tbody>
                </table>
            {% endblock %} 
    
* Buscando uma tarefa unica na view
    * O método SHOW do nosso controller, recebe via GET o ID da tarefa, aciona o método FindOneBy() para o repository e retorna a tarefa referente ao ID recebido
    * O método render do controllerTrait encaminha os dados retornados para nossa view
        * exemplo: 
            
            
            ## metodo FindOneBY
            $task = $repository->findOneBy([
                        'id' => $id
                    ]);
            
            ## metodo render
            return $this->render('task\show.html.twig', [
                        'task' => $task
                    ]); 
            
            ## view show.html.twig
            {% block body %}
                <div class="col-sm-12">
                    <h1>Detalhes da tarefa - ID {{ task.id }}</h1>
                </div>            
                <div class="col-sm-12">            
                    <p>
                        <strong>Titulo: </strong> {{ task.name }}<br>
                        <strong>Descrição: </strong> {{ task.description }}<br>
                        <strong>Data: </strong>
                    </p>            
                </div>
            {% endblock %}
            
