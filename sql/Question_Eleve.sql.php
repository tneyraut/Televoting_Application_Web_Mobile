<?php

Question_Eleve::addQuery('AJOUTER_QUESTION_ELEVE', 
        'INSERT INTO question_eleve(user_id,cours_id,question) 
        VALUES (:user_id,:cours_id,:question)');

Question_Eleve::addQuery('SUPPRIMER_QUESTION_ELEVE_BY_ID', 
        'DELETE FROM question_eleve 
        WHERE question_eleve_id=:question_eleve_id');

Question_Eleve::addQuery('SUPPRIMER_QUESTION_ELEVE_BY_COURS_ID', 
        'DELETE FROM question_eleve 
        WHERE cours_id=:cours_id');

Question_Eleve::addQuery('QUESTIONS_ELEVE_BY_COURS_ID', 
        'SELECT question_eleve_id,user_id,cours_id,question,repondue 
        FROM question_eleve 
        WHERE cours_id=:cours_id');

Question_Eleve::addQuery('QUESTION_ELEVE_BY_COURS_ID_AND_QUESTION', 
        'SELECT question_eleve_id,user_id,cours_id,question,repondue 
        FROM question_eleve 
        WHERE cours_id=:cours_id AND question=:question');

Question_Eleve::addQuery('QUESTION_ELEVE_BY_ID', 
        'SELECT question_eleve_id,user_id,cours_id,question,repondue 
        FROM question_eleve 
        WHERE question_eleve_id=:question_eleve_id');
