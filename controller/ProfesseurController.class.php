<?php

class ProfesseurController extends Controller
{
    
    public function defaultAction() {
    }
    
    public function listeCoursAction()
    {
        $cours = Cours::getCoursByUser($this->user->user_id);
        $this->view->render('professeur/choixCours', array('cours' => $cours));
        return new Response();
    }
    
    public function listeModeAbsenceOuQuestionnaireAction()
    {
        $cours_name = $this->request->getPostValue('cours_name');
        
        $this->view->render('professeur/choixModeAbsenceOuQuestionnaire', array(
            'cours_name' => $cours_name
        ));
        
        return new Response();
    }
    
    public function retourListeModeAbsenceOuQuestionnaireAction($cours_name)
    {
        $cours_name = str_replace('_', ' ', $cours_name);
        
        $this->view->render('professeur/choixModeAbsenceOuQuestionnaire', array(
            'cours_name' => $cours_name
        ));
        
        return new Response();
    }
    
    public function listeQuestionnairesAction($cours_name) 
    {
        $cours_name = str_replace('_', ' ', $cours_name);
        
        $questionnaires = Questionnaire::getQuestionnaireByCours($cours_name);
        
        $this->view->render('professeur/choixQuestionnaire', array(
            'cours_name' => $cours_name,
            'questionnaires' => $questionnaires
        ));
        
        return new Response();
    }
    
    public function retourListeQuestionnairesAction($cours_name)
    {
        $cours_name = str_replace('_', ' ', $cours_name);
        
        $questionnaires = Questionnaire::getQuestionnaireByCours($cours_name);
        
        $this->view->render('professeur/choixQuestionnaire', array(
            'cours_name' => $cours_name,
            'questionnaires' => $questionnaires
        ));
        
        return new Response();
    }
    
    public function listeActionsAction($cours_name)
    {
        $cours_name = str_replace('_', ' ', $cours_name);
        
        $questionnaire_name = $this->request->getPostValue('questionnaire_name');
        
        $actions = array("Informations générales", "Liste des questions", "Aperçu partiel", "Aperçu total", "Statistiques générales", "Statistiques par participant", "Réinitialiser", "Supprimer");
        
        $this->view->render('professeur/choixAction', array(
            'cours_name' => $cours_name,
            'questionnaire_name' => $questionnaire_name,
            'actions' => $actions
        ));
        
        return new Response();
    }
    
    public function retourListeActionsAction($cours_name, $questionnaire_name)
    {
        $cours_name = str_replace('_', ' ', $cours_name);
        $questionnaire_name = str_replace('_', ' ', $questionnaire_name);
        
        $actions = array("Informations générales", "Liste des questions", "Aperçu partiel", "Aperçu total", "Statistiques générales", "Statistiques par participant", "Réinitialiser", "Supprimer");
        
        $this->view->render('professeur/choixAction', array(
            'cours_name' => $cours_name,
            'questionnaire_name' => $questionnaire_name,
            'actions' => $actions
        ));
        
        return new Response();
    }
    
