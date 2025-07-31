<?php

namespace App\Admin\Infrastructure\Controller;

use App\Admin\Application\CreateEmployee\CreateEmployeeApplicationInterface;
use App\Admin\Application\DeleteEmployee\DeleteEmployeeApplicationInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Admin\Application\GetAllEmployees\GetAllEmployeesApplicationInterface;
use App\Admin\Application\GetEmployee\GetEmployeeApplicationInterface;
use App\Admin\Application\UpdateEmployee\UpdateEmployeeApplicationInterface;
use App\shared\Service\Response\ResponseServiceInterface;

final class EmployeesController extends AbstractController
{
    public function __construct(
        private GetAllEmployeesApplicationInterface $getAllEmployees,
        private CreateEmployeeApplicationInterface $createEmployee,
        private GetEmployeeApplicationInterface $getEmployee,
        private UpdateEmployeeApplicationInterface $updateEmployee,
        private DeleteEmployeeApplicationInterface $deleteEmployee,
        private ResponseServiceInterface $responseService
    )
    {}

    #[Route('/employees', name: 'app_employees', methods: ['GET'])]
    public function index(): JsonResponse
    {
       $data = $this->getAllEmployees->getAll();
        
        return $this->responseService->response(
            true,
            "Users Found",
            $data,
        );
            
    }

    #[Route('/create/employee', name: 'app_create_employee', methods: ['POST'])]
    public function storage(Request $request): JsonResponse
    {
        $data = $request->toArray();

        $user = $this->createEmployee->create($data);

        return $this->responseService->response(
            true,
            "User Created",
            $user
        );
    }

    #[Route('/employee/{id}', name: "app_employee", methods:['GET'])]
    public function edit($id) 
    {
       $user = $this->getEmployee->get($id);

        return $this->responseService->response(
            true,
            "User Found",
            $user
        );
    }

    #[Route('/update/employee/{id}', name: "app_update_employee", methods: ['PUT', 'PATCH'])]
    public function update($id, Request $request)
    {
        $data = $request->toArray();

        $user = $this->updateEmployee->update($id, $data);

        return $this->responseService->response(
            true,
            "User Updated",
            $user
        );
    }

    #[Route('/delete/employee/{id}', name: "app_delete_employee", methods: ['DELETE'])]
    public function delete($id)
    {
        $deleted = $this->deleteEmployee->delete($id);

        return $this->responseService->response(
            $deleted,
            $deleted ? 'User Deleted' : 'User not Found'
        );
    }
}
