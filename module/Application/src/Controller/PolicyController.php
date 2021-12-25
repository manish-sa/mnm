<?php

declare(strict_types=1);

namespace Application\Controller;

use Application\Entity\Policy;
use Application\Form\PolicyForm;
use Application\Hydrator\PolicyHydrator;
use Application\Service\PolicyService;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;
use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator as DoctrineAdapter;
use Doctrine\ORM\Tools\Pagination\Paginator as ORMPaginator;
use Laminas\Paginator\Paginator;

class PolicyController extends AbstractActionController
{
    /** @var PolicyService */
    private $policyService;

    /** @var PolicyHydrator */
    private $policyHydrator;

    /**
     * @param PolicyService $policyService
     * @param PolicyHydrator $routerHydrator
     */
    public function __construct(PolicyService $policyService, PolicyHydrator $policyHydrator)
    {
        $this->policyService = $policyService;
        $this->policyHydrator = $policyHydrator;
    }

    /**
     * @return ViewModel
     */
    public function indexAction(): ViewModel
    {
        $page = $this->params()->fromQuery('page', 1);
        $pageSize = $this->params()->fromQuery('pageSize', 5);
        $query = $this->policyService->getPaginationQuery();

        $adapter = new DoctrineAdapter(new ORMPaginator($query, false));

        /** @var Paginator $paginator */
        $paginator = new Paginator($adapter);
        $paginator->setDefaultItemCountPerPage($pageSize);
        $paginator->setCurrentPageNumber($page);

        return new ViewModel(
            [
                'routers' => $paginator,
                'page' => $page,
                'pageSize' => $pageSize,
            ]
        );
    }

    public function addAction()
    {
        $form = new PolicyForm();
        if ($this->getRequest()->isPost()) {
            $data = $this->params()->fromPost();
            $form->setData($data);
            if ($form->isValid()) {
                $data = $form->getData();
                $policy = new Policy();
                $policy = $this->policyHydrator->hydrate($data, $policy);
                $this->policyService->savePolicy($policy);
                return $this->redirect()->toRoute('policy');
            }
        }
        return new ViewModel(['form' => $form]);
    }

    public function editAction()
    {
        $form = new PolicyForm();
        $policyId = (int) $this->params()->fromRoute('id', 0);
        $policy = $this->policyService->findOneById($policyId);
        if ($policy == null) {
            $this->getResponse()->setStatusCode(404);
            return;
        }
        // Check whether this post is a POST request.
        if ($this->getRequest()->isPost()) {
            $data = $this->params()->fromPost();
            $form->setData($data);
            if ($form->isValid()) {
                $data = $form->getData();
                $policy = $this->policyHydrator->hydrate($data, $policy);
                $this->policyService->savePolicy($policy);
                return $this->redirect()->toRoute('policy', ['action' => 'index']);
            }
        } else {
            $form->setData($this->policyHydrator->extract($policy));
        }

        return new ViewModel([
            'form' => $form,
            'policy' => $policy
        ]);
    }

    public function deleteAction()
    {
        $policyId = (int) $this->params()->fromRoute('id', 0);
        $policy = $this->policyService->findOneById($policyId);
        if ($policy == null) {
            $this->getResponse()->setStatusCode(404);
            return;
        }
        $this->policyService->deletePolicy($policy);
        return $this->redirect()->toRoute('policy', ['action'=>'index']);
    }
}