    public function suiteActionAction($cours_name, $questionnaire_name)
    {
        $cours_name = str_replace('_', ' ', $cours_name);
        $questionnaire_name = str_replace('_', ' ', $questionnaire_name);
        
        $action = $this->request->getPostValue('action');
        $questionnaire = Questionnaire::getQuestionnaireByName($questionnaire_name, $cours_name);
        $questions = Question::getQuestionByQuestionnaire($questionnaire->questionnaire_id);
        $reponses = Reponse::getReponsesByQuestionnaire($questionnaire->questionnaire_id);
        $bareme = Questionnaire::getBareme($questionnaire->questionnaire_id);
        $baremeFautes = Questionnaire::getBaremeFautes($questionnaire->questionnaire_id);
        
        if ($action == "Informations générales") {
            $this->view->render('professeur/informationsGenerales', array(
                'questionnaire' => $questionnaire,
                'cours_name' => $cours_name,
                'bareme' => $bareme,
                'baremeFautes' => $baremeFautes
            ));
        }
        else if ($action == "Aperçu partiel") {
            $this->view->render('professeur/apercuPartiel', array(
                'questionnaire_name' => $questionnaire_name,
                'cours_name' => $cours_name,
                'questions' => $questions,
                'reponses' => $reponses
            ));
        }
        else if ($action == "Aperçu total") {
            $this->view->render('professeur/apercuTotal', array(
                'questionnaire_name' => $questionnaire_name,
                'cours_name' => $cours_name,
                'questions' => $questions,
                'reponses' => $reponses
            ));
        }
        else if ($action == "Statistiques générales") {
            $nombreParticipants = Participant::getNombreDeParticipantsByQuestionnaire($questionnaire->questionnaire_id);
            $moyenneNote = Participant::getMoyenneNoteByQuestionnaire($questionnaire->questionnaire_id);
            $maxNote = Participant::getMaxNoteByQuestionnaire($questionnaire->questionnaire_id);
            $minNote = Participant::getMinNoteByQuestionnaire($questionnaire->questionnaire_id);
            $moyenneNombreBonnesReponses = Participant::getMoyenneNombreDeBonnesReponseByQuestionnaire($questionnaire->questionnaire_id);
            $maxNombreBonnesReponses = Participant::getMaxNombreBonnesReponsesByQuestionnaire($questionnaire->questionnaire_id);
            $minNombreBonnesReponses = Participant::getMinNombreBonnesReponsesByQuestionnaire($questionnaire->questionnaire_id);
            $moyenneNombreFautes = Participant::getMoyenneNombreDeFautesByQuestionnaire($questionnaire->questionnaire_id);
            $maxNombreFautes = Participant::getMaxNombreFautesByQuestionnaire($questionnaire->questionnaire_id);
            $minNombreFautes = Participant::getMinNombreFautesByQuestionnaire($questionnaire->questionnaire_id);
            $this->view->render('professeur/statistiquesGenerales', array(
                'cours_name' => $cours_name,
                'questionnaire' => $questionnaire,
                'nombreParticipants' => $nombreParticipants,
                'moyenneNote' => $moyenneNote,
                'maxNote' => $maxNote,
                'minNote' => $minNote,
                'moyenneNombreBonnesReponses' => $moyenneNombreBonnesReponses,
                'maxNombreBonnesReponses' => $maxNombreBonnesReponses,
                'minNombreBonnesReponses' => $minNombreBonnesReponses,
                'moyenneNombreFautes' => $moyenneNombreFautes,
                'maxNombreFautes' => $maxNombreFautes,
                'minNombreFautes' => $minNombreFautes
            ));
        }
        else if ($action == "Réinitialiser") {
            $this->view->render('professeur/confirmationAction', array(
                'cours_name' => $cours_name,
                'questionnaire_name' => $questionnaire_name,
                'action' => 'réinitialiser'
            ));
        }
        else if ($action == "Supprimer") {
            $this->view->render('professeur/confirmationAction', array(
                'cours_name' => $cours_name,
                'questionnaire_name' => $questionnaire_name,
                'action' => 'supprimer'
            ));
        }
        else if ($action == "Liste des questions")
        {
            $this->view->render('professeur/choixQuestion', array(
                'cours_name' => $cours_name,
                'questionnaire_name' => $questionnaire_name,
                'questions' => $questions
            ));
        }
        else if ($action == "Statistiques par participant")
        {
            $participants = Participant::getParticipantByQuestionnaireOrderByLogin($questionnaire->questionnaire_id);
            
            $this->view->render('professeur/statistiquesParticipants', array(
                'cours_name' => $cours_name,
                'questionnaire_name' => $questionnaire_name,
                'participants' => $participants
            ));
        }
        
        return new Response();
    }
    
    public function executionActionAction($cours_name, $questionnaire_name, $action)
    {
        $cours_name = str_replace('_', ' ', $cours_name);
        $questionnaire_name = str_replace('_', ' ', $questionnaire_name);
        
        $questionnaire = Questionnaire::getQuestionnaireByName($questionnaire_name, $cours_name);
        
        if ($action == "supprimer") {
            Questionnaire::supprimerQuestionnaireByID($questionnaire->questionnaire_id);
            
            $questionnaires = Questionnaire::getQuestionnaireByCours($cours_name);
            
            $this->view->render('professeur/choixQuestionnaire', array(
                'cours_name' => $cours_name,
                'questionnaires' => $questionnaires,
                'success' => "Le questionnaire (" . $questionnaire->questionnaire_name . ") a été supprimé."
            ));
        }
        else {
            $participants = Participant::getParticipantsByQuestionnaire($questionnaire->questionnaire_id);
            Participant::reinitialisationParticipantsByQuestionnaire($questionnaire->questionnaire_id);
            foreach ($participants as $participant) {
                Proposition_Reponse::supprimerPropostionReponseByParticipant($participant->participant_id);
            }
            
            $actions = array("Informations générales", "Aperçu partiel", "Aperçu total", "Statistiques générales", "Réinitialiser", "Supprimer");
            
            $this->view->render('professeur/choixAction', array(
                'cours_name' => $cours_name,
                'questionnaire_name' => $questionnaire_name,
                'actions' => $actions,
                'success' => "Le questionnaire (" . $questionnaire_name . ") a été réinitialisé."
            ));
        }
        return new Response();
    }
    
