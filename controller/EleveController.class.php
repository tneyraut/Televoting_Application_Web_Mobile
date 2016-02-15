<?php

class EleveController extends Controller
{
    
    public function defaultAction() {
        
    }
    
    public function listeCoursAction()
    {
        //$cours = Cours::getCoursByAnnee($this->user->annee);
        $cours = Cours::getCoursByGroupeDuUser($this->user->user_id);
        $this->view->render('eleve/choixCours', array('cours' => $cours));
        return new Response();
    }
    
    public function choixModeAction()
    {
        $cours_name = $this->request->getPostValue('cours_name');
        
        $this->view->render('eleve/choixMode', array(
            'cours_name' => $cours_name
        ));
        
        return new Response();
    }
    
    public function listeQuestionnairesAction($cours_name)
    {
        $cours_name = str_replace('_', ' ', $cours_name);
        $questionnaires = Questionnaire::getQuestionnaireLanceeByCours($cours_name);
        $this->view->render('eleve/choixQuestionnaire', array(
            'cours_name' => $cours_name,
            'questionnaires' => $questionnaires
        ));
        return new Response();
    }
    
    public function listeQuestionsAction($cours_name) 
    {
        $cours_name = str_replace('_', ' ', $cours_name);
        $questionnaire_name = $this->request->getPostValue('questionnaire_name');
        $questionnaire = Questionnaire::getQuestionnaireByName($questionnaire_name, $cours_name);
        $participant = Participant::getParticipantByQuestionnaireAndUser($questionnaire->questionnaire_id, $this->user->user_id);
        $questions = Question::getQuestionsNonReponduesByQuestionnaireAndParticipant($participant->participant_id, $questionnaire->questionnaire_id);
        
        if (count($questions) == 0) {
            $moyenne = Participant::getMoyenneNoteByQuestionnaire($questionnaire->questionnaire_id);
            $noteMax = Participant::getMaxNoteByQuestionnaire($questionnaire->questionnaire_id);
            $noteMin = Participant::getMinNoteByQuestionnaire($questionnaire->questionnaire_id);
            $moyenneFautes = Participant::getMoyenneNombreDeFautesByQuestionnaire($questionnaire->questionnaire_id);
            $moyenneBonnesReponses = Participant::getMoyenneNombreDeBonnesReponseByQuestionnaire($questionnaire->questionnaire_id);
            $bareme = Questionnaire::getBareme($questionnaire->questionnaire_id);
            $baremeFautes = Questionnaire::getBaremeFautes($questionnaire->questionnaire_id);
            $this->view->render('eleve/resultat', array(
                'cours_name' => $cours_name,
                'questionnaire_name' => $questionnaire_name,
                'note' => $participant->note,
                'nombre_de_fautes' => $participant->nombre_de_fautes,
                'nombre_de_bonnes_reponses' => $participant->nombre_de_bonnes_reponses,
                'moyenne' => $moyenne,
                'noteMax' => $noteMax,
                'noteMin' => $noteMin,
                'moyenneFautes' => $moyenneFautes,
                'moyenneBonnesReponses' => $moyenneBonnesReponses,
                'bareme' => $bareme,
                'baremeFautes' => $baremeFautes
            ));
            return new Response();
        }
        
        if ($questionnaire->pause == 0) {
            foreach ($questions as $question) {
                Proposition_Reponse::ajouterPropositionReponse($participant->participant_id, $question->question_id);
            }
            $compteur = 0;
            $reponses = Reponse::getReponseByQuestionId($questions[$compteur]->question_id);
            $this->view->render('eleve/reponse', array(
                'cours_name' => $cours_name,
                'questionnaire_name' => $questionnaire_name,
                'question' => $questions[$compteur],
                'reponses' => $reponses,
                'compteur' => $compteur
            ));
        }
        
        else {
            $this->view->render('eleve/choixQuestion', array(
                'cours_name' => $cours_name,
                'questionnaire_name' => $questionnaire_name,
                'questions' => $questions
            ));
        }
        
        return new Response();
    }
    
