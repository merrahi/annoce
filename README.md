# annonce

# Installation
1. Clonez le dépot chez vous
2. Lancez la migration : `php bin/console d:m:m`
3. Lancez la fixture --Pas de Fixtures :( : `php bin/console d:f:l --no-interaction`
4. Lancez le serveur interne : `php bin/console s:r`

APi Call

Create
POST http://127.0.0.1:8000/api/create
{
{
	"title" : "Développeur PHP/Symfony Hassan",
	"content" : "Le développeur Symfony doit avant tout posséder des compétences techniques poussées : le couple HTML5/CSS3, le JavaScript et bien évidemment le PHP qu’il doit connaître sur le bout des doigts. Il doit aussi savoir utiliser les bases de données, relationelles ou non comme MySQL, PostgreSQL, voire MongDB. La maîtrise du framework open source Symfony est indispensable et la connaissance des principaux CMS recommandée.",
	"category": {
				"type" :"emploi",
				"data"   :{
	      						"salaire": 60000,
			    				"contract_type" : "CDI"
      		
      						 } 
				}
     
	
}
}

Edit
PUT http://127.0.0.1:8000/api/edit/80
{
	"title" : "TEST EditDéveloppeur PHP/Symfony",
	"content" : " TEST EditLe développeur Symfony doit avant tout posséder des compétences techniques poussées : le couple HTML5/CSS3, le JavaScript et bien évidemment le PHP qu’il doit connaître sur le bout des doigts. Il doit aussi savoir utiliser les bases de données, relationelles ou non comme MySQL, PostgreSQL, voire MongDB. La maîtrise du framework open source Symfony est indispensable et la connaissance des principaux CMS recommandée.",
	"category": {"type" :"emploi",
				"data"   :{
	      						"salaire": "80000",
			    				"contract_type" : "CDD"
      		
      						 } 
					}
     
	
}

Delete
DELETE http://127.0.0.1:8000/api/delete/42

List
GET http://127.0.0.1:8000/api/list/38