    public function modificationInformationsGeneralesQuestionnaireAction($cours_name, $questionnaire_name)
    {
        $cours_name = str_replace('_', ' ', $cours_name);
        $questionnaire_name = str_replace('_', ' ', $questionnaire_name);
        $questionnaire = Questionnaire::getQuestionnaireByName($questionnaire_name, $cours_name);
        
        $new_questionnaire_name = $this->request->getPostValue('questionnaire_name');
        $malus = $this->request->getPostValue('malus');
        $mode_examen = $this->request->getPostValue('mode_examen');
        $pause = $this->request->getPostValue('pause');
        $lancee = $this->request->getPostValue('lancee');
        
        if ($malus == "" || !is_numeric($malus) || $malus < 0)
        {
            $malus = $questionnaire->malus;
        }
       
        if ($new_questionnaire_name == "")
        {
            $new_questionnaire_name = $questionnaire->questionnaire_name;
        }
        
        if ($mode_examen == NULL)
        {
            if ($questionnaire->mode_examen == 1)
            {
                $mode_examen = 'Oui';
            }
            else 
            {
                $mode_examen = 'Non';
            }
        }
        
        if ($pause == NULL)
        {
            if ($questionnaire->pause == 1)
            {
                $pause = 'Oui';
            }
            else 
            {
                $pause = 'Non';
            }
        }
        else 
        {
            if ($questionnaire->pause == 1)
            {
                $pause = 'Non';
            }
            else 
            {
                $pause = 'Oui';
            }
        }
        
        if ($lancee == NULL)
        {
            if ($questionnaire->lancee == 1)
            {
                $lancee = 'Oui';
            }
            else 
            {
                $lancee = 'Non';
            }
        }
        
        Questionnaire::miseAJourQuestionnaire($questionnaire->questionnaire_name, $new_questionnaire_name, $mode_examen, $cours_name, $cours_name, $malus, $pause, $lancee);
        
        $bareme = Questionnaire::getBareme($questionnaire->questionnaire_id);
        $baremeFautes = Questionnaire::getBaremeFautes($questionnaire->questionnaire_id);
        
        $questionnaire = Questionnaire::getQuestionnaireByName($questionnaire_name, $cours_name);
        
        $this->view->render('professeur/informationsGenerales', array(
            'questionnaire' => $questionnaire,
            'cours_name' => $cours_name,
            'bareme' => $bareme,
            'baremeFautes' => $baremeFautes,
            'success' => "Les informations du questionnaire (" . $questionnaire->questionnaire_name . ") ont été mis à jour."
        ));
        
        return new Response();
    }
    
    public function formulaireCreationQuestionnaireAction($cours_name)
    {
        $cours_name = str_replace('_', ' ', $cours_name);
        
        $this->view->render('professeur/formulaireCreationQuestionnaire', array(
            'cours_name' => $cours_name
        ));
        
        return new Response();
    }
    
    public function creationQuestionnaireAction($cours_name)
    {
        $cours_name = str_replace('_', ' ', $cours_name);
        
        $questionnaire_name = $this->request->getPostValue("questionnaire_name");
        $malus = $this->request->getPostValue("malus");
        $mode_examen = $this->request->getPostValue("mode_examen");
        $pause = $this->request->getPostValue("pause");
        
        $erreur = "";
        
        if ($questionnaire_name == "")
        {
            $erreur = "Nom du questionnaire incorrect";
        }
        else if (Questionnaire::nomQuestionnaireExist($questionnaire_name, $cours_name))
        {
            $erreur = "Ce nom de questionnaire existe déjà";
        }
        else if ($malus != "" && (!is_numeric($malus) || $malus < 0))
        {
            $erreur = "Malus incorrect";
        }
        
        if ($malus == "")
        {
            $malus = 0;
        }
        
        if ($erreur != "")
        {
            $this->view->render('professeur/formulaireCreationQuestionnaire', array(
                'cours_name' => $cours_name,
                'erreur' => $erreur
            ));
            
            return new Response();
        }
        
        if ($mode_examen == NULL)
        {
            $mode_examen = "Non";
        }
        
        if ($pause == NULL)
        {
            $pause = "Oui";
        }
        else 
        {
            $pause = "Non";
        }
        
        
        $cours = Cours::getCoursByName($cours_name);
        
        Questionnaire::ajouterQuestionnaire($cours->cours_id, $questionnaire_name, $mode_examen, $malus, $pause);
        
        $users = User::getUsersByGroupeId($cours->groupe_id);
        
        $questionnaire = Questionnaire::getQuestionnaireByName($questionnaire_name, $cours->cours_name);
        
        foreach ($users as $user)
        {
            Participant::ajouterParticipant($user->user_id, $questionnaire->questionnaire_id, 0, 0, 0);
        }
        
        $questionnaires = Questionnaire::getQuestionnaireByCours($cours_name);
        
        $this->view->render('professeur/choixQuestionnaire', array(
            'cours_name' => $cours_name,
            'questionnaires' => $questionnaires,
            'success' => "Le questionnaire (" . $questionnaire_name . ") a été créé."
        ));
        
        return new Response();
    }
    
    public function retourListeQuestionsAction($cours_name, $questionnaire_name)
    {
        $cours_name = str_replace('_', ' ', $cours_name);
        $questionnaire_name = str_replace('_', ' ', $questionnaire_name);
        
        $questionnaire = Questionnaire::getQuestionnaireByName($questionnaire_name, $cours_name);
        
        $questions = Question::getQuestionByQuestionnaire($questionnaire->questionnaire_id);
        
        $this->view->render('professeur/choixQuestion', array(
            'cours_name' => $cours_name,
            'questionnaire_name' => $questionnaire_name,
            'questions' => $questions
        ));
        
        return new Response();
    }
    
    public function formulaireCreationQuestionAction($cours_name, $questionnaire_name)
    {
        $cours_name = str_replace('_', ' ', $cours_name);
        $questionnaire_name = str_replace('_', ' ', $questionnaire_name);
        
        $this->view->render('professeur/formulaireCreationQuestion', array(
            'cours_name' => $cours_name,
            'questionnaire_name' => $questionnaire_name
        ));
        
        return new Response();
    }
    