    public function listeReponsesAction($cours_name, $questionnaire_name)
    {
        $cours_name = str_replace('_', ' ', $cours_name);
        $questionnaire_name = str_replace('_', ' ', $questionnaire_name);
        $question_id = $this->request->getPostValue('question_id');
        $question = Question::getQuestionById($question_id);
        $reponses = Reponse::getReponseByQuestionId($question_id);
        
        $questionnaire = Questionnaire::getQuestionnaireByName($questionnaire_name, $cours_name);
        $participant = Participant::getParticipantByQuestionnaireAndUser($questionnaire->questionnaire_id, $this->user->user_id);
        Proposition_Reponse::ajouterPropositionReponse($participant->participant_id, $question_id);
        
        $this->view->render('eleve/choixReponse', array(
            'cours_name' => $cours_name,
            'questionnaire_name' => $questionnaire_name,
            'question' => $question,
            'reponses' => $reponses
        ));
        return new Response();
    }
    
    public function reponseEffectueeAction($cours_name, $questionnaire_name, $question_id) 
    {
        $cours_name = str_replace('_', ' ', $cours_name);
        $questionnaire_name = str_replace('_', ' ', $questionnaire_name);
        $reponses = $this->request->getPostValue('reponse');
        
        $questionnaire = Questionnaire::getQuestionnaireByName($questionnaire_name, $cours_name);
        $participant = Participant::getParticipantByQuestionnaireAndUser($questionnaire->questionnaire_id, $this->user->user_id);
        $note = $participant->note;
        $nombre_de_fautes = $participant->nombre_de_fautes;
        $nombre_de_bonnes_reponses = $participant->nombre_de_bonnes_reponses;
        $nombreBonnesReponses = Question::getNombreBonnesReponsesByQuestion($question_id);
        
        $faux = false;
        if ($reponses == NULL) {
            if ($nombreBonnesReponses == 0) {
                $note++;
                $nombre_de_bonnes_reponses++;
            }
            else {
                $faux = true;
            }
            $nombre_de_fautes = $nombre_de_fautes + $nombreBonnesReponses;
        }
        else {
            for ($i=0;$i<count($reponses);$i++)
            {
                $reponse = Reponse::getReponseByReponseAndQuestion($reponses[$i], $question_id);
                if ($i == 0) {
                    Proposition_Reponse::miseAJourPropositionReponse($reponse->reponse_id, $question_id, $participant->participant_id);
                }
                else {
                    Proposition_Reponse::ajouterNouvellePropositionReponseComplete($participant->participant_id, $question_id, $reponse->reponse_id);
                }
                if ($reponse->reponse_correcte == 1) {
                    $nombre_de_bonnes_reponses++;
                    $note++;
                }
                else {
                    $nombre_de_fautes++;
                    $faux = true;
                }
            }
            $lesReponsesCorrectes = Reponse::getReponsesCorrectesByQuestion($question_id);
            foreach ($lesReponsesCorrectes as $reponseCorrecte) {
                $ok = false;
                for ($i=0;$i<count($reponses);$i++) {
                    $reponse = Reponse::getReponseByReponseAndQuestion($reponses[$i], $question_id);
                    if ($reponseCorrecte->reponse_id == $reponse->reponse_id) {
                        $ok = true;
                        break;
                    }
                }
                if (!$ok) {
                    $nombre_de_fautes++;
                    $faux = true;
                }
            }
        }
        $note = $note - $questionnaire->malus * $nombre_de_fautes;
        if ($note < 0) {
            $note = 0;
        }
        Participant::MiseAJourParticipant($nombre_de_fautes, $nombre_de_bonnes_reponses, $note, $participant->participant_id);
        $questions = Question::getQuestionsNonReponduesByQuestionnaireAndParticipant($participant->participant_id, $questionnaire->questionnaire_id);
        
        if (count($questions) == 0) {
            $moyenne = Participant::getMoyenneNoteByQuestionnaire($questionnaire->questionnaire_id);
            $noteMax = Participant::getMaxNoteByQuestionnaire($questionnaire->questionnaire_id);
            $noteMin = Participant::getMinNoteByQuestionnaire($questionnaire->questionnaire_id);
            $moyenneFautes = Participant::getMoyenneNombreDeFautesByQuestionnaire($questionnaire->questionnaire_id);
            $moyenneBonnesReponses = Participant::getMoyenneNombreDeBonnesReponseByQuestionnaire($questionnaire->questionnaire_id);
            $bareme = Questionnaire::getBareme($questionnaire->questionnaire_id);
            $baremeFautes = Questionnaire::getBaremeFautes($questionnaire->questionnaire_id);
            $this->view->render('eleve/resultat', array(
                'cours_name' => $cours_name,
                'questionnaire_name' => $questionnaire_name,
                'note' => $note,
                'nombre_de_fautes' => $nombre_de_fautes,
                'nombre_de_bonnes_reponses' => $nombre_de_bonnes_reponses,
                'moyenne' => $moyenne,
                'noteMax' => $noteMax,
                'noteMin' => $noteMin,
                'moyenneFautes' => $moyenneFautes,
                'moyenneBonnesReponses' => $moyenneBonnesReponses,
                'bareme' => $bareme,
                'baremeFautes' => $baremeFautes
            ));
            return new Response();
        }
        
        if ($questionnaire->mode_examen == 0) {
            if ($faux) {
                $reponsesCorrectes = Reponse::getReponsesCorrectesByQuestion($question_id);
                $erreur = "Faux, la ou les bonnes réponses étaient les suivantes : ";
                foreach ($reponsesCorrectes as $uneReponse) {
                    $erreur = $erreur.$uneReponse->reponse." / ";
                }
                $this->view->render('eleve/choixQuestion', array(
                    'cours_name' => $cours_name, 
                    'questionnaire_name' => $questionnaire_name,
                    'questions' => $questions,
                    'erreur' => $erreur
                ));
                return new Response();
            }
            else {
                $this->view->render('eleve/choixQuestion', array(
                    'cours_name' => $cours_name, 
                    'questionnaire_name' => $questionnaire_name,
                    'questions' => $questions,
                    'success' => "Bravo, vous avez coché la ou les bonnes réponses."
                ));
                return new Response();
            }
        }
        
        $this->view->render('eleve/choixQuestion', array(
            'cours_name' => $cours_name, 
            'questionnaire_name' => $questionnaire_name,
            'questions' => $questions
        ));
        
        return new Response();
    }
    
