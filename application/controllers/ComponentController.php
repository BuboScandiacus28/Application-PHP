<?php 

	namespace application\controllers;

	use application\core\Controller;
	
	
	class ComponentController extends Controller
	{

		public function showAction()
		{
			//debug($this->model);
			$result = $this->model->selChild('component');
			$inhance_path = $this->model->allAncestors('component');
			//debug($inhance_path);
			$vars = [
				'components' => $result, 
				'inhance_path' => $inhance_path,
			];
			$this->view->render('Комплектующие', $vars);
		}

		public function backAction()
		{
			//debug($this->model);
			$result = $this->model->back('component');
			//debug($result);
			if ($result)
			{
				$this->view->redirect("/component/show/?id=".$result[0]['id']."&cod=".$result[0]['cod']."&lvl=".$result[0]['lvl']);
			}
			else
			{
				$this->view->redirect("/component/show/?id=1&cod=1&lvl=0");
			}
			
		}

	}