    public function creationQuestionAction($cours_name, $questionnaire_name)
    {
        $cours_name = str_replace('_', ' ', $cours_name);
        $questionnaire_name = str_replace('_', ' ', $questionnaire_name);
        
        $questionnaire = Questionnaire::getQuestionnaireByName($questionnaire_name, $cours_name);
        
        $question = $this->request->getPostValue("question");
        $temps_imparti = $this->request->getPostValue("temps_imparti");
        
        $erreur = "";
        
        if ($question == "")
        {
            $erreur = "Champ question incorrect";
        }
        else if (Question::questionExiste($questionnaire->questionnaire_id, $question))
        {
            $erreur = "Champ question incorrect : cette question existe déjà";
        }
        else if ($temps_imparti != "" && (!is_numeric($temps_imparti) || $temps_imparti < 0)) // $temps_imparti == ""
        {
            $erreur = "Champ temps imparti incorrect";
        }
        
        if ($temps_imparti == "")
        {
            $temps_imparti = 0;
        }
        
        if ($erreur != "")
        {
            $this->view->render('professeur/formulaireCreationQuestion', array(
                'cours_name' => $cours_name,
                'questionnaire_name' => $questionnaire_name,
                'erreur' => $erreur
            ));
            
            return new Response();
        }
        
        $questionnaire = Questionnaire::getQuestionnaireByName($questionnaire_name, $cours_name);
        
        Question::ajouterQuestion($questionnaire->questionnaire_id, $question, $temps_imparti, "");
        
        $questions = Question::getQuestionByQuestionnaire($questionnaire->questionnaire_id);
        
        $this->view->render('professeur/choixQuestion', array(
            'cours_name' => $cours_name,
            'questionnaire_name' => $questionnaire_name,
            'questions' => $questions,
            'success' => "La question a été ajoutée."
        ));
        
        return new Response();
    }
    
    public function listeActionsQuestionAction($cours_name, $questionnaire_name)
    {
        $cours_name = str_replace('_', ' ', $cours_name);
        $questionnaire_name = str_replace('_', ' ', $questionnaire_name);
        
        $question = $this->request->getPostValue('question');
        
        $laQuestion = Question::getQuestionByName($question, $questionnaire_name, $cours_name);
        
        $actions = array("Modifier la question", "Liste des réponses", "Statistiques", "Supprimer");
        
        $this->view->render('professeur/choixActionQuestion', array(
            'cours_name' => $cours_name,
            'questionnaire_name' => $questionnaire_name,
            'question' => $laQuestion,
            'actions' => $actions
        ));
        
        return new Response();
    }
    
    public function retourListeActionsQuestionAction($cours_name, $questionnaire_name, $question_id)
    {
        $cours_name = str_replace('_', ' ', $cours_name);
        $questionnaire_name = str_replace('_', ' ', $questionnaire_name);
        
        $question = Question::getQuestionById($question_id);
        
        $actions = array("Modifier la question", "Liste des réponses", "Statistiques", "Supprimer");
        
        $this->view->render('professeur/choixActionQuestion', array(
            'cours_name' => $cours_name,
            'questionnaire_name' => $questionnaire_name,
            'question' => $question,
            'actions' => $actions
        ));
        
        return new Response();
    }
    
    public function suiteActionQuestionAction($cours_name, $questionnaire_name, $question_id)
    {
        $cours_name = str_replace('_', ' ', $cours_name);
        $questionnaire_name = str_replace('_', ' ', $questionnaire_name);
        
        $action = $this->request->getPostValue("action");
        
        $question = Question::getQuestionById($question_id);
        $questionnaire = Questionnaire::getQuestionnaireByName($questionnaire_name, $cours_name);
        
        if ($action == "Modifier la question")
        {
            $this->view->render('professeur/formulaireModificationQuestion', array(
                'cours_name' => $cours_name,
                'questionnaire_name' => $questionnaire_name,
                'question' => $question
            ));
        }
        else if ($action == "Liste des réponses")
        {
            $reponses = Reponse::getReponseByQuestionId($question->question_id);
            
            $this->view->render('professeur/listeReponses', array(
                'cours_name' => $cours_name,
                'questionnaire_name' => $questionnaire_name,
                'question' => $question,
                'reponses' => $reponses
            ));
        }
        else if ($action == "Statistiques")
        {
            $nombreParticipants = Participant::getNombreDeParticipantsByQuestionnaire($questionnaire->questionnaire_id);
            $nombreBonnesReponsesParticipant = Question::getNombreBonnesReponsesParticipantByQuestion($question_id);
            $nombreFautesParticipant = Question::getNombreFautesParticipantByQuestion($question_id);
            $nombreTypesReponses = Question::getNombreTypesReponsesByQuestion($question_id);
            $nombreReponsesSansReponse = Question::getNombreReponsesSansReponse($question_id);
            
            $this->view->render('professeur/statistiquesQuestionReponses' , array(
                'cours_name' => $cours_name,
                'questionnaire_name' => $questionnaire_name,
                'question' => $question,
                'nombreParticipants' => $nombreParticipants,
                'nombreBonnesReponsesParticipant' => $nombreBonnesReponsesParticipant,
                'nombreFautesParticipant' => $nombreFautesParticipant,
                'nombreTypesReponses' => $nombreTypesReponses,
                'nombreReponsesSansReponse' => $nombreReponsesSansReponse
            ));
        }
        else if ($action == "Supprimer")
        {
            $this->view->render('professeur/confirmationAction', array(
                'cours_name' => $cours_name,
                'questionnaire_name' => $questionnaire_name,
                'question' => $question,
                'action' => 'supprimer'
            ));
        }
        
        return new Response();
    }
    
