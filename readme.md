# Jiri

_Jiri_ est une application qui permet de tenir un jury pour les cours de _Design Web_ du 2ème bloc et de _Projets Web_ du 3ème bloc du bachelier en infographie organisé à la Haute École de la Province de Liège.

## Le contexte

Chaque année, des intervenants externes sont invités à venir rencontrer les étudiants des cours de _Design Web_ et de _Projets Web_, et à leur donner par la même occasion un feedback sur leurs réalisations ainsi qu‘une cote. 

Jusqu’à ce jour, la procédure habituelle a consisté à donner aux membres du jury des feuilles reprenant chacune le nom d’un étudiant, son heure de passage, le nom du jury et la liste des réalisations, et à leur demander de noter, pour chaque réalisation, une cote et des commentaires. Ils notent également sur ces feuilles un commentaire global et une cote globale concernant le profil et le niveau de compétence de l’étudiant tel qu’ils l’ont perçu à travers les réalisations examinées. À la fin de la journée, à l’aide de ces notes, les membres du jury délibèrent pour obtenir un consensus sur les qualités des travaux de chaque étudiant et en tirer une cote finale.

Vous pouvez voir, en suivant les liens suivants, divers exemples des documents concernés, tels qu’utilisés cette année au jury de Design Web B2 de première session :