    public function reponseCompteurEffectueeAction($cours_name, $questionnaire_name, $compteur, $question_id) 
    {
        $cours_name = str_replace('_', ' ', $cours_name);
        $questionnaire_name = str_replace('_', ' ', $questionnaire_name);
        $reponses = $this->request->getPostValue('reponse');
        
        if ($reponses != NULL)
        {
            foreach ($reponses as $valeur)
            {
                $reponse = Reponse::getReponseByReponseAndQuestion($valeur, $question_id);
                
                if (!isset($premiereReponseCochee))
                {
                    $premiereReponseCochee = $reponse;
                }
                else if ($premiereReponseCochee->question_suivante_id == 0 && $reponse->question_suivante_id != 0)
                {
                    $premiereReponseCochee = $reponse;
                }
            }
        }
        
        $question_precedante = Question::getQuestionById($question_id);
        
        $questionnaire = Questionnaire::getQuestionnaireByName($questionnaire_name, $cours_name);
        $questions = Question::getQuestionByQuestionnaire($questionnaire->questionnaire_id);
        $participant = Participant::getParticipantByQuestionnaireAndUser($questionnaire->questionnaire_id, $this->user->user_id);
        $note = $participant->note;
        $nombre_de_fautes = $participant->nombre_de_fautes;
        $nombre_de_bonnes_reponses = $participant->nombre_de_bonnes_reponses;
        $nombreBonnesReponses = Question::getNombreBonnesReponsesByQuestion($question_precedante->question_id);
        
        $faux = false;
        if ($reponses == NULL) {
            if ($nombreBonnesReponses == 0) {
                $note++;
                $nombre_de_bonnes_reponses++;
            }
            else {
                $faux = true;
            }
            $nombre_de_fautes = $nombre_de_fautes + $nombreBonnesReponses;
        }
        else {
            for ($i=0;$i<count($reponses);$i++)
            {
                $reponse = Reponse::getReponseByReponseAndQuestion($reponses[$i], $question_precedante->question_id);
                if ($i == 0) {
                    Proposition_Reponse::miseAJourPropositionReponse($reponse->reponse_id, $question_precedante->question_id, $participant->participant_id);
                }
                else {
                    Proposition_Reponse::ajouterNouvellePropositionReponseComplete($participant->participant_id, $question_precedante->question_id, $reponse->reponse_id);
                }
                if ($reponse->reponse_correcte == 1) {
                    $nombre_de_bonnes_reponses++;
                    $note++;
                }
                else {
                    $nombre_de_fautes++;
                    $faux = true;
                }
            }
            $lesReponsesCorrectes = Reponse::getReponsesCorrectesByQuestion($question_precedante->question_id);
            foreach ($lesReponsesCorrectes as $reponseCorrecte) {
                $ok = false;
                for ($i=0;$i<count($reponses);$i++) {
                    $reponse = Reponse::getReponseByReponseAndQuestion($reponses[$i], $question_precedante->question_id);
                    if ($reponseCorrecte->reponse_id == $reponse->reponse_id) {
                        $ok = true;
                        break;
                    }
                }
                if (!$ok) {
                    $nombre_de_fautes++;
                    $faux = true;
                }
            }
        }
        $note = $note - $questionnaire->malus * $nombre_de_fautes;
        if ($note < 0) {
            $note = 0;
        }
        Participant::MiseAJourParticipant($nombre_de_fautes, $nombre_de_bonnes_reponses, $note, $participant->participant_id);
        
        $nombreQuestions = Question::getNombreQuestionsByQuestionnaire($questionnaire->questionnaire_id);
        
        $compteur++;
        
        if ($compteur == $nombreQuestions || (isset($premiereReponseCochee) && $premiereReponseCochee->question_suivante_id == -1)) 
        { 
            $moyenne = Participant::getMoyenneNoteByQuestionnaire($questionnaire->questionnaire_id);
            $noteMax = Participant::getMaxNoteByQuestionnaire($questionnaire->questionnaire_id);
            $noteMin = Participant::getMinNoteByQuestionnaire($questionnaire->questionnaire_id);
            $moyenneFautes = Participant::getMoyenneNombreDeFautesByQuestionnaire($questionnaire->questionnaire_id);
            $moyenneBonnesReponses = Participant::getMoyenneNombreDeBonnesReponseByQuestionnaire($questionnaire->questionnaire_id);
            $bareme = Questionnaire::getBareme($questionnaire->questionnaire_id);
            $baremeFautes = Questionnaire::getBaremeFautes($questionnaire->questionnaire_id);
            $this->view->render('eleve/resultat', array(
                'cours_name' => $cours_name,
                'questionnaire_name' => $questionnaire_name,
                'note' => $note,
                'nombre_de_fautes' => $nombre_de_fautes,
                'nombre_de_bonnes_reponses' => $nombre_de_bonnes_reponses,
                'moyenne' => $moyenne,
                'noteMax' => $noteMax,
                'noteMin' => $noteMin,
                'moyenneFautes' => $moyenneFautes,
                'moyenneBonnesReponses' => $moyenneBonnesReponses,
                'bareme' => $bareme,
                'baremeFautes' => $baremeFautes
            ));
            return new Response();
        }
        
        if (!isset($premiereReponseCochee) || $premiereReponseCochee->question_suivante_id == 0)
        {
            foreach ($questions as $uneQuestion)
            {
                if ($uneQuestion->question_id > $question_precedante->question_id)
                {
                    $reponses = Reponse::getReponseByQuestionId($uneQuestion->question_id);
                    
                    $question_suivante = $uneQuestion;
                    
                    break;
                }
            }
        }
        else if (isset($premiereReponseCochee) && $premiereReponseCochee->question_suivante_id > 0)
        {
            $reponses = Reponse::getReponseByQuestionId($premiereReponseCochee->question_suivante_id);
            
            $question_suivante = Question::getQuestionById($premiereReponseCochee->question_suivante_id);
        }
        
        if ($questionnaire->mode_examen == 0) {
            if ($faux) {
                $reponsesCorrectes = Reponse::getReponsesCorrectesByQuestion($question_precedante->question_id);
                $erreur = "Faux, la ou les bonnes réponses étaient les suivantes : ";
                foreach ($reponsesCorrectes as $uneReponse) 
                {
                    $erreur = $erreur.$uneReponse->reponse." / ";
                }
                $this->view->render('eleve/reponse', array(
                    'cours_name' => $cours_name, 
                    'questionnaire_name' => $questionnaire_name,
                    'question' => $question_suivante,
                    'reponses' => $reponses,
                    'compteur' => $compteur,
                    'erreur' => $erreur
                ));
                return new Response();
            }
            else {
                $this->view->render('eleve/reponse', array(
                    'cours_name' => $cours_name, 
                    'questionnaire_name' => $questionnaire_name,
                    'question' => $question_suivante,
                    'compteur' => $compteur,
                    'reponses' => $reponses,
                    'success' => "Bravo, vous avez coché la ou les bonnes réponses."
                ));
                return new Response();
            }
        }
        
        $this->view->render('eleve/reponse', array(
            'cours_name' => $cours_name, 
            'questionnaire_name' => $questionnaire_name,
            'question' => $question_suivante,
            'compteur' => $compteur,
            'reponses' => $reponses
        ));
        
        return new Response();
    }
    