    public function executerSuppressionQuestionAction($cours_name, $questionnaire_name, $question_id)
    {
        $cours_name = str_replace('_', ' ', $cours_name);
        $questionnaire_name = str_replace('_', ' ', $questionnaire_name);
        
        Question::supprimerQuestionById($question_id);
        
        $questionnaire = Questionnaire::getQuestionnaireByName($questionnaire_name, $cours_name);
        
        $questions = Question::getQuestionByQuestionnaire($questionnaire->questionnaire_id);

        $this->view->render('professeur/choixQuestion', array(
            'cours_name' => $cours_name,
            'questionnaire_name' => $questionnaire_name,
            'questions' => $questions,
            'success' => "La question a été supprimée."
        ));
        
        return new Response();
    }
    
    public function modifierQuestionAction($cours_name, $questionnaire_name, $question_id)
    {
        $cours_name = str_replace('_', ' ', $cours_name);
        $questionnaire_name = str_replace('_', ' ', $questionnaire_name);
        
        $question = Question::getQuestionById($question_id);
        
        $new_question = $this->request->getPostValue("question");
        $temps_imparti = $this->request->getPostValue("temps_imparti");
        
        if ($new_question == "")
        {
            $new_question = $question->question;
        }
        
        if ($temps_imparti == "" || !is_numeric($temps_imparti) || $temps_imparti < 0)
        {
            $temps_imparti = $question->temps_imparti;
        }
        
        Question::miseAJourQuestion($question_id, $new_question, $temps_imparti, $question->image);
        
        $question = Question::getQuestionById($question_id);
        
        $actions = array("Modifier la question", "Liste des réponses", "Statistiques", "Supprimer");
        
        $this->view->render('professeur/choixActionQuestion', array(
            'cours_name' => $cours_name,
            'questionnaire_name' => $questionnaire_name,
            'question' => $question,
            'actions' => $actions,
            'success' => "La question a été modifiée."
        ));
        
        return new Response();
    }
    
    public function creerReponseAction($cours_name, $questionnaire_name, $question_id)
    {
        $cours_name = str_replace('_', ' ', $cours_name);
        $questionnaire_name = str_replace('_', ' ', $questionnaire_name);
        
        $question = Question::getQuestionById($question_id);
        
        $questionnaire = Questionnaire::getQuestionnaireByName($questionnaire_name, $cours_name);
        
        $questions = Question::getQuestionByQuestionnaire($questionnaire->questionnaire_id);
        
        $this->view->render('professeur/formulaireCreationReponse', array(
            'cours_name' => $cours_name,
            'questionnaire_name' => $questionnaire_name,
            'question' => $question,
            'questions' => $questions 
        ));
        
        return new Response();
    }
    
    public function creationReponseAction($cours_name, $questionnaire_name, $question_id)
    {
        $cours_name = str_replace('_', ' ', $cours_name);
        $questionnaire_name = str_replace('_', ' ', $questionnaire_name);
        
        $reponse = $this->request->getPostValue("reponse");
        $reponse_correcte = $this->request->getPostValue("reponse_correcte");
        $question_suivante_question = $this->request->getPostValue("question_suivante");
        
        if ($reponse == "" || Reponse::reponseExiste($question_id, $reponse))
        {
            $erreur = "Champ réponse incorrect";
            
            $question = Question::getQuestionById($question_id);
            
            $this->view->render('professeur/formulaireCreationReponse', array(
                'cours_name' => $cours_name,
                'questionnaire_name' => $questionnaire_name,
                'question' => $question,
                'erreur' => $erreur
            ));
            
            return new Response();
        }
        
        if ($reponse_correcte == NULL)
        {
            $reponse_correcte = "Non";
        }
        
        if ($question_suivante_question == "Aucune question suivante")
        {
            $question_suivante_id = -1;
        }
        else if ($question_suivante_question == "Par défaut")
        {
            $question_suivante_id = 0;
        }
        else 
        {
            $question_suivante = Question::getQuestionByName($question_suivante_question, $questionnaire_name, $cours_name);
            
            $question_suivante_id = $question_suivante->question_id;
        }
        
        Reponse::ajouterReponse($question_id, $reponse, $reponse_correcte, "", $question_suivante_id);
        
        $question = Question::getQuestionById($question_id);
        
        $reponses = Reponse::getReponseByQuestionId($question_id);
        
        $this->view->render('professeur/listeReponses', array(
            'cours_name' => $cours_name,
            'questionnaire_name' => $questionnaire_name,
            'question' => $question,
            'reponses' => $reponses,
            'success' => "La réponse (" . $reponse . ") a été ajouté."
        ));
        
        return new Response();
    }
    
    public function retourListeReponsesAction($cours_name, $questionnaire_name, $question_id)
    {
        $cours_name = str_replace('_', ' ', $cours_name);
        $questionnaire_name = str_replace('_', ' ', $questionnaire_name);
        
        $question = Question::getQuestionById($question_id);
        
        $reponses = Reponse::getReponseByQuestionId($question_id);
        
        $this->view->render('professeur/listeReponses', array(
            'cours_name' => $cours_name,
            'questionnaire_name' => $questionnaire_name,
            'question' => $question,
            'reponses' => $reponses
        ));
        
        return new Response();
    }
    