- [la feuille des ordres de passage à découper et à distribuer aux membres du jury et aux étudiants](https://docs.google.com/document/d/1prWdLEWeBah6CLL3XwAI4ohCylqM7SlbwvDnlsdnmgk/edit?usp=sharing) ;
- [la feuille de cotation remise à un membre du jury pour qu’il puisse évaluer les travaux d’un étudiant](https://docs.google.com/document/d/1m8Y-Yek-yei3goAIm5l9lqY0NftNhIKUmKXiiZU-3UI/edit?usp=sharing) ;
- [le dashboard final du professeur qui organise la séance, qui lui permet de voir toutes les cotes et lui calcule les moyennes](https://docs.google.com/spreadsheets/d/1_U417EZMub3Zr4WkLnUd8hqpu2v10bLzbVXx-Cf-RuM/edit?usp=sharing).

Afin de faciliter le processus d’encodage et de délibération de fin d’épreuve, nous vous passons commande d’une application utilisable le jour de l’examen par les membres du jury et par le professeur qui organise l’épreuve.

**Cette application devra impérativement être remise (url de la version en ligne, url du repo et credentials pour un prof et un membre du jury) au plus tard 48 heures avant l’examen, par mail à dominique.vilain@hepl.be**

## Les rôles

Deux rôles sont à considérer dans l’utilisation de l’application : membre du jury classique et professeur responsable de l’épreuve. Voici les scénarios types que nous imaginons pour l’utilisation de l’application selon ces deux rôles.

### Le membre du jury classique

Au début de sa journée, le membre du jury s’installe à son poste. Il rencontre les étudiants les uns après les autres et utilise les différents projets de chacun. Lorsqu’il souhaite commenter un projet, il établit une connexion à l’application avec le ou les appareils qu’il utilise pour son évaluation (certains utilisent leur smartphone, d’autres des tablettes). Son compte a déjà été créé par le professeur au préalable. Le jury doit seulement entrer un email et un mot de passe de 6 lettres, communiqué par le professeur au début de l’épreuve, pour ouvrir sa session.

Lorsqu’il est connecté, le professeur voit l’ordre de passage des étudiants qu’il doit voir. En choisissant dans cette liste l’étudiant dont il veut coter et commenter les travaux, il découvre la liste des travaux de l’étudiant. Après avoir choisi un travail, il peut remplir un formulaire constitué d’un champ pour la cote (peut contenir deux décimales, min. 0 et max. 20) et un champ de texte pour le commentaire. Le lien vers le travail et vers le repo du travail sont également affichés, éditables si besoin et utilisables pour visiter le travail ou son repo. En plus de mettre une cote pour chaque travail, le professeur est aussi invité à donner une appréciation globale de l’étudiant, basée sur l’impression générale que lui a laissée son entrevue avec ce dernier.

Le membre du jury n’est pas obligé de remplir les deux champs en même temps, ce qui signifie que s’il réaffiche plus tard la page correspondant à un travail particulier d’un étudiant, il doit retrouver un formulaire pré-rempli avec ce qu’il y a déjà saisi. Lorsqu’il enregistre, il reste sur la même vue afin de pouvoir continuer son édition le cas échéant.

### Le professeur responsable

Le professeur prépare le jury et acte sa délibération lorsqu’il est fini. Pendant le jury, il peut agir comme un membre du jury classique. L’interface lui propose donc les fonctions disponibles pour le membre du jury classique plus quelques autres. Par défaut, par contre, son interface lui affiche l’état actuel du jury (les cotes déjà attribuées par les membres du jury aux étudiants qu’ils ont vu), ce qui lui permet de monitorer l’avancement du jury.

Lorsqu’il prépare le jury, le professeur doit tout d’abord créer une nouvelle épreuve. Identifier l’épreuve permettra à plusieurs professeurs de créer différentes épreuves au fil des années. Une épreuve se caractérise par le nom du cours, l’année académique, la date et la session d’examen (première ou seconde). 

Quand il construit l’épreuve, le professeur doit ajouter des étudiants (avec une photo éventuelle). L’ajout des étudiants doit être facilité par une auto-complétion si l’étudiant est déjà dans la base de données ou créer un nouvel étudiant si ce n‘est pas le cas. 

Le professeur doit aussi ajouter des membres du jury (nom, prénom, email, mot de passe de 6 lettres, photo éventuelle), et cette création est assistée, comme pour les étudiants, par une auto-complétion si le membre du jury a déjà été ajouté lors d’une épreuve précédente, car certains membres du jury reviennent plusieurs années de suite. 

Quand des étudiants ont quitté l’école ou que certains membres de jury ne souhaitent plus participer à l’avenir, il serait problématique que la fonction d’auto-complétion continue de les proposer. Mais il serait aussi dommage de perdre la trace des épreuves passées. C’est pourquoi les suppressions se feront toutes en _soft-delete_. C’est ainsi qu’on rendra actifs ou inactifs des éléments de la base de données.

Une fois les étudiants et les membres du jury ajoutés dans le système, le professeur peut mémoriser un ordre de passage (un membre du jury rencontre un étudiant entre telle heure et telle heure).

Bien sûr, le professeur peut constamment éditer ces informations. Les formulaires restent donc ouverts et sont seulement équipés d’un bouton d’enregistrement.

Le professeur doit aussi ajouter des projets avec une courte explication. Ensuite, il associe à chaque étudiant les travaux qui le concernent et renseigne, s’il les a, les urls du site et du repo. 

#### Note pour le calcul de la cote finale d’un étudiant

Pour un étudiant donné, chaque jury encode une cote pour chaque travail qu'il a examiné ainsi qu’une cote d'évaluation globale. 

Les différents travaux peuvent _peser_ différemment dans le calcul de la cote finale d’un étudiant. Quand il ajoute un travail à une épreuve, le professeur doit donc pouvoir ajouter une pondération (`0.05` équivaut par exemple à un vingtième de la cote). Il n’encode pas explicitement la pondération de la cote d’évaluation globale, elle se calcule après avoir fait la somme des pondérations des autres projets. 

La cote finale de l’étudiant se calcule en deux étapes :

1. Pour chaque travail de l’étudiant, on fait la moyenne des cotes des membres du jury qui ont évalué ce travail. Idem pour l’évaluation globale. On obtient donc une cote moyenne pour le travail 1 (ex. __CV__), une cote moyenne pour le travail 2 (ex. __CSSZG__), etc. et une cote  moyenne pour l’évaluation globale (__EG__). Par exemple, s'il y a cinq travaux, __CV__, CSS Zen Garden (__CSSZG__), Artiste (__ART__), Portfolio (__PF__) et site pour client réel (__CR__), on aura :

    - __CV__ = (__CV__ du jury1 + __CV__ du jury3 + __CV__ du jury7) / 3
    - __CSSZG__ = (__CSSZG__ du jury1 + __CSSZG__ du jury2) / 2
    - __ART__ = (__ART__ du jury2 + __ART__ du jury3 + __ART__ du jury5 + __ART__ du jury6) / 4
    - __PF__ = (__PF__ du jury2 + __PF__ du jury3 + __PF__ du jury4 + __PF__ du jury6 + __PF__ du jury7) / 5
    - __CR__ =(__CR__ du jury1 + __CR__ du jury2 + __CR__ du jury4 + __CR__ du jury5 + __CR__ du jury6 + __CR__   du jury7) / 6
    - __EG__ = (__EG__ du jury1 + __EG__ du jury2 + __EG__ du jury3 + __EG__ du jury4 + __EG__ du jury5 + __EG__ du jury6 + __EG__ du jury7 ) / 7

2. La cote finale est la moyenne pondérée des cotes moyennes pour chaque travail. Par exemple, si on a décidé que le __CV__, __CSSZG__, __ART__ valaient chacun pour 2/20 des points, __PF__ pour 4/20 des points, __CR__ pour 6/20 des points, il reste 4/20 des points __EG__ et la cote finale sera calulée comme suit :
    
    - __COTE__ = 0.1 * __CV__ + 0.1 * __CSSZG__ + 0.1 * __ART__ + 0.2 * __PF__ + 0.3 * __CR__ + 0.2 * __EG__

La cote finale calculée automatiquement n’est pas forcément la cote finale qui se trouvera dans le bulletin de l’étudiant. En effet, si après le calcul par l’application, les membres du jury s’accordent oralement pour dire que celui-ci a créé une cote artificiellement élevée ou basse par rapport à l’estimation globale qu’ils ont des compétences de l’étudiant, il doit être possible d’encoder une cote finale manuellement. Par défaut, c’est la cote calculée qui est utilisée, mais on peut en ajouter une manuellement qui sera prise en compte à la place de la cote calculée. Naturellement, le professeur doit pouvoir voir tant le résultat du calcul que la cote mise manuellement.

#### En plus

Pour la préparation d’une épreuve, l’application doit permettre d’imprimer :

- une feuille reprenant la liste de membres du jury (prévoir des séparations pointillées entre les différents membres du jury pour aider à couper des bandelettes distribuables aux membres du jury et faire attention aux sauts de pages) avec, pour chacun,
    - ses *credentials* (nom, prénom, email, mot de passe) ;
    - la liste des étudiants qu’il va voir avec les heures de passage (nom de l’étudiant, heure de début, heure de fin) ;
- une liste des étudiants (prévoir des séparations pointillées entre les différents étudiants pour aider à couper des bandelettes distribuables aux étudiants) reprenant pour chacun leur ordre de passage auprès des différents membres du jury (nom du jury, heure de début, heure de fin).

À tout moment, le professeur doit pouvoir monitorer ce qui se passe. Sa page d’accueil sur l’application reprendra donc une vue d’ensemble des cotes déjà encodées. La meilleure forme pour ce faire est un tableau qui croise les étudiants avec les membres du jury. Le but est de permettre au professeur de savoir où on en est dans l’avancement de l’épreuve. Cette vue est à réaliser impérativement, c’est la plus utile.

Différentes vues supplémentaires sont possibles en plus de la vue générale décrite au paragraphe précédent. Le professeur peut choisir un étudiant dans l’interface et voir : sa cote finale calculée par l’application ; le détail du calcul ; un résumé des cotes des différents jurys pour un travail particulier ; un résumé des cotes mises par un membre du jury à un étudiant particulier ; une vue d’ensemble des cotes mises par un membre du jury à tous les étudiants qu’il a rencontré ; les commentaires associés à chaque cote et éventuellement, recliquer sur le lien d’un travail d’un étudiant pour le remontrer aux jurys. On peut encore imaginer d’autres vues, mais ce sont sans doute les plus utiles.

Lorsqu’il le souhaite (par exemple lorsqu’il est de retour à la maison), le professeur peut imprimer un document (idéalement PDF et/ou Excel, mais au minimum, via des feuilles de styles adaptées à l’impression) récapitulatif des cotes configuré selon ses besoins :

- soit une liste simplifiée des étudiants avec leur cote finale ;
- soit une liste détaillée des cotes pour tous les travaux par étudiant (et bien sûr la cote finale);
- soit un tableau avec les cotes mises par chaque jury pour chaque étudiant (et bien sûr la cote finale). 

## Notes techniques

Ce travail assez simple (le cahier des charges décrit en détail le contexte et des scénarios d’utilisation pour vous aider à sentir les besoins, mais les fonctionnalités sont basiques et peu nombreuses. La modélisation de la DB est simple également) propose des occasions d’enrichissement des interfaces. Vous devez créer un produit qui respecte les règles habituelles de l’accessiblité et peut donc fonctionner sans JS mais il est _impératif_ d’enrichir ensuite l’interface pour qu’elle propose une expérience moderne et confortable. En plus, elle doit être utilisable sur tout device (téléphone, tablette, desktop) que le membre du jury ou le professeur jugera utile d’utiliser.

Il y a beaucoup de formulaires dans cette application. Efforcez-vous de les rendre séduisants, qu’ils fassent oublier qu’ils sont des formulaires d’encodage mais sans casser non plus l’affordance. Tout est dans l’équilibre.

Le backend doit être implémenté à l’aide d’une architecture MVC existante. Vous êtes libres de choisir celle qui vous convient mais pour des raisons contingentes à l’infrastructure scolaire, elle doit être basée sur le langage PHP et la base de données Mysql. [Laravel](http://www.laravel.com) ou [Lumen](https://lumen.laravel.com/docs/5.4) s’imposent donc assez naturellement.

_Idéalement_, un modèle de développement qui abstrait l’accès aux données et permet de les consommer avec des clients variés est souhaitable. Une API, REST idéalement, serait donc un vrai plus. Ne pas la faire ne sera pas une cause d’échec, mais la faire vous amènera un bon bonus. En tout état de cause, vous pouvez aussi partir sur l’idée que vous faites une application Web _normale_, ce n’est pas une cause de pénalisation.

Si vous choisissez de faire une API REST, n’oubliez pas qu’elle doit être stateless, donc que nous ne pouvez pas compter sur de la persistance côté serveur et que donc, vous devez renvoyer systématiquement des informations qui identifient le contexte de votre requête, comme par exemple, l’identifiant de l’événement _jury_ en cours.

Dans les fichiers associés à ce repo, j’ai introduit un exemple de ce type d’architecture. Une route Web dispatche une requête vers une route d’API pour récupérer les infos d’un événements, en y incluant les étudiants concernés et la cote finale manuelle obtenue (une occasion aussi de voir un cas d’eager loading).

Dernier point, basique mais important, le(s) client(s) doi(ven)t pouvoir fonctionner sans JS, mais ne pas enrichir l’expérience de JS sera une cause de malus.

### Aides

Pour vous aider à démarrer et vous permettre de vous concentrer le plus vite possible sur le client et son interface, un travail de modélisation de la db a été réalisé. Vous pouvez naturellement modifier tout ce qui vous semble utile pour coller au cahier des charges, ou encore utiliser un autre type de base de données, mais sinon, vous avez déjà quelque chose. Il est possible qu’il reste des champs mal défini. D’avance, je m’en excuse, il n’y a pas de piège, mais on ne termine vraiment les choses qu’en les faisant jusqu’au bout. J’ai déjà mené quelques tests concluants avec ce modèle, mais il peut recevoir des améliorations ou des simplifications.

Vous trouverez sur Laravel Schema Designer [une représentation graphique du modèle](http://www.laravelsd.com/share/Tbwhdr). Vous pouvez la forker dans votre compte et repartir de là pour la modifier ou voir les meta informations associées aux tables (les relations par exemple). LaravelSD permet d’exporter des migrations, des modèles, des controleurs, des formulaires, des fichiers de seed. On rencontre vite des limites à les utiliser tels quels, mais ça peut servir de base. En tout état de cause, vous trouverez dans ce repo des modèles avec un certain nombre de relations (je crois, mais de nouveau, je peux me tromper, qu’elles fonctionnent toutes. Cependant, pour rencontrer complètement le cahier de charges, vous devrez certainement enrichir le modèle et retourner certaines relations personnalisées ou encore transformer certaines valeurs), des fichiers de migration et des fichiers de seed. Vous pouvez donc créer votre db en une seule commande artisan, ce qui vous fera gagner beaucoup de temps.

#### Avertissement sur la base de données

Laravel est fondé sur un grand nombre de conventions. Par exemple, les tables pivots sont normalement nommées en combinant avec un underscore le nom des tables qu’elles unissent, au singulier, et dans l’ordre alphabétique. Ceci présente l’avantage de permettre d’écrire moins de code. Pour ma part, je préfère que mes relations portent le nom de ce que fait la relation. Ainsi, je peux y associer un modèle dont le nom va faire sens dans une API Rest. Voici donc le détail des tables :

- `events` liste les événements de type jury. Par exemple, _le jury de Design Web de 2e en juin pour 2016 - 2017_ ou _le jury de Projets Web de 3e en septembre pour 2016 - 2017._ Une clé étrangère, `user_id`, permet de savoir qui est le créateur/propriétaire de l’événement en question ;
- `users` liste les utilisateurs du système, donc les profs et les membres du jury. Les profs ont une valeur 1 pour la colonne `is_admin`, les membres, une valeur 0. Grâce au système des `gates` et `policies` de Laravel, vous pourrez très facilement gérer les droits de vos utilisateurs selon la valeur de ce flag ;
- `students` liste l‘autre catégorie d’êtres humains du système, les étudiants. Ils n’en sont pas utilisateur ;
- `meetings` liste les rencontres entre les membres du jury et les étudiants. Comme un membre du jury peut voir un étudiant à l’occasion du jury de juin _et_ à l’occasion du jury de septembre,  j’ai associé l’information de l’événement à cette relation. Des colonnes sont aussi prévue pour renseigner l’horaire de la rencontre. Enfin, une colonne permet de recueillir la cote d’impression générale laissée par l’étudiant sur le membre du jury ;
- `projects` liste tous les projets réalisable à l’occasion d’un jury ;
- `implementations` liste les réalisations, par les étudiants, des projets à faire pour le jury. Si il y a 6 projets et 10 étudiants, ça fait 60 implémentations. Chaque implémentation est associée à ses urls et au jury en cours car un étudiant peut réaliser une implémentation d’un projet en juin et l’améliorer en septembre par exemple ;
- `scores` contient les scores mis par un membre du jury à une implémentation d’un projet réalisée par un étudiant. Un commentaire est également possible en plus de la cote (qui peut contenir deux décimales). Le score référence un `meeting`, ce qui permet de retrouver l’événement lors duquel elle a été mise, le membre du jury, l’étudiant. Le score référence aussi une implémentation naturellement puisqu’il lui est attaché ;
- `weights` permet de noter les pondérations associées à un projet pour un événement particulier ;
- `performances` stocke les cotes finales obtenues par un étudiant lors d’un événement. Il y a deux cotes, la cote calculée mathématiquement, et la cote ajustée suite la délibération.

Bon travail !