    public function listeQuestionsEleveAction($cours_name)
    {
        $cours_name = str_replace('_', ' ', $cours_name);
        
        $cours = Cours::getCoursByName($cours_name);
        
        $questionsEleve = Question_Eleve::getQuestionsEleveByCoursID($cours->cours_id);
        
        $this->view->render('eleve/listeQuestionsEleve', array(
            'cours_name' => $cours_name, 
            'questionsEleve' => $questionsEleve
        ));
        
        return new Response();
    }
    
    public function poserQuestionEleveAction($cours_name)
    {
        $cours_name = str_replace('_', ' ', $cours_name);
        
        $this->view->render('eleve/poserQuestionEleve', array(
            'cours_name' => $cours_name
        ));
        
        return new Response();
    }
    
    public function ajouterQuestionEleveAction($cours_name)
    {
        $cours_name = str_replace('_', ' ', $cours_name);
        
        $questionEleve = $this->request->getPostValue("questionEleve");
        
        $cours = Cours::getCoursByName($cours_name);
        
        if (Question_Eleve::questionEleveExist($cours->cours_id, $questionEleve))
        {
            $erreur = "Erreur : Cette question existe déjà";
            
            $this->view->render('eleve/poserQuestionEleve', array(
                'cours_name' => $cours_name, 
                'erreur' => $erreur
            ));
            
            return new Response();
        }
        
        Question_Eleve::ajouterQuestionEleve($this->user->user_id, $cours->cours_id, $questionEleve);
        
        $questionsEleve = Question_Eleve::getQuestionsEleveByCoursID($cours->cours_id);
        
        $this->view->render('eleve/listeQuestionsEleve', array(
            'cours_name' => $cours_name, 
            'questionsEleve' => $questionsEleve,
            'success' => "Cette nouvelle question a été enregistrée."
        ));
        
        return new Response();
    }
    