    public function modifierReponseAction($cours_name, $questionnaire_name, $question_id)
    {
        $cours_name = str_replace('_', ' ', $cours_name);
        $questionnaire_name = str_replace('_', ' ', $questionnaire_name);
        
        $reponse_id = $this->request->getPostValue("reponse_id");
        
        $reponse = Reponse::getReponseById($reponse_id);
        
        $question = Question::getQuestionById($question_id);
        
        $this->view->render('professeur/formulaireModificationReponse', array(
            'cours_name' => $cours_name,
            'questionnaire_name' => $questionnaire_name,
            'question' => $question,
            'reponse' => $reponse
        ));
        
        return new Response();
    }
    
    public function modificationReponseAction($cours_name, $questionnaire_name, $question_id, $reponse_id)
    {
        $cours_name = str_replace('_', ' ', $cours_name);
        $questionnaire_name = str_replace('_', ' ', $questionnaire_name);
        
        $new_reponse = $this->request->getPostValue("reponse");
        $reponse_correcte = $this->request->getPostValue("reponse_correcte");
        $question_suivante_question = $this->request->getPostValue("question_suivante");
        
        $reponse = Reponse::getReponseById($reponse_id);
        
        if (Reponse::reponseExiste($question_id, $new_reponse))
        {
            $erreur = "Champ réponse incorrect : cette réponse existe déjà";
            
            $question = Question::getQuestionById($question_id);
            
            $this->view->render('professeur/formulaireModificationReponse', array(
                'cours_name' => $cours_name,
                'questionnaire_name' => $questionnaire_name,
                'question' => $question,
                'reponse' => $reponse,
                'erreur' => $erreur
            ));
            
            return new Response();
        }
        
        if ($reponse_correcte == NULL)
        {
            $reponse_correcte = "Non";
        }
        
        if ($new_reponse == "")
        {
            $new_reponse = $reponse->reponse;
        }
        
        if ($question_suivante_question == "Aucune question suivante")
        {
            $question_suivante_id = -1;
        }
        else if ($question_suivante_question == "Par défaut")
        {
            $question_suivante_id = 0;
        }
        else 
        {
            $question_suivante = Question::getQuestionByName($question_suivante_question, $questionnaire_name, $cours_name);
            
            $question_suivante_id = $question_suivante->question_id;
        }
        
        Reponse::miseAJourReponse($new_reponse, $reponse_correcte, $reponse_id, "", $question_suivante_id);
        
        $question = Question::getQuestionById($question_id);
        
        $reponses = Reponse::getReponseByQuestionId($question_id);
        
        $this->view->render('professeur/listeReponses', array(
            'cours_name' => $cours_name,
            'questionnaire_name' => $questionnaire_name,
            'question' => $question,
            'reponses' => $reponses,
            'success' => "La réponse (" . $new_reponse . ") a été modifiée."
        ));
        
        return new Response();
    }
    
    public function supprimerReponseAction($cours_name, $questionnaire_name, $question_id)
    {
        $cours_name = str_replace('_', ' ', $cours_name);
        $questionnaire_name = str_replace('_', ' ', $questionnaire_name);
        
        $reponse_id = $this->request->getPostValue("reponse_id");
        
        $reponse = Reponse::getReponseById($reponse_id);
        
        $action = "supprimer";
        
        $this->view->render('professeur/confirmationAction', array(
            'cours_name' => $cours_name,
            'questionnaire_name' => $questionnaire_name,
            'question_id' => $question_id,
            'reponse' => $reponse,
            'action' => $action
        ));
        
        return new Response();
    }
    
    public function executerSuppressionReponseAction($cours_name, $questionnaire_name, $question_id, $reponse_id)
    {
        $cours_name = str_replace('_', ' ', $cours_name);
        $questionnaire_name = str_replace('_', ' ', $questionnaire_name);
        
        Reponse::supprimerReponseById($reponse_id);
        
        $question = Question::getQuestionById($question_id);
        
        $reponses = Reponse::getReponseByQuestionId($question_id);
        
        $this->view->render('professeur/listeReponses', array(
            'cours_name' => $cours_name,
            'questionnaire_name' => $questionnaire_name,
            'question' => $question,
            'reponses' => $reponses,
            'success' => "La réponse a été supprimée."
        ));
        
        return new Response();
    }
    
    public function listeElevesAction($cours_name) 
    {
        $cours_name = str_replace('_', ' ', $cours_name);
        
        $cours = Cours::getCoursByName($cours_name);
        
        $users = User::getUsersByGroupeId($cours->groupe_id);
        
        $this->view->render('professeur/listeEleves', array(
            'cours_name' => $cours_name,
            'users' => $users
        ));
        
        return new Response();
    }
    
    public function ValidationPresencesAction($cours_name)
    {
        $cours_name = str_replace('_', ' ', $cours_name);
        
        $cours = Cours::getCoursByName($cours_name);
        
        $users = User::getUsersByGroupeId($cours->groupe_id);
        
        $day = $this->request->getPostValue("day");
        $month = $this->request->getPostValue("month");
        $year = $this->request->getPostValue("year");
        
        $date_value = $day . "/" . $month . "/" . $year;
        
        foreach ($users as $user) 
        {
            $etat = $this->request->getPostValue($user->user_id);
            
            if ($etat == "En retard")
            {
                Retard::ajouterRetard($user->user_id, $cours->cours_id, $date_value);
            }
            else if ($etat == "Absent")
            {
                Absence::ajouterAbsence($user->user_id, $cours->cours_id, $date_value);
            }
        }
        
        $cours = Cours::getCoursByUser($this->user->user_id);
        
        $this->view->render('professeur/choixCours', array(
            'cours' => $cours,
            'success' => "Les absences, présences et retards ont été enregistrés."
        ));
        
        return new Response();
    }
    
