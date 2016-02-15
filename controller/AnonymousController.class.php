<?php

class AnonymousController extends Controller
{

    public function defaultAction()
    {
        $this->view->render('anonymous/default');
        return new Response();
    }

    public function loginAction()
    {
        $response = new Response();
        
        if(($login = $this->request->getPostValue('login')) && ($password = $this->request->getPostValue('password')))
        {
            $user = User::tryLogin($login, $password);
            if(isset($user)) {
                if ($user->professeur == 0) {
                    $cours = Cours::getCoursByGroupeDuUser($user->user_id);
                    foreach ($cours as $unCours) {
                        $questionnaires = Questionnaire::getQuestionnaireByCours($unCours->cours_name);
                        foreach ($questionnaires as $questionnaire) {
                            $participant = Participant::getParticipantByQuestionnaireAndUser($questionnaire->questionnaire_id, $user->user_id);
                            if ($participant == NULL) {
                                Participant::ajouterParticipant($user->user_id, $questionnaire->questionnaire_id, 0, 0, 0);
                            }
                        }
                    }
                    $this->view->render('eleve/choixCours', array('cours' => $cours));
                }
                
                else {
                    $cours = Cours::getCoursByUser($user->user_id);
                    $this->view->render('professeur/choixCours', array('cours' => $cours));
                }
                
                return $response;
            }
            else {
                $this->view->render('anonymous/default', array('erreur' => 'Identifiants incorrects.'));
                return $response;
            }
        }
        else
        {
            $this->view->render('anonymous/default');
            return $response;
        }
    }
    
}