    public function listeReponsesQuestionEleveAction($cours_name)
    {
        $cours_name = str_replace('_', ' ', $cours_name);
        
        $questionEleve = $this->request->getPostValue("questionEleve");
        
        $cours = Cours::getCoursByName($cours_name);
        
        $question_eleve = Question_Eleve::getQuestionEleveByCoursIDAndQuestion($cours->cours_id, $questionEleve);
        
        $reponsesQuestionEleve = Reponse_Question_Eleve::getReponsesQuestionEleveByQuestionEleveID($question_eleve->question_eleve_id);
        
        $this->view->render('eleve/listeReponsesQuestionEleve', array(
            'cours' => $cours,
            'question_eleve' => $question_eleve,
            'reponsesQuestionEleve' => $reponsesQuestionEleve
        ));
        
        return new Response();
    }
    
    public function rechercherCoursAction()
    {
        $recherche = $this->request->getPostValue('recherche_cours_name');
        
        $cours = Cours::getCoursByGroupeDuUser($this->user->user_id);
        
        if ($recherche == "")
        {
            $this->view->render('eleve/choixCours', array(
                'cours' => $cours
            ));
        }
        else 
        {
            $cours_tries = array();
            foreach ($cours as $unCours)
            {
                if (strstr($unCours->cours_name, $recherche))
                {
                    array_push($cours_tries, $unCours);
                }
            }
            $this->view->render('eleve/choixCours', array(
                'cours' => $cours_tries,
                'recherche' => true
            ));
        }
        
        return new Response();
    }
    
