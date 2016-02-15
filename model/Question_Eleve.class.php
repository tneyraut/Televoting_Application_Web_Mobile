<?php

class Question_Eleve extends Model
{
    
    public static function ajouterQuestionEleve($user_id, $cours_id, $question)
    {
        parent::exec('AJOUTER_QUESTION_ELEVE', array(
            ':user_id' => $user_id,
            ':cours_id' => $cours_id,
            ':question' => $question
        ));
    }
    
    public static function supprimerQuestionEleveByID($question_eleve_id)
    {
        Reponse_Question_Eleve::supprimerReponseQuestionEleveByQuestionEleveID($question_eleve_id);
        
        parent::exec('SUPPRIMER_QUESTION_ELEVE_BY_ID', array(
            ':question_eleve_id' => $question_eleve_id
        ));
    }
    
    public static function supprimerQuestionEleveByCoursID($cours_id)
    {
        $questions_eleve = Question_Eleve::getQuestionsEleveByCoursID($cours_id);
        
        foreach ($questions_eleve as $question_eleve)
        {
            Reponse_Question_Eleve::supprimerReponseQuestionEleveByQuestionEleveID($question_eleve->question_eleve_id);
        }
        
        parent::exec('SUPPRIMER_QUESTION_ELEVE_BY_COURS_ID', array(
            ':cours_id' => $cours_id
        ));
    }
    
    public static function getQuestionsEleveByCoursID($cours_id)
    {
        return parent::exec('QUESTIONS_ELEVE_BY_COURS_ID', array(
            ':cours_id' => $cours_id
        ));
    }
    
    public static function getQuestionEleveByCoursIDAndQuestion($cours_id, $question)
    {
        $question_eleve = parent::exec('QUESTION_ELEVE_BY_COURS_ID_AND_QUESTION', array(
            ':cours_id' => $cours_id,
            ':question' => $question
        ));
        
        if (count($question_eleve) > 0)
        {
            return $question_eleve[0];
        }
        return NULL;
    }
    
    public static function questionEleveExist($cours_id, $question)
    {
        return count(parent::exec('QUESTION_ELEVE_BY_COURS_ID_AND_QUESTION', array(
            ':cours_id' => $cours_id,
            ':question' => $question
        ))) != 0;
    }
    
    public static function getQuestionEleveByID($question_eleve_id)
    {
        $resultat = parent::exec('QUESTION_ELEVE_BY_ID', array(
           ':question_eleve_id' => $question_eleve_id 
        ));
        
        if (count($resultat) > 0)
        {
            return $resultat[0];
        }
        return NULL;
    }
    
}
