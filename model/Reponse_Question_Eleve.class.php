<?php

class Reponse_Question_Eleve extends Model
{
    
    public static function ajouterReponseQuestionEleve($question_eleve_id, $user_id, $reponse)
    {
        parent::exec('AJOUTER_REPONSE_QUESTION_ELEVE', array(
            ':question_eleve_id' => $question_eleve_id,
            ':user_id' => $user_id,
            ':reponse' => $reponse
        ));
    }
    
    public static function supprimerReponseQuestionEleveByID($reponse_question_eleve_id)
    {
        parent::exec('SUPPRIMER_REPONSE_QUESTION_ELEVE_BY_ID', array(
            ':reponse_question_eleve_id' => $reponse_question_eleve_id
        ));
    }
    
    public static function supprimerReponseQuestionEleveByQuestionEleveID($question_eleve_id)
    {
        parent::exec('SUPPRIMER_REPONSE_QUESTION_ELEVE_BY_QUESTION_ELEVE_ID', array(
           ':question_eleve_id' => $question_eleve_id 
        ));
    }
    
    public static function getReponsesQuestionEleveByQuestionEleveID($question_eleve_id)
    {
        return parent::exec('REPONSES_QUESTION_ELEVE_BY_QUESTION_ELEVE_ID', array(
            ":question_eleve_id" => $question_eleve_id
        ));
    }
    
}
