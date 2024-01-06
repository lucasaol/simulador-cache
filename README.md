# Simulador Cache

Simulador de memória cache desenvolvido em PHP durante o 3º período do curso de Sistemas da Informação, para um trabalho interdisciplinar para as disciplinas de **Algoritmos e Estruturas de Dados II** e **Arquitetura e Organização de Computadores**.

![Nível](https://img.shields.io/badge/n%C3%ADvel-Intermediário-yellow?style=for-the-badge)

![PHP](https://img.shields.io/badge/php-%23777BB4.svg?style=for-the-badge&logo=php&logoColor=white)
![HTML5](https://img.shields.io/badge/html5-%23E34F26.svg?style=for-the-badge&logo=html5&logoColor=white)
![CSS3](https://img.shields.io/badge/css3-%231572B6.svg?style=for-the-badge&logo=css3&logoColor=white)
![JavaScript](https://img.shields.io/badge/javascript-%23323330.svg?style=for-the-badge&logo=javascript&logoColor=%23F7DF1E)
![jQuery](https://img.shields.io/badge/jquery-%230769AD.svg?style=for-the-badge&logo=jquery&logoColor=white)

O trabalho consiste em simular o funcionamento da troca de blocos, durante a execução do programa, entre uma memória principal e uma memória cache com mapeamento direto e uma memória cache associativa.

**Funcionamento do Simulador**
* O simulador deverá receber como entrada:
  * O tamanho da memória principal em bytes.
  * O tamanho do bloco em bytes.
  * A quantidade de linhas da memória cache.
  * A técnica a ser simulada: direta ou associativa.
  * O algoritmo de substituição que será utilizado pela memória cache (LRU, LFU, FIFO), quando necessário.
  * A sequência de números de blocos que serão acessados pelo processador durante a execução do programa.
* A memória cache deverá estar inicialmente vazia.
* O simulador deverá disponibilizar um botão para a carga de bloco passo a passo, a partir da memória principal, para a memória cache.
* O simulador deverá conter, no mínimo, uma interface para:
  * Entrada dos dados listados acima.
  * Visualização dos blocos na memória principal.
  * Visualização dos blocos carregados na memória cache.
  * Visualização do conteúdo da memória cache após a carga de cada bloco (antes da cache ficar cheia).
  * Visualização da troca de blocos entre as memórias, utilizando um algoritmo de substituição, quando necessário.
