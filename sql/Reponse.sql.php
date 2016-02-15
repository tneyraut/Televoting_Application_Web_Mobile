<?php

Reponse::addQuery('REPONSE_BY_ID', 
        'SELECT reponse.reponse_id,reponse.reponse,reponse.reponse_correcte,reponse.question_id,reponse.image,reponse.question_suivante_id,question.question
        FROM reponse,question 
        WHERE reponse.question_suivante_id=question.question_id AND reponse.reponse_id=:id 
        GROUP BY reponse');

Reponse::addQuery('REPONSE_BY_ID_WITHOUT_QUESTION_SUIVANTE', 
        'SELECT reponse_id,reponse,reponse_correcte,question_id,image,question_suivante_id
        FROM reponse 
        WHERE reponse_id=:id AND (question_suivante_id=0 OR question_suivante_id=-1) 
        GROUP BY reponse');

Reponse::addQuery('MISE_A_JOUR_REPONSE', 
        'UPDATE reponse SET reponse=:reponse,reponse_correcte=:reponse_correcte,image=:image,question_suivante_id=:question_suivante_id 
        WHERE reponse_id=:id');

Reponse::addQuery('AJOUTER_REPONSE', 
        'INSERT INTO reponse(question_id,reponse,reponse_correcte,image,question_suivante_id) 
        VALUES (:question_id,:reponse,:reponse_correcte,:image,:question_suivante_id)');

Reponse::addQuery('REPONSES_BY_QUESTION_ID', 
        'SELECT reponse.reponse_id,reponse.reponse,reponse.reponse_correcte,reponse.image,reponse.question_suivante_id,question.question 
        FROM reponse,question 
        WHERE question.question_id=reponse.question_suivante_id AND reponse.question_id=:id 
        ORDER BY reponse.reponse_id');

Reponse::addQuery('REPONSES_BY_QUESTION_ID_WITHOUT_QUESTION_SUIVANTE', 
        'SELECT reponse_id,reponse,reponse_correcte,image,question_suivante_id 
        FROM reponse 
        WHERE question_id=:id AND (question_suivante_id=0 OR question_suivante_id=-1) 
        ORDER BY reponse_id');

Reponse::addQuery('SUPPRIMER_REPONSE_BY_QUESTION', 'DELETE FROM reponse WHERE question_id=:id');

Reponse::addQuery('SUPPRIMER_REPONSE_BY_ID', 'DELETE FROM reponse WHERE reponse_id=:id');

Reponse::addQuery('REPONSE_EXIST', 'SELECT reponse FROM reponse WHERE reponse=:reponse AND question_id=:id');

Reponse::addQuery('REPONSE_BY_REPONSE_AND_QUESTION', 
        'SELECT reponse_id,reponse,reponse_correcte,question_id,image,question_suivante_id 
        FROM reponse 
        WHERE reponse=:reponse AND question_id=:question_id 
        GROUP BY reponse');

Reponse::addQuery('REPONSES_CORRECTES_BY_QUESTION', 'SELECT reponse_id,reponse FROM reponse WHERE reponse_correcte=1 AND question_id=:question_id');

Reponse::addQuery('REPONSES_BY_QUESTIONNAIRE', 
        'SELECT reponse.reponse_id,reponse.reponse, reponse.question_id, reponse.reponse_correcte, reponse.question_suivante_id 
        FROM reponse,question 
        WHERE reponse.question_id=question.question_id 
        AND question.questionnaire_id=:questionnaire_id 
        ORDER BY question_id,reponse_id');