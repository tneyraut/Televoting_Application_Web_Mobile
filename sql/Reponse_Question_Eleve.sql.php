<?php

Reponse_Question_Eleve::addQuery('AJOUTER_REPONSE_QUESTION_ELEVE', 
        'INSERT INTO reponse_question_eleve(question_eleve_id,user_id,reponse) 
        VALUES (:question_eleve_id,:user_id,:reponse)');

Reponse_Question_Eleve::addQuery('SUPPRIMER_REPONSE_QUESTION_ELEVE_BY_ID', 
        'DELETE FROM reponse_question_eleve 
        WHERE reponse_question_eleve_id=:reponse_question_eleve_id');

Reponse_Question_Eleve::addQuery('SUPPRIMER_REPONSE_QUESTION_ELEVE_BY_QUESTION_ELEVE_ID', 
        'DELETE FROM reponse_question_eleve 
        WHERE question_eleve_id=:question_eleve_id');

Reponse_Question_Eleve::addQuery('REPONSES_QUESTION_ELEVE_BY_QUESTION_ELEVE_ID', 
        'SELECT reponse_question_eleve_id,question_eleve_id,user_id,reponse 
        FROM reponse_question_eleve 
        WHERE question_eleve_id=:question_eleve_id');