    public function listeQuestionsEleveAction($cours_name)
    {
        $cours_name = str_replace('_', ' ', $cours_name);
        
        $cours = Cours::getCoursByName($cours_name);
        
        $questionsEleve = Question_Eleve::getQuestionsEleveByCoursID($cours->cours_id);
        
        $this->view->render('professeur/listeQuestionsEleve', array(
            'cours_name' => $cours_name, 
            'questionsEleve' => $questionsEleve
        ));
        
        return new Response();
    }
    
    public function listeReponsesQuestionEleveAction($cours_name)
    {
        $cours_name = str_replace('_', ' ', $cours_name);
        
        $questionEleve = $this->request->getPostValue('questionEleve');
        
        $cours = Cours::getCoursByName($cours_name);
        
        $question_eleve = Question_Eleve::getQuestionEleveByCoursIDAndQuestion($cours->cours_id, $questionEleve);
        
        $reponsesQuestionEleve = Reponse_Question_Eleve::getReponsesQuestionEleveByQuestionEleveID($question_eleve->question_eleve_id);
        
        $this->view->render('professeur/listeReponsesQuestionEleve', array(
            'cours' => $cours,
            'question_eleve' => $question_eleve,
            'reponsesQuestionEleve' => $reponsesQuestionEleve
        ));
        
        return new Response();
    }
    
    public function retourListeReponsesQuestionEleveAction($cours_name, $questionEleve)
    {
        $cours_name = str_replace('_', ' ', $cours_name);
        
        $questionEleve = str_replace('_', ' ', $questionEleve);
        
        $cours = Cours::getCoursByName($cours_name);
        
        $question_eleve = Question_Eleve::getQuestionEleveByCoursIDAndQuestion($cours->cours_id, $questionEleve);
        
        $reponsesQuestionEleve = Reponse_Question_Eleve::getReponsesQuestionEleveByQuestionEleveID($question_eleve->question_eleve_id);
        
        $this->view->render('professeur/listeReponsesQuestionEleve', array(
            'cours' => $cours,
            'question_eleve' => $question_eleve,
            'reponsesQuestionEleve' => $reponsesQuestionEleve
        ));
        
        return new Response();
    }
    
    public function creerReponseQuestionEleveAction($cours_name, $question_eleve)
    {
        $cours_name = str_replace('_', ' ', $cours_name);
        
        $question_eleve = str_replace('_', ' ', $question_eleve);
        
        $this->view->render('professeur/formulaireCreationReponseQuestionEleve', array(
            'cours_name' => $cours_name,
            'question_eleve' => $question_eleve
        ));
        
        return new Response();
    }
    
    public function creationReponseQuestionEleveAction($cours_name, $question_eleve)
    {
        $cours_name = str_replace('_', ' ', $cours_name);
        
        $question_eleve = str_replace('_', ' ', $question_eleve);
        
        $reponseQuestionEleve = $this->request->getPostValue("reponseQuestionEleve");
        
        $cours = Cours::getCoursByName($cours_name);
        
        $questionEleve = Question_Eleve::getQuestionEleveByCoursIDAndQuestion($cours->cours_id, $question_eleve);
        
        Reponse_Question_Eleve::ajouterReponseQuestionEleve($questionEleve->question_eleve_id, $this->user->user_id, $reponseQuestionEleve);
        
        $reponsesQuestionEleve = Reponse_Question_Eleve::getReponsesQuestionEleveByQuestionEleveID($question_eleve->question_eleve_id);
        
        $this->view->render('professeur/listeReponsesQuestionEleve', array(
            'cours' => $cours,
            'question_eleve' => $questionEleve,
            'reponsesQuestionEleve' => $reponsesQuestionEleve,
            'success' => 'La réponse à la question a été enregistrée.'
        ));
        
        return new Response();
    }
    