    public function rechercherQuestionnaireAction($cours_name)
    {
        $cours_name = str_replace('_', ' ', $cours_name);
        
        $recherche = $this->request->getPostValue('recherche_questionnaire_name');
        
        $questionnaires = Questionnaire::getQuestionnaireLanceeByCours($cours_name);
        
        if ($recherche == "")
        {
            $this->view->render('eleve/choixQuestionnaire', array(
                'cours_name' => $cours_name,
                'questionnaires' => $questionnaires
            ));
        }
        else 
        {
            $questionnaires_tries = array();
            foreach ($questionnaires as $questionnaire)
            {
                if (strstr($questionnaire->questionnaire_name, $recherche))
                {
                    array_push($questionnaires_tries, $questionnaire);
                }
            }
            $this->view->render('eleve/choixQuestionnaire', array(
                'cours_name' => $cours_name,
                'questionnaires' => $questionnaires_tries,
                'recherche' => true
            ));
        }
        
        return new Response();
    }
    
    public function rechercheQuestionEleveAction($cours_name)
    {
        $cours_name = str_replace('_', ' ', $cours_name);
        
        $recherche = $this->request->getPostValue('recherche_question_eleve');
        
        $cours = Cours::getCoursByName($cours_name);
        
        $questions_eleve = Question_Eleve::getQuestionsEleveByCoursID($cours->cours_id);
        
        if ($recherche == "")
        {
            $this->view->render('eleve/listeQuestionsEleve', array(
                'cours_name' => $cours_name,
                'questionsEleve' => $questions_eleve
            ));
        }
        else 
        {
            $questions_eleve_triees = array();
            foreach ($questions_eleve as $question_eleve)
            {
                if (strstr($question_eleve->question, $recherche))
                {
                    array_push($questions_eleve_triees, $question_eleve);
                }
            }
            $this->view->render('eleve/listeQuestionsEleve', array(
                'cours_name' => $cours_name,
                'questionsEleve' => $questions_eleve_triees,
                'recherche' => true
            ));
        }
        
        return new Response();
    }
    
}