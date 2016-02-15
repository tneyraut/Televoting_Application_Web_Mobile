<?php

class Reponse extends Model
{
    
    public static function getReponseByQuestionId($id)
    {
        $reponses = parent::exec('REPONSES_BY_QUESTION_ID', array(':id' => $id));
        
        $othersReponses = parent::exec('REPONSES_BY_QUESTION_ID_WITHOUT_QUESTION_SUIVANTE', array(':id' => $id));
        
        foreach ($othersReponses as $reponse)
        {
            array_push($reponses, $reponse);
        }
        
        return $reponses;
    }
    
    public static function getReponseById($id)
    {
        $reponses = parent::exec('REPONSE_BY_ID', array(':id' => $id));
        
        if (count($reponses) > 0) 
        {
            return $reponses[0];
        }
        else 
        {
            $reponses = parent::exec('REPONSE_BY_ID_WITHOUT_QUESTION_SUIVANTE', array(':id' => $id));
            if (count($reponses) > 0)
            {
                return $reponses[0];
            }
        }
        
        return NULL;
    }
    
    public static function miseAJourReponse($reponse, $reponse_correcte, $id, $image, $question_suivante_id)
    {
        if ($image == "") {
            $image = NULL;
        }
        
        if ($reponse_correcte == "Oui")
        {
            $reponse_correcte = 1;
        }
        else
        {
            $reponse_correcte = 0;
        }
        
        parent::exec('MISE_A_JOUR_REPONSE', array(
            ':reponse' => $reponse, 
            ':reponse_correcte' => $reponse_correcte,
            ':id' => $id,
            ':image' => $image,
            ':question_suivante_id' => $question_suivante_id
        ));
    }
    
    public static function ajouterReponse($question_id,$reponse,$reponse_correcte,$image,$question_suivante_id)
    {
        if ($image == "") {
            $image = NULL;
        }
        if ($reponse_correcte == "Oui") {
            $reponse_correcte = 1;
        }
        else {
            $reponse_correcte = 0;
        }
        parent::exec('AJOUTER_REPONSE', array(
            ':question_id' => $question_id, 
            ':reponse' => $reponse, 
            ':reponse_correcte' => $reponse_correcte,
            ':image' => $image,
            ':question_suivante_id' => $question_suivante_id
        ));
    }
    
    public static function supprimerReponsesByQuestionnaire($questionnaire_id)
    {
        $reponses = Reponse::getReponsesByQuestionnaire($questionnaire_id);
        foreach ($reponses as $reponse)
        {
            if ($reponse->image != NULL)
            {
                Image::supprimerImageReponse($reponse->image);
            }
        }
        
        Proposition_Reponse::supprimerPropositionReponseByQuestionnaire($questionnaire_id);
        
        parent::exec('SUPPRIMER_REPONSE_BY_QUESTIONNAIRE', array(':questionnaire_id' => $questionnaire_id));
    }
    
    public static function supprimerReponsesByQuestion($id)
    {
        $reponses = Reponse::getReponseByQuestionId($id);
        foreach ($reponses as $reponse) 
        {
            if ($reponse->image != NULL) {
                Image::supprimerImageReponse($reponse->image);
            }
        }
        
        Proposition_Reponse::supprimerPropositionReponseByQuestion($id);
        
        parent::exec('SUPPRIMER_REPONSE_BY_QUESTION', array(':id' => $id));
    }
    
    public static function supprimerReponseById($id)
    {
        Proposition_Reponse::supprimerPropositionReponseByReponse($id);
        
        $reponse = Reponse::getReponseById($id);
        if ($reponse->image != NULL) {
            Image::supprimerImageReponse($reponse->image);
        }
        parent::exec('SUPPRIMER_REPONSE_BY_ID', array(':id' => $id));
    }
    
    public static function reponseExiste($id, $reponse)
    {
        return count(parent::exec('REPONSE_EXIST', array(':id' => $id, ':reponse' => $reponse))) != 0;
    }
    
    public static function getReponseByReponseAndQuestion($reponseProposee, $question_id)
    {
        $reponse = parent::exec('REPONSE_BY_REPONSE_AND_QUESTION', array(':reponse' => $reponseProposee, ":question_id" => $question_id));
        if ($reponse != NULL) {
            return $reponse[0];
        }
        return NULL;
    }
    
    public static function getReponsesCorrectesByQuestion($question_id)
    {
        return parent::exec('REPONSES_CORRECTES_BY_QUESTION', array(':question_id' => $question_id));
    }
    
    public static function getReponsesByQuestionnaire($questionnaire_id)
    {
        return parent::exec('REPONSES_BY_QUESTIONNAIRE', array(':questionnaire_id' => $questionnaire_id));
    }
    
}