    public function rechercherCoursAction()
    {
        $recherche = $this->request->getPostValue('recherche_cours_name');
        
        $cours = Cours::getCoursByUser($this->user->user_id);
        
        if ($recherche == "")
        {
            $this->view->render('professeur/choixCours', array(
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
            $this->view->render('professeur/choixCours', array(
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
        
        $questionnaires = Questionnaire::getQuestionnaireByCours($cours_name);
        
        if ($recherche == "")
        {
            $this->view->render('professeur/choixQuestionnaire', array(
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
            $this->view->render('professeur/choixQuestionnaire', array(
                'cours_name' => $cours_name,
                'questionnaires' => $questionnaires_tries,
                'recherche' => true
            ));
        }
        
        return new Response();
    }
    
    public function rechercherQuestionAction($cours_name, $questionnaire_name)
    {
        $cours_name = str_replace('_', ' ', $cours_name);
        $questionnaire_name = str_replace('_', ' ', $questionnaire_name);
        
        $recherche = $this->request->getPostValue('recherche_question');
        
        $questionnaire = Questionnaire::getQuestionnaireByName($questionnaire_name, $cours_name);
        
        $questions = Question::getQuestionByQuestionnaire($questionnaire->questionnaire_id);
        
        if ($recherche == "")
        {
            $this->view->render('professeur/choixQuestion', array(
                'cours_name' => $cours_name,
                'questionnaire_name' => $questionnaire_name,
                'questions' => $questions
            ));
        }
        else 
        {
            $questions_triees = array();
            foreach ($questions as $question)
            {
                if (strstr($question->question, $recherche))
                {
                    array_push($questions_triees, $question);
                }
            }
            $this->view->render('professeur/choixQuestion', array(
                'cours_name' => $cours_name,
                'questionnaire_name' => $questionnaire_name,
                'questions' => $questions_triees,
                'recherche' => true
            ));
        }
        
        return new Response();
    }
    
    public function annulerRechercheQuestionAction($cours_name, $questionnaire_name)
    {
        $cours_name = str_replace('_', ' ', $cours_name);
        $questionnaire_name = str_replace('_', ' ', $questionnaire_name);
        
        $questionnaire = Questionnaire::getQuestionnaireByName($questionnaire_name, $cours_name);
        
        $questions = Question::getQuestionByQuestionnaire($questionnaire->questionnaire_id);
        
        $this->view->render('professeur/choixQuestion', array(
            'cours_name' => $cours_name,
            'questionnaire_name' => $questionnaire_name,
            'questions' => $questions
        ));
        
        return new Response();
    }
    
    public function rechercherParticipantStatistiquesAction($cours_name, $questionnaire_name)
    {
        $cours_name = str_replace('_', ' ', $cours_name);
        $questionnaire_name = str_replace('_', ' ', $questionnaire_name);
        
        $recherche = $this->request->getPostValue('recherche_participant');
        
        $questionnaire = Questionnaire::getQuestionnaireByName($questionnaire_name, $cours_name);
        
        $participants = Participant::getParticipantByQuestionnaireOrderByLogin($questionnaire->questionnaire_id);
        
        if ($recherche == "")
        {
            $this->view->render('professeur/statistiquesParticipants', array(
                'cours_name' => $cours_name,
                'questionnaire_name' => $questionnaire_name,
                'participants' => $participants
            ));
        }
        else 
        {
            $participants_tries = array();
            foreach ($participants as $participant)
            {
                if (strstr($participant->login, $recherche))
                {
                    array_push($participants_tries, $participant);
                }
            }
            $this->view->render('professeur/statistiquesParticipants', array(
                'cours_name' => $cours_name,
                'questionnaire_name' => $questionnaire_name,
                'participants' => $participants_tries,
                'recherche' => true
            ));
        }
        
        return new Response();
    }
    
    public function annulerRechercheParticipantStatistiquesAction($cours_name, $questionnaire_name)
    {
        $cours_name = str_replace('_', ' ', $cours_name);
        $questionnaire_name = str_replace('_', ' ', $questionnaire_name);
        
        $questionnaire = Questionnaire::getQuestionnaireByName($questionnaire_name, $cours_name);
        
        $participants = Participant::getParticipantByQuestionnaireOrderByLogin($questionnaire->questionnaire_id);
        
        $this->view->render('professeur/statistiquesParticipants', array(
            'cours_name' => $cours_name,
            'questionnaire_name' => $questionnaire_name,
            'participants' => $participants
        ));
        
        return new Response();
    }
    
    public function rechercherEleveAction($cours_name)
    {
        $cours_name = str_replace('_', ' ', $cours_name);
        
        $recherche = $this->request->getPostValue('recherche_eleve');
        
        $cours = Cours::getCoursByName($cours_name);
        
        $users = User::getUsersByGroupeId($cours->groupe_id);
        
        if ($recherche == "")
        {
            $this->view->render('professeur/listeEleves', array(
                'cours_name' => $cours_name,
                'users' => $users
            ));
        }
        else
        {
            $users_tries = array();
            foreach ($users as $user)
            {
                if (strstr($user->login, $recherche))
                {
                    array_push($users_tries, $user);
                }
            }
            $this->view->render('professeur/listeEleves', array(
                'cours_name' => $cours_name,
                'users' => $users_tries,
                'recherche' => true
            ));
        }
        
        return new Response();
    }
    
    public function rechercherQuestionEleveAction($cours_name)
    {
        $cours_name = str_replace('_', ' ', $cours_name);
        
        $recherche = $this->request->getPostValue('recherche_question_eleve');
        
        $cours = Cours::getCoursByName($cours_name);
        
        $questionsEleve = Question_Eleve::getQuestionsEleveByCoursID($cours->cours_id);
        
        if ($recherche == "")
        {
            $this->view->render('professeur/listeQuestionsEleve', array(
                'cours_name' => $cours_name, 
                'questionsEleve' => $questionsEleve
            ));
        }
        else 
        {
            $questionsEleveTriees = array();
            foreach ($questionsEleve as $questionEleve)
            {
                if (strstr($questionEleve->question, $recherche))
                {
                    array_push($questionsEleveTriees, $questionEleve);
                }
            }
            $this->view->render('professeur/listeQuestionsEleve', array(
                'cours_name' => $cours_name,
                'questionsEleve' => $questionsEleveTriees,
                'recherche' => true
            ));
        }
        
        return new Response();
    }
